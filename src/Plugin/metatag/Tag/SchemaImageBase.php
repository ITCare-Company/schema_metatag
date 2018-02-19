<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

use Drupal\schema_metatag\SchemaMetatagManager;

/**
 * Schema.org Image items should extend this class.
 */
abstract class SchemaImageBase extends SchemaNameBase {

  use SchemaImageTrait;

  /**
   * {@inheritdoc}
   */
  public function form(array $element = []) {

    $value = SchemaMetatagManager::unserialize($this->value());

    $input_values = [
      'title' => $this->label(),
      'description' => $this->description(),
      'value' => SchemaMetatagManager::unserialize($this->value()),
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      'visibility_selector' => $this->visibilitySelector(),
    ];

    $form = $this->imageForm($input_values);

    if (!empty($this->info['multiple'])) {
      $form['pivot'] = $this->pivotForm($value);
      $selector = ':input[name="' . $input_values['visibility_selector'] . '[@type]"]';
      $form['pivot']['#states'] = ['invisible' => [$selector => ['value' => '']]];
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    $items = [];
    $keys = self::imageFormKeys();
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
