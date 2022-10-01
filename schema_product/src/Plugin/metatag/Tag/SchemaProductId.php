<?php

namespace Drupal\schema_product\Plugin\metatag\Tag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;

/**
 * Provides a plugin for the 'id' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_product_id",
 *   label = @Translation("@id"),
 *   description = @Translation("Globally unique ID of the product in the form
 *   of a URL. It does not have to be a working link."), name = "@id", group =
 *   "schema_product", weight = 0, type = "string", secure = FALSE, multiple =
 *   FALSE
 * )
 */
class SchemaProductId extends SchemaNameBase {

}
