<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

use Drupal\schema_metatag\SchemaMetatagManager;

/**
 * Schema.org CreativeWork items should extend this class.
 */
abstract class SchemaCreativeWorkBase extends SchemaNameBase {

  use SchemaCreativeWorkTrait;
  use SchemaPivotTrait;

  /**
   * {@inheritdoc}
   */
  public function form(array $element = []) {

    $value = SchemaMetatagManager::unserialize($this->value());

    $input_values = [
      'title' => $this->label(),
      'description' => $this->description(),
      'value' => $value,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      'visibility_selector' => $this->visibilitySelector(),
    ];

    $form = $this->creativeWorkForm($input_values);

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
    $keys = self::creativeWorkFormKeys('CreativeWork');
    foreach ($keys as $key) {
      switch ($key) {

        case '@type':
          $items[$key] = 'CreativeWork';
          break;

        case 'author':
          $items[$key] = SchemaPersonOrgBase::testValue();
          break;

        case 'potentialAction':
          $items[$key] = SchemaActionBase::testValue();
          break;

        default:
          if (is_string($key) && array_key_exists($key, $items)) {
            $items[$key] = parent::testDefaultValue(1, '');
          }
          break;

      }
    }
    return $items;
  }

}
