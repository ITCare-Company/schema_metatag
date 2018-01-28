<?php

namespace Drupal\schema_service\Plugin\metatag\Tag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaAggregateRatingVotingApiBase;

/**
 * Provides a plugin for the 'schema_service_aggregate_rating_votingapi' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_service_aggregate_rating_votingapi",
 *   label = @Translation("AggregateRating for Voting API"),
 *   description = @Translation("AggregateRating (the numeric AggregateRating of the item), using Voting API to compute the rating. NOTE: This code is very experimental and may not work in all cases."),
 *   name = "aggregateRating",
 *   group = "schema_service",
 *   weight = 11,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class SchemaServiceAggregateRatingVotingApi extends SchemaAggregateRatingVotingApiBase {

}
