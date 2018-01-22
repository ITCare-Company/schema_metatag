<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

use Drupal\schema_metatag\SchemaMetatagManager;

/**
 * Schema.org Person/Org items should extend this class.
 */
abstract class SchemaPersonOrgBase extends SchemaNameBase {

  /**
   * Traits provide re-usable form elements.
   */
  use SchemaPersonOrgTrait;
  use SchemaPivotTrait;

  /**
   * The top level keys on this form.
   */
  function form_keys() {
    return ['pivot'] + self::person_org_form_keys();
  }

  /**
   * {@inheritDoc}
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

    $form = $this->person_org_form($input_values);
    $form['pivot'] = $this->pivot_form($value);
    $form['pivot'] = $this->pivot_form($value);
    $form['pivot']['#states'] = ['invisible' => [
      ':input[name="' . $input_values['visibility_selector'] . '"]' => [
			  'value' => '']
      ]
    ];

    return $form;
  }

  /**
   * {@inheritDoc}
   */
  static public function testValue() {
    $items = [];
    $keys = self::person_org_form_keys();
    foreach ($keys as $key) {
      switch ($key) {
        case 'pivot':
          break;
        case 'logo':
          $items[$key] = \Drupal\schema_metatag\Plugin\metatag\Tag\SchemaImageBase::testValue();
          break;
        case '@type':
          $items[$key] = 'Organization';
          break;
        default:
          $items[$key] = parent::testDefaultValue(2, ' ');
          break;
      }
    }
    return $items;
  }

}
