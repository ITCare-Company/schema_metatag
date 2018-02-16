<?php

namespace Drupal\schema_organization\Plugin\metatag\Tag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaRatingBase;

/**
 * Provides a plugin for the 'schema_organization_rating' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_organization_rating",
 *   label = @Translation("Rating"),
 *   description = @Translation("Rating."),
 *   name = "rating",
 *   group = "schema_organization",
 *   weight = 11,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = TRUE
 * )
 */
class SchemaOrganizationRating extends SchemaRatingBase {

}
