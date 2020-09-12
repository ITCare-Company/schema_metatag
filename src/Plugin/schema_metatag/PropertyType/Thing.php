<?php

namespace Drupal\schema_metatag\Plugin\schema_metatag\PropertyType;

use Drupal\schema_metatag\Plugin\schema_metatag\PropertyTypeBase;

/**
 * Provides a plugin for the 'Thing' Schema.org property type.
 *
 * @SchemaPropertyType(
 *   id = "thing",
 *   label = @Translation("Thing"),
 *   tree_parent = {
 *     "Thing",
 *   },
 *   tree_depth = 2,
 *   property_type = "Thing",
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
 *       "description" = @Translation("Globally unique @id of the thing, usually a url, used to to link other properties to this object."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "name" = {
 *       "id" = "text",
 *       "label" = @Translation("name"),
 *       "description" = @Translation("Name of the thing."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "url" = {
 *       "id" = "url",
 *       "label" = @Translation("url"),
 *       "description" = @Translation("Absolute URL of the canonical Web page for the thing."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *   },
 * )
 */
class Thing extends PropertyTypeBase {

}
