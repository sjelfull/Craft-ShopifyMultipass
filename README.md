# Shopify Multipass plugin for Craft CMS

Allow a Craft user to be logged in to [Shopify](https://www.shopify.com/?ref=sjelfull) through Multipass

## Installation

To install Shopify Multipass, follow these steps:

1. Download & unzip the file and place the `shopifymultipass` directory into your `craft/plugins` directory
2.  -OR- do a `git clone https://github.com/sjelfull/Craft-ShopifyMultipass.git` directly into your `craft/plugins` folder.  You can then update it with `git pull`
3. Install plugin in the Craft Control Panel under Settings > Plugins
4. The plugin folder should be named `shopifymultipass` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.

Shopify Multipass works on Craft 2.4.x and Craft 2.5.x.


## Configuring Shopify Multipass

1. First you will need to enable Multipass login on your Shopify store and get the secret token that is used for signing in users. To do this, go to Settings > Checkout > Customer Accounts and enable accounts by either selecting *Accounts are optional* or *Accounts are required*.

2. The option for enabling Multipass will then show under the checkboxes. Click *Enable Multipass*.

3. Copy the secret token and paste it into the plugin settings, along with your Shopify shop URL.

## Using Shopify Multipass

```
{% set addresses = [
    {
        address1: "123 Oak St",
        city: "Ottawa",
        country: "Canada",
        first_name: "Fred",
        last_name: "Carlsen",
        phone: "555-1212",
        province: "Ontario",
        zip: "123 ABC",
        province_code: "ON",
        country_code: "CA",
        default: true
    }
] %}

 {% set info = {
     email: 'bob@example.com',
     first_name: 'Bob Bobsen',
     last_name: 'Ted',
     addresses: addresses
 } %}

 {% set url = craft.shopifyMultipass.generateLoginUrl(info) %}

 <a href="{{ url }}">Login through Shopify Multipass</a>
```

## Shopify Multipass Changelog

### 1.0.0 -- 2016.02.16

* Initial release

Brought to you by [Fred Carlsen](http://sjelfull.no)
