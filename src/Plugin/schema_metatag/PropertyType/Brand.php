<?php

namespace Drupal\schema_metatag\Plugin\schema_metatag\PropertyType;

use Drupal\schema_metatag\Plugin\schema_metatag\PropertyTypeBase;

/**
 * Provides a plugin for the 'Brand' Schema.org property type.
 *
 * @SchemaPropertyType(
 *   id = "brand",
 *   label = @Translation("Brand"),
 *   tree_parent = {
 *     "Brand",
 *   },
 *   tree_depth = 0,
 *   property_type = "Brand",
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
 *       "description" = @Translation(""),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "name" = {
 *       "id" = "text",
 *       "label" = @Translation("name"),
 *       "description" = @Translation("Name of the brand."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "description" = {
 *       "id" = "text",
 *       "label" = @Translation("description"),
 *       "description" = @Translation("Description of the brand."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "url" = {
 *       "id" = "url",
 *       "label" = @Translation("url"),
 *       "description" = @Translation("Absolute URL of the canonical Web page, e.g. the URL of the brand's node or term page or brand website."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "sameAs" = {
 *       "id" = "url",
 *       "label" = @Translation("sameAs"),
 *       "description" = @Translation("Comma separated list of URLs for the person's or organization's official social media profile page(s)."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "logo" =  {
 *       "id" = "image_object",
 *       "label" = @Translation("logo"),
 *       "description" = @Translation("The URL of a logo that is representative of the organization, person, product or service. Review <a href="":logo"" target=""_blank"">Google guidelines.</a>", arguments = {
 *         ":logo" = "https://developers.google.com/search/docs/data-types/logo",
 *       }),
 *       "tree_parent" = {
 *         "ImageObject",
 *       },
 *       "tree_depth" = 0,
 *     },
 *   },
 * )
 */
class Brand extends PropertyTypeBase {

}
