<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

use Drupal\schema_metatag\SchemaMetatagManager;

/**
 * Schema.org PostalAddress items should extend this class.
 */
abstract class SchemaAddressBase extends SchemaNameBase {

  /**
   * Traits provide re-usable form elements.
   */
  use SchemaAddressTrait;
  use SchemaPivotTrait;

  /**
   * The top level keys on this form.
   */
  public static function form_keys() {
    return ['pivot'] + self::postal_address_form_keys();
  }

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

    $form = $this->postal_address_form($input_values);

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
    $keys = self::postal_address_form_keys();
    foreach ($keys as $key) {
      switch ($key) {
        case '@type':
          $items[$key] = 'PostalAddress';
          break;
        default:
          $items[$key] = parent::testDefaultValue(2, ' ');
          break;
      }
    }
    return $items;
  }

}
