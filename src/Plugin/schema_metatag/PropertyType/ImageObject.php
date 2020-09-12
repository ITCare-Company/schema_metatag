<?php

namespace Drupal\schema_metatag\Plugin\schema_metatag\PropertyType;

use Drupal\schema_metatag\Plugin\schema_metatag\PropertyTypeBase;

/**
 * Provides a plugin for the 'ImageObject' Schema.org property type.
 *
 * @SchemaPropertyType(
 *   id = "image_object",
 *   label = @Translation("ImageObject"),
 *   tree_parent = {
 *     "ImageObject",
 *   },
 *   tree_depth = -1,
 *   property_type = "ImageObject",
 *   sub_properties = {
 *     "@type" = {
 *       "id" = "type",
 *       "label" = @Translation("@type"),
 *       "description" = "",
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "representativeOfPage" = {
 *       "id" = "boolean",
 *       "label" = @Translation("representativeOfPage"),
 *       "description" = @Translation("Whether this image is representative of the content of the page."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "url" = {
 *       "id" = "url",
 *       "label" = @Translation("url"),
 *       "description" = @Translation("Absolute URL of the image, i.e. [node:field_name:image_preset_name:url]."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "width" = {
 *       "id" = "number",
 *       "label" = @Translation("width"),
 *       "description" = "",
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "height" = {
 *       "id" = "number",
 *       "label" = @Translation("height"),
 *       "description" = "",
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *   },
 * )
 */
class ImageObject extends PropertyTypeBase {

}
