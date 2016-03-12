<?php
/**
 * Shopify Multipass plugin for Craft CMS
 *
 * ShopifyMultipass Service
 *
 *
 * @author    Fred Carlsen
 * @copyright Copyright (c) 2016 Fred Carlsen
 * @link      http://sjelfull.no
 * @package   ShopifyMultipass
 * @since     1.0.0
 */

namespace Craft;

date_default_timezone_set("UTC");

class ShopifyMultipassService extends BaseApplicationComponent
{

    private $encryptionKey;
    private $signatureKey;
    private $shopUrl;
    private $_errors;

    public function init ()
    {
        // Use the Multipass secret to derive two cryptographic keys,
        // one for encryption, one for signing
        parent::init();

        $settings        = craft()->plugins->getPlugin('shopifyMultipass')->getSettings();
        $multipassSecret = $settings['multipassSecret'];
        $this->shopUrl   = $settings['shopUrl'];

        $keyMaterial         = hash('sha256', $multipassSecret, true);
        $this->encryptionKey = substr($keyMaterial, 0, 16);
        $this->signatureKey  = substr($keyMaterial, 16, 16);
    }

    public function generateLoginUrl ($customerInfo = [ ])
    {
        $token        = $this->generateToken($customerInfo);
        $shopEndpoint = $this->shopUrl . '/account/login/multipass/' . $token;

        return $shopEndpoint;
    }

    public function keys ($customerInfo)
    {
        $model = new ShopifyMultipassModel;
        $model->setAttributes($customerInfo);

        return $model;
    }

    public function address ($address, $multiple = false)
    {
        $models = [ ];

        // If multiple addresses is passed, loop through
        if ( $multiple ) {
            foreach ($address as $item) {
                $model = ShopifyMultipass_AddressModel::populateModel($item);

                // Check if there is any validation errors
                // TODO: Add errors and display

                $models[] = $model;
            }
        }
        else {
            $model    = ShopifyMultipass_AddressModel::populateModel($address);
            $models[] = $model;
        }

        return $models;
    }

    public function generateToken ($customerInfo)
    {
        $addresses = [ ];

        // Populate address models
        if ( array_key_exists('addresses', $customerInfo) ) {
            $addresses = $this->address($customerInfo['addresses'], $multiple = true);

            // Remove from customer info - to be added later
            unset($customerInfo['addresses']);
        }

        // Populate model
        $model = ShopifyMultipassModel::populateModel($customerInfo);

        // Add back address models
        if ( count($addresses) > 0 ) {
            $model->setAttribute('addresses', $addresses);
        }

        // Remove null values
        $filteredModel = $this->filterArrayValues($model->getAttributes(null, $flattenValues = true));

        // Remove __model__
        if ( $addresses ) {
            foreach ($filteredModel['addresses'] as $index => $address) {
                unset($filteredModel['addresses'][ $index ]['__model__']);
            }
        }

        // Serialize the customer data to JSON and encrypt it
        $ciphertext = $this->encrypt(json_encode($filteredModel));

        // Create a signature (message authentication code) of the ciphertext
        // and encode everything using URL-safe Base64 (RFC 4648)
        return strtr(base64_encode($ciphertext . $this->sign($ciphertext)), '+/', '-_');
    }

    private function encrypt ($plaintext)
    {
        // Use a random IV
        $iv = openssl_random_pseudo_bytes(16);

        // Use IV as first block of ciphertext
        return $iv . openssl_encrypt($plaintext, "AES-128-CBC", $this->encryptionKey, OPENSSL_RAW_DATA, $iv);
    }

    private function sign ($data)
    {
        return hash_hmac('sha256', $data, $this->signatureKey, true);
    }

    private function filterArrayValues ($data)
    {
        $original = $data;

        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });

        $data = array_map(function ($e) {
            return is_array($e) ? $this->filterArrayValues($e) : $e;
        }, $data);

        return $original === $data ? $data : $this->filterArrayValues($data);
    }

}
