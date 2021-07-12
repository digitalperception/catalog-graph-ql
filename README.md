Magento 2 DigitalPerception/CatalogGraphQl Module
===========================================

## Dynamic Attribute Text Values

Graphql products query returns only ids of option values for select or multiselect type attributes. 
Implementation of this module will allow us to retrieve Text Labels of option values of an attribute in a given store language
for a given product.

#### Compatible
    v1.0.0 - versions 2.3.* - 2.4.*

#### Change list
    v1.0.0 - Start project

#### Installation
    1. This module is intended to be installed using composer 
        [ composer require "digitalerception/catalog-graph-ql" ]
    2. Run following commands from your root Magento installation directory:
        bin/magento module:enable DigitalPerception_CatalogGraphQl
        bin/magento setup:upgrade
        bin/magento cache:flush
# Usage

## Graphql Input Payload
```
{
  products(filter: {sku: {eq: "24-MB03"}}) {
    items {
    id
    sku
    name
    dynamicAttributes(fields: ["material","brand"]) {
        code
        label
        value
      }
    }
  }
}
```
## Output Response

```
"id": 3,
"sku": "24-MB03",
"name": "Crown Summit Backpack",
"custom_attributes": [
            {
              "code": "material",
              "label": "Materialfr",
              "value": "woolfr"
            },
            {
              "code": "features_bags",
              "label": "Features",
              "value": "Audio Pocket, Waterproof, Lightweight, Reflective, Laptop Sleeve"
            }
          ],
```
