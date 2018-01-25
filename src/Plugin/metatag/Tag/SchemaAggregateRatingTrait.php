<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

trait SchemaAggregateRatingTrait {

  public function aggregateRatingFormKeys() {
    return [
      '@type',
      'votingAPI',
      'ratingEntityType',
      'ratingValue',
      'ratingCount',
      'bestRating',
      'worstRating',
    ];
  }

  public function aggregateRatingInputValues() {
    return [
      'title' => '',
      'description' => '',
      'value' => [],
      '#required' => FALSE,
      'visibility_selector' => '',
    ];
  }

  public function aggregateRatingForm($input_values) {

    $input_values += $this->aggregateRatingInputValues();
    $value = $input_values['value'];

    $form['#type'] = 'fieldset';
    $form['#title'] = $input_values['title'];
    $form['#description'] = $input_values['description'];
    $form['#tree'] = TRUE;

    $form['@type'] = [
      '#type' => 'select',
      '#title' => $this->t('@type'),
      '#empty_option' => t('- None -'),
      '#empty_value' => '',
      '#options' => [
        'AggregateRating' => $this->t('AggregateRating'),
      ],
      '#default_value' => !empty($value['@type']) ? $value['@type'] : '',
    ];

    // See if VotingAPI is going to be used. If so, we also need to know the specific
    // voting module to figure out which values to retrieve from the results.
    // The logic for each of these modules is contained in SchemaAggregateRatingBase.
    $form['votingAPI'] = [
      '#type' => 'select',
      '#title' => $this->t('Use Voting API?'),
      '#description' => $this->t('If using Voting API, choose the name of the voting module used for ratings.'),
      '#empty_option' => t('No'),
      '#empty_value' => '',
      '#options' => [
        //'Yes' => $this->t('Yes'),
        'votingapiWidgets' => $this->t('VotingAPI Widgets'),
        'voteUpDown' => $this->t('Vote Up Down'),
        'likeAndDislike' => $this->t('Like and Dislike'),
        'rate' => $this->t('Rate'),
      ],
      '#default_value' => !empty($value['votingAPI']) ? $value['votingAPI'] : '',
    ];

    // Add #states to show/hide the fields based on the value of @type,
    // if a selector was provided.
    if (!empty($input_values['visibility_selector'])) {
      $visibility = ['visible' => [':input[name="' . $input_values['visibility_selector'] . '"]' => [
			  'value' => 'AggregateRating']
      ]];
      $form['votingAPI']['#states'] = $visibility;
    }

    // Add another selector to show/hide fields based on the value of votingAPI.
    $selector = $this->visibilitySelector() . '[votingAPI]';
    $votingapi_visibility = ['invisible' => [':input[name="' . $selector . '"]' => [
      'value' => '']
    ]];
    $votingapi_invisibility = ['visible' => [':input[name="' . $selector . '"]' => [
      'value' => '']
    ]];

    $options = [];
    $entities = \Drupal::entityTypeManager()->getDefinitions();
    foreach ($entities as $entity_type => $entity) {
      if ($entity instanceof \Drupal\Core\Entity\ContentEntityType) {
        $options[$entity_type] = $entity_type;
      }
    }
    $form['ratingEntityType'] = [
      '#type' => 'select',
      '#title' => $this->t('Voting API entity type'),
      '#empty_option' => t('- None -'),
      '#empty_value' => '',
      '#options' => $options,
      '#default_value' => !empty($value['ratingEntityType']) ? $value['ratingEntityType'] : '',
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t('The type of entity being rated.'),
      '#states' => $votingapi_visibility,
    ];
    $form['ratingValue'] = [
      '#type' => 'textfield',
      '#title' => $this->t('ratingValue'),
      '#default_value' => !empty($value['ratingValue']) ? $value['ratingValue'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t('The numeric rating of the item.'),
      '#states' => $votingapi_invisibility,
    ];
    $form['ratingCount'] = [
      '#type' => 'textfield',
      '#title' => $this->t('ratingCount'),
      '#default_value' => !empty($value['ratingCount']) ? $value['ratingCount'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t('The number of ratings included.'),
      '#states' => $votingapi_invisibility,
    ];

    // For now leave these to be filled out manually. It is not easy or automatic
    // to populate these values from the voting module results or settings.
    $form['bestRating'] = [
      '#type' => 'textfield',
      '#title' => $this->t('bestRating'),
      '#default_value' => !empty($value['bestRating']) ? $value['bestRating'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t('The highest rating value possible.'),
    ];
    $form['worstRating'] = [
      '#type' => 'textfield',
      '#title' => $this->t('worstRating'),
      '#default_value' => !empty($value['worstRating']) ? $value['worstRating'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t('The lowest rating value possible.'),
    ];

    return $form;

  }


}
