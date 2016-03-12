<?php
/**
 * Shopify Multipass plugin for Craft CMS
 *
 * ShopifyMultipass Model
 *
 * --snip--
 * Models are containers for data. Just about every time information is passed between services, controllers, and
 * templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 * --snip--
 *
 * @author    Fred Carlsen
 * @copyright Copyright (c) 2016 Fred Carlsen
 * @link      http://sjelfull.no
 * @package   ShopifyMultipass
 * @since     1.0.0
 */

namespace Craft;

class ShopifyMultipass_AddressModel extends BaseModel
{
    /**
     * Defines this model's attributes.
     *
     * @return array
     */
    protected function defineAttributes ()
    {
        return array_merge(parent::defineAttributes(), array(
            'address1'      => array( AttributeType::String, 'required' => true, 'default' => null ),
            'city'          => array( AttributeType::String, 'default' => null ),
            'country'       => array( AttributeType::String, 'default' => null ),
            'country_code'  => array( AttributeType::String, 'default' => null ),
            'first_name'    => array( AttributeType::String, 'default' => null ),
            'last_name'     => array( AttributeType::String, 'default' => null ),
            'phone'         => array( AttributeType::String, 'default' => null ),
            'province'      => array( AttributeType::String, 'default' => null ),
            'province_code' => array( AttributeType::String, 'default' => null ),
            'zip'           => array( AttributeType::String, 'default' => null ),
            'default'       => array( AttributeType::Bool, 'default' => false ),
        ));
    }

}
