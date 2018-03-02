<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

use Drupal\schema_metatag\SchemaMetatagManager;

/**
 * Schema.org Action items should extend this class.
 */
abstract class SchemaActionBase extends SchemaNameBase {

  use SchemaActionTrait;
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

    $form = $this->actionForm($input_values);

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
    $keys = self::actionFormKeys('TradeAction');
    foreach ($keys as $key) {
      switch ($key) {

        case '@type':
          $items[$key] = 'BuyAction';
          break;

        case 'location':
        case 'fromLocation':
        case 'toLocation':
          $items[$key] = SchemaPlaceBase::testValue();
          break;

        case 'expectsAcceptanceOf':
          $items[$key] = SchemaOfferBase::testValue();
          break;

        case 'event':
          $items[$key] = SchemaEventBase::testValue();
          break;

        case 'targetCollection':
        case 'result':
        case 'object':
        case 'error':
        case 'instrument':
          $items[$key] = SchemaThingBase::testValue();
          break;

        case 'target':
          $items[$key] = SchemaEntryPointBase::testValue();
          break;

        case 'agent':
        case 'buyer':
        case 'seller':
        case 'recipient':
        case 'participant':
          $items[$key] = SchemaPersonOrgBase::testValue();
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
