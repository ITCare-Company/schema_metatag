<?php

namespace Drupal\schema_metatag\Plugin\schema_metatag\PropertyType;

use Drupal\schema_metatag\Plugin\schema_metatag\PropertyTypeBase;

/**
 * Provides a plugin for the 'QuantitativeValue' Schema.org property type.
 *
 * @SchemaPropertyType(
 *   id = "quantitative_value",
 *   label = @Translation("QuantitativeValue"),
 *   tree_parent = {
 *     "QuantitativeValue",
 *   },
 *   tree_depth = 0,
 *   property_type = "QuantitativeValue",
 *   sub_properties = {
 *     "@type" = {
 *       "id" = "type",
 *       "label" = @Translation("@type"),
 *       "description" = "",
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "value" = {
 *       "id" = "number",
 *       "label" = @Translation("value"),
 *       "description" = @Translation("The value."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "minValue" = {
 *       "id" = "number",
 *       "label" = @Translation("minValue"),
 *       "description" = @Translation("The minimum value."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "maxValue" = {
 *       "id" = "number",
 *       "label" = @Translation("maxValue"),
 *       "description" = @Translation("The maximum value."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "unitText" = {
 *       "id" = "text",
 *       "label" = @Translation("unitText"),
 *       "description" = @Translation("The unit of the value, like HOUR, DAY, WEEK, MONTH, or YEAR."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *   },
 * )
 */
class QuantitativeValue extends PropertyTypeBase {

}
