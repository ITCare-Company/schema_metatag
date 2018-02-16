<?php

namespace Drupal\schema_article\Plugin\metatag\Tag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaRatingBase;

/**
 * Provides a plugin for the 'schema_article_rating' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_article_rating",
 *   label = @Translation("Rating"),
 *   description = @Translation("Rating."),
 *   name = "rating",
 *   group = "schema_article",
 *   weight = 11,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = TRUE
 * )
 */
class SchemaArticleRating extends SchemaRatingBase {

}
