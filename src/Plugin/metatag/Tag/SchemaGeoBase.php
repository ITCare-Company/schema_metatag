<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

use Drupal\schema_metatag\SchemaMetatagManager;

/**
 * Schema.org Geo items should extend this class.
 */
abstract class SchemaGeoBase extends SchemaNameBase {

  /**
   * Traits provide re-usable form elements.
   */
  use SchemaGeoTrait;
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
      'visibility_selector' => $this->visibilitySelector() . '[@type]',
    ];

    $form = $this->geo_form($input_values);

    $form['pivot'] = $this->pivot_form($value);
    $form['pivot']['#states'] = ['invisible' => [
      ':input[name="' . $input_values['visibility_selector'] . '"]' => [
			  'value' => '']
      ]
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  static public function testValue() {
    $items = [];
    $keys = self::geo_form_keys();
    foreach ($keys as $key) {
      switch ($key) {
        case '@type':
          $items[$key] = 'GeoCoordinates';
          break;
        default:
          $items[$key] = parent::testDefaultValue(1, '');
          break;
      }
    }
    return $items;
  }

}
