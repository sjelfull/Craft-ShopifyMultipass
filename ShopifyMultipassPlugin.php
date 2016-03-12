<?php
/**
 * Shopify Multipass plugin for Craft CMS
 *
 * Allow a Craft user to be logged in to Shopify through Multipass
 *
 *
 * @author    Fred Carlsen
 * @copyright Copyright (c) 2016 Fred Carlsen
 * @link      http://sjelfull.no
 * @package   ShopifyMultipass
 * @since     1.0.0
 */

namespace Craft;

class ShopifyMultipassPlugin extends BasePlugin
{
    /**
     * Returns the user-facing name.
     *
     * @return mixed
     */
    public function getName ()
    {
        return Craft::t('Shopify Multipass');
    }

    /**
     * Plugins can have descriptions of themselves displayed on the Plugins page by adding a getDescription() method
     * on the primary plugin class:
     *
     * @return mixed
     */
    public function getDescription ()
    {
        return Craft::t('Allow a Craft user to be logged in to an Shopify store through Multipass');
    }

    /**
     * Plugins can have links to their documentation on the Plugins page by adding a getDocumentationUrl() method on
     * the primary plugin class:
     *
     * @return string
     */
    public function getDocumentationUrl ()
    {
        return 'https://github.com/sjelfull/Craft-ShopifyMultipass/blob/master/README.md';
    }

    /**
     * Plugins can now take part in Craft’s update notifications, and display release notes on the Updates page, by
     * providing a JSON feed that describes new releases, and adding a getReleaseFeedUrl() method on the primary
     * plugin class.
     *
     * @return string
     */
    public function getReleaseFeedUrl ()
    {
        return 'https://raw.githubusercontent.com/sjelfull/Craft-ShopifyMultipass/master/releases.json';
    }

    /**
     * Returns the version number.
     *
     * @return string
     */
    public function getVersion ()
    {
        return '1.0.0';
    }

    /**
     * As of Craft 2.5, Craft no longer takes the whole site down every time a plugin’s version number changes, in
     * case there are any new migrations that need to be run. Instead plugins must explicitly tell Craft that they
     * have new migrations by returning a new (higher) schema version number with a getSchemaVersion() method on
     * their primary plugin class:
     *
     * @return string
     */
    public function getSchemaVersion ()
    {
        return '1.0.0';
    }

    /**
     * Returns the developer’s name.
     *
     * @return string
     */
    public function getDeveloper ()
    {
        return 'Fred Carlsen';
    }

    /**
     * Returns the developer’s website URL.
     *
     * @return string
     */
    public function getDeveloperUrl ()
    {
        return 'http://sjelfull.no';
    }

    /**
     * Defines the attributes that model your plugin’s available settings.
     *
     * @return array
     */
    protected function defineSettings ()
    {
        return array(
            'multipassSecret' => array( AttributeType::String, 'label' => 'Multipass Secret', 'default' => '' ),
            'shopUrl'         => array( AttributeType::String, 'label' => 'Shop URL', 'default' => '' ),
        );
    }

    /**
     * Returns the HTML that displays your plugin’s settings.
     *
     * @return mixed
     */
    public function getSettingsHtml ()
    {
        return craft()->templates->render('shopifymultipass/ShopifyMultipass_Settings', array(
            'settings' => $this->getSettings()
        ));
    }

    /**
     * If you need to do any processing on your settings’ post data before they’re saved to the database, you can
     * do it with the prepSettings() method:
     *
     * @param mixed $settings The Widget's settings
     *
     * @return mixed
     */
    public function prepSettings ($settings)
    {
        // Modify $settings here...

        return $settings;
    }

}
