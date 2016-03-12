<?php
/**
 * Shopify Multipass plugin for Craft CMS
 *
 * ShopifyMultipass Model
 *
 * @author    Fred Carlsen
 * @copyright Copyright (c) 2016 Fred Carlsen
 * @link      http://sjelfull.no
 * @package   ShopifyMultipass
 * @since     1.0.0
 */

namespace Craft;

class ShopifyMultipassModel extends BaseModel
{
    /**
     * Defines this model's attributes.
     *
     * @return array
     */
    protected function defineAttributes ()
    {
        return array_merge(parent::defineAttributes(), array(
            'email'      => array( AttributeType::Email, 'required' => true, 'default' => false ),
            'created_at' => array( AttributeType::String, 'required' => true, 'default' => date('c') ),
            'first_name' => array( AttributeType::String, 'default' => null ),
            'last_name'  => array( AttributeType::String, 'default' => null ),
            'tags'       => array( AttributeType::Mixed, 'default' => null ),
            'remote_ip'  => array( AttributeType::String, 'default' => null ),
            'identifier' => array( AttributeType::String, 'default' => null ),
            'return_to'  => array( AttributeType::String, 'default' => null ),
            'addresses'  => array( AttributeType::Mixed, 'default' => null ),
        ));
    }

}
