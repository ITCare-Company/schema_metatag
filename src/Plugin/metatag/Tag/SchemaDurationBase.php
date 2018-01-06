<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

/**
 * Provides a plugin for the 'schema_duration_base' meta tag.
 */
abstract class SchemaDurationBase extends SchemaNameBase {

  /**
   * {@inheritdoc}
   */
  public function output() {
    $element = parent::output();
    $is_integer = ctype_digit($this->value()) || is_int($this->value());
    if (!empty($element) && $is_integer && $this->value() > 0) {
      $interval = 'PT' . $this->value() . 'S';
      $element['#attributes']['content'] = $interval;
    }
    return $element;
  }

}
