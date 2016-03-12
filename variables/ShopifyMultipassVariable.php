<?php
/**
 * Shopify Multipass plugin for Craft CMS
 *
 * Shopify Multipass Variable
 *
 *
 * @author    Fred Carlsen
 * @copyright Copyright (c) 2016 Fred Carlsen
 * @link      http://sjelfull.no
 * @package   ShopifyMultipass
 * @since     1.0.0
 */

namespace Craft;

class ShopifyMultipassVariable
{
    public function generateLoginUrl ($user = null)
    {
        return craft()->shopifyMultipass->generateLoginUrl($user);
    }
}
