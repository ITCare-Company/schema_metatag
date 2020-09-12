<?php

namespace Drupal\schema_metatag\Plugin\schema_metatag\PropertyType;

use Drupal\schema_metatag\Plugin\schema_metatag\PropertyTypeBase;

/**
 * Provides a plugin for the 'Offer' Schema.org property type.
 *
 * @SchemaPropertyType(
 *   id = "offer",
 *   label = @Translation("Offer"),
 *   tree_parent = {
 *     "Offer",
 *   },
 *   tree_depth = -1,
 *   property_type = "Offer",
 *   sub_properties = {
 *     "@type" = {
 *       "id" = "type",
 *       "label" = @Translation("@type"),
 *       "description" = "",
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "@id" = {
 *       "id" = "text",
 *       "label" = @Translation("@id"),
 *       "description" = @Translation("Globally unique ID of the item in the form of a URL. It does not have to be a working link."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "price" = {
 *       "id" = "number",
 *       "label" = @Translation("price"),
 *       "description" = @Translation("REQUIRED BY GOOGLE for Offer. The numeric price of the offer. Do not include dollar sign."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "offerCount" = {
 *       "id" = "number",
 *       "label" = @Translation("offerCount"),
 *       "description" = @Translation("RECOMMEND BY GOOGLE for AggregateOffer. The number of offers."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "lowPrice" = {
 *       "id" = "number",
 *       "label" = @Translation("lowPrice"),
 *       "description" = @Translation("REQUIRED BY GOOGLE for AggregateOffer. The lowest price. Do not include dollar sign."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "highPrice" = {
 *       "id" = "number",
 *       "label" = @Translation("highPrice"),
 *       "description" = @Translation("REQUIRED BY GOOGLE for AggregateOffer. The highest price. Do not include dollar sign."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "priceCurrency" = {
 *       "id" = "number",
 *       "label" = @Translation("priceCurrency"),
 *       "description" = @Translation("REQUIRED BY GOOGLE. The three-letter currency code (i.e. USD) in which the price is displayed."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "url" = {
 *       "id" = "url",
 *       "label" = @Translation("url"),
 *       "description" = @Translation("The URL where the offer can be acquired."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "itemCondition" = {
 *       "id" = "text",
 *       "label" = @Translation("itemCondition"),
 *       "description" = @Translation("RECOMMENDED BY GOOGLE for Product Offer. The condition of this item. Valid options are https://schema.org/DamagedCondition, https://schema.org/NewCondition, https://schema.org/RefurbishedCondition, https://schema.org/UsedCondition."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "availability" = {
 *       "id" = "text",
 *       "label" = @Translation("availability"),
 *       "description" = @Translation("REQUIRED BY GOOGLE for Product Offer. The availability of this item. Valid options are https://schema.org/Discontinued, https://schema.org/InStock, https://schema.org/InStoreOnly, https://schema.org/LimitedAvailability, https://schema.org/OnlineOnly, https://schema.org/OutOfStock, https://schema.org/PreOrder, https://schema.org/PreSale, https://schema.org/SoldOut."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "availabilityStarts" = {
 *       "id" = "date",
 *       "label" = @Translation("availabilityStarts"),
 *       "description" = @Translation("The end of the availability of the product or service included in the offer."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "availabilityEnds" = {
 *       "id" = "date",
 *       "label" = @Translation("availabilityEnds"),
 *       "description" = @Translation("Date after which the item is no longer available."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "validFrom" = {
 *       "id" = "date",
 *       "label" = @Translation("validFrom"),
 *       "description" = @Translation("The date when the item becomes valid."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "priceValidUntil" = {
 *       "id" = "date",
 *       "label" = @Translation("priceValidUntil"),
 *       "description" = @Translation("The date after which the price will no longer be available."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "category" = {
 *       "id" = "text",
 *       "label" = @Translation("category"),
 *       "description" = @Translation("Values like: 'rental', 'purchase', 'subscription', 'externalSubscription', 'free'."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "eligibleRegion" = {
 *       "id" = "country",
 *       "label" = @Translation("eligibleRegion"),
 *       "description" = @Translation("The region where the offer is valid."),
 *       "tree_parent" = {
 *         "Country",
 *       },
 *       "tree_depth" = -1,
 *     },
 *     "ineligibleRegion" = {
 *       "id" = "country",
 *       "label" = @Translation("ineligibleRegion"),
 *       "description" = @Translation("The region where the offer is not valid."),
 *       "tree_parent" = {
 *         "Country",
 *       },
 *       "tree_depth" = -1,
 *     },
 *   },
 * )
 */
class Offer extends PropertyTypeBase {

}
