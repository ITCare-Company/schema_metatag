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
   * {@inheritdoc}
   */
  public function form(array $element = []) {
    $form = parent::form($element);
    $form['#description'] = $this->t('Comma-separated list of class names of the parts of the web page that are not free. Do NOT surround class names with quotation marks! Also fill out "isAccessibleForFree".');
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    return parent::testDefaultValue(1, '');
  }

  /**
   * {@inheritdoc}
   */
  public static function outputValue($input_value) {
    $items = [];
    $class_names = (array) SchemaMetatagManager::explode($input_value);
    foreach ($class_names as $class_name) {
      $items[] = [
        '@type' => 'WebPageElement',
        'isAccessibleForFree' => 'False',
        'cssSelector' => '.' . $class_name,
      ];
    }
    return !empty($items) ? $items : '';
  }

}
