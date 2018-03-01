<?php

namespace Drupal\schema_book\Plugin\metatag\Tag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaPersonOrgBase;

/**
 * Provides a plugin for the 'author' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_book_author",
 *   label = @Translation("author"),
 *   description = @Translation("Author of the book."),
 *   name = "author",
 *   group = "schema_book",
 *   weight = 5,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = TRUE
 * )
 */
class SchemaBookAuthor extends SchemaPersonOrgBase {

  /**
   * {@inheritdoc}
   */
  public function form(array $element = []) {
    $form = parent::form($element);
    $form['name']['#attribute']['placeholder'] = '[node:author:display-name]';
    $form['url']['#attributes']['placeholder'] = '[node:author:url]';
    return $form;
  }

}
