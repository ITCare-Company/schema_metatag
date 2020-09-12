<?php

namespace Drupal\schema_metatag\Plugin\schema_metatag\PropertyType;

use Drupal\schema_metatag\Plugin\schema_metatag\PropertyTypeBase;

/**
 * Provides a plugin for the 'AggregateRating' Schema.org property type.
 *
 * @SchemaPropertyType(
 *   id = "aggregate_rating",
 *   label = @Translation("AggregateRating"),
 *   tree_parent = {
 *     "AggregateRating",
 *   },
 *   tree_depth = 0,
 *   property_type = "AggregateRating",
 *   sub_properties = {
 *     "@type" = {
 *       "id" = "type",
 *       "label" = @Translation("@type"),
 *       "description" = "",
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "ratingValue" = {
 *       "id" = "number",
 *       "label" = @Translation("ratingValue"),
 *       "description" = @Translation("The numeric rating of the item."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "ratingCount" = {
 *       "id" = "number",
 *       "label" = @Translation("ratingCount"),
 *       "description" = @Translation("The number of ratings included."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "bestRating" = {
 *       "id" = "number",
 *       "label" = @Translation("bestRating"),
 *       "description" = @Translation("The highest rating value possible."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "worstRating" = {
 *       "id" = "number",
 *       "label" = @Translation("worstRating"),
 *       "description" = @Translation("The lowest rating value possible."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *   },
 * )
 */
class AggregateRating extends PropertyTypeBase {

}
