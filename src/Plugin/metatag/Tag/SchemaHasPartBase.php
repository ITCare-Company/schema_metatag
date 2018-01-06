<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;
use Drupal\schema_metatag\SchemaMetatagManager;

/**
 * Provides a plugin for the 'hasPart' meta tag.
 *
 * Currently applies only to isAccessibleForFree.
 * @see https://developers.google.com/search/docs/data-types/paywalled-content
 */
abstract class SchemaHasPartBase extends SchemaNameBase {

  /**
   * Generate a form element for this meta tag.
   */
  public function form(array $element = []) {
    $form = parent::form($element);
    $form['#description'] = $this->t('Comma-separated list of class names of the parts of the web page that are not free. Do NOT surround class names with quotation marks! Also fill out "isAccessibleForFree".');
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function output() {
    $element = parent::output();
    if (!empty($element)) {
      $element['#attributes']['content'] = [];
      $class_names = SchemaMetatagManager::explode($this->value());
      foreach ($class_names as $class_name) {
        $element['#attributes']['content'][] = [
          '@type' => 'WebPageElement',
          'isAccessibleForFree' => 'False',
          'cssSelector' => '.' . $class_name,
        ];
      }
    }
    return $element;
  }

}
