<?php

namespace Drupal\schema_book\Plugin\metatag\Group;

use Drupal\schema_metatag\Plugin\metatag\Group\SchemaGroupBase;

/**
 * Provides a plugin for the 'Book' meta tag group.
 *
 * @MetatagGroup(
 *   id = "schema_book",
 *   label = @Translation("Schema.org: Book"),
 *   description = @Translation("See Schema.org definitions for this Schema type at <a href="":url"">:url</a>.", arguments = { ":url" = "http://schema.org/Book"}),
 *   weight = 10,
 * )
 */
class SchemaBook extends SchemaGroupBase {
  // Nothing here yet. Just a placeholder class for a plugin.
}
