<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

use Drupal\schema_metatag\SchemaMetatagManager;

/**
 * Schema.org Image items should extend this class.
 */
abstract class SchemaImageBase extends SchemaNameBase {

  /**
   * Traits provide re-usable form elements.
   */
  use SchemaImageTrait;

  /**
   * {@inheritDoc}
   */
  public function form(array $element = []) {

    $value = SchemaMetatagManager::unserialize($this->value());

    $input_values = [
      'title' => $this->label(),
      'description' => $this->description(),
      'value' => SchemaMetatagManager::unserialize($this->value()),
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      'visibility_selector' => $this->visibilitySelector() . '[@type]',
    ];

    $form = $this->image_form($input_values);

    return $form;
  }

  /**
   * {@inheritDoc}
   */
  static public function testValue() {
    $items = [];
    $keys = self::image_form_keys();
    foreach ($keys as $key) {
      switch ($key) {
        case '@type':
          $items[$key] = 'ImageObject';
          break;
        case 'representativeOfPage':
          $items[$key] = 'True';
          break;
        default:
          $items[$key] = parent::testDefaultValue(1, '');
          break;
      }
    }
    return $items;
  }

}
