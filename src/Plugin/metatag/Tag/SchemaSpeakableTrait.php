<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

use Drupal\Core\Form\FormStateInterface;

/**
 * Schema.org Speakable trait.
 */
trait SchemaSpeakableTrait {

  /**
   * Form keys.
   */
  public static function speakableFormKeys() {
    return [
      '@type',
      'xpath',
      'cssSelector',
    ];
  }

  /**
   * The form element.
   */
  public function speakableForm($input_values) {
    $value = $input_values['value'];

    $form['#type'] = 'fieldset';
    $form['#title'] = $input_values['title'];
    $form['#description'] = $input_values['description'];
    $form['#tree'] = TRUE;

    $visibility_selector = $input_values['visibility_selector'];
    $xpath_name_selector = $visibility_selector . '[xpath]';
    $css_name_selector = $visibility_selector . '[cssSelector]';

    $form['@type'] = [
      '#type' => 'select',
      '#title' => $this->t('Type'),
      '#default_value' => !empty($value['@type']) ? $value['@type'] : '',
      '#empty_option' => t('- None -'),
      '#empty_value' => '',
      '#options' => [
        'SpeakableSpecification' => $this->t('SpeakableSpecification'),
      ],
      '#states' => [
        'required' => [
          [':input[name="' . $xpath_name_selector . '"]' => ['filled' => TRUE]],
          [':input[name="' . $css_name_selector . '"]' => ['filled' => TRUE]],
        ],
      ],
    ];

    $form['xpath'] = [
      '#type' => 'textfield',
      '#title' => $this->t('xpath'),
      '#default_value' => !empty($value['xpath']) ? $value['xpath'] : '',
      '#description' => $this->t('Sepparate xpaths by comma per line. ex: @example',
        ['@example' => '/html/head/title,/html/head/meta[@name=\'description\']/@content']),
    ];

    $form['cssSelector'] = [
      '#type' => 'textfield',
      '#title' => $this->t('cssSelector'),
      '#default_value' => !empty($value['cssSelector']) ? $value['cssSelector'] : '',
      '#description' => $this->t('Sepparate selectors by comma. ex: @example',
        ['@example' => '#title,#thesummary']
      ),
    ];

    $form['#element_validate'] = [[get_class($this), 'speakableValidation']];

    return $form;
  }

  /**
   * Validation callback for speakable form element.
   *
   * @param array $element
   *   The speakable form element
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Metatag form state.
   */
  public static function speakableValidation(array &$element, FormStateInterface $form_state) {
    $value = $form_state->getValue($element['#parents']);
    $is_enabled = !empty($value['@type']);
    $has_selector = !empty($value['cssSelector']) || !empty($value['xpath']);
    if ($is_enabled && !$has_selector) {
      $form_state->setError($element, t('Please provide and xpath or cssSelector'));
    }
    if (!empty($value['cssSelector']) && !empty($value['xpath'])) {
      $form_state->setError($element, t('Please use either xpath or cssSelector, not both.'));
    }
  }

}
