<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

use Drupal\schema_metatag\SchemaMetatagManager;
use Drupal\field\Entity\FieldConfig;

/**
 * Provides a plugin for the 'schema_offer_base' meta tag.
 */
abstract class SchemaAggregateRatingBase extends SchemaNameBase {

  /**
   * Traits provide re-usable form elements.
   */
  use SchemaAggregateRatingTrait;

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

    $form = $this->aggregateRatingForm($input_values);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function output() {
    $element = parent::output();
    $value = SchemaMetatagManager::unserialize($this->value());
    if (empty($value)) {
      return '';
    }

    if (!empty($element['#attributes']['content'])) {
      $voting_api = '';
      $rating_entity_type = '';
      $rating_widget = '';
      if (array_key_exists('votingAPI', $element['#attributes']['content'])) {
        $voting_api = $element['#attributes']['content']['votingAPI'];
        unset($element['#attributes']['content']['votingAPI']);
      }
      if (array_key_exists('ratingEntityType', $element['#attributes']['content'])) {
        $rating_entity_type = $element['#attributes']['content']['ratingEntityType'];
        unset($element['#attributes']['content']['ratingEntityType']);
      }
      if (!empty($voting_api) && !empty($rating_entity_type)) {
        $moduleHandler = \Drupal::service('module_handler');
        if (!$moduleHandler->moduleExists($voting_api)) {
          return $element;
        }
        if ($entity = \Drupal::routeMatch()->getParameter($rating_entity_type)) {
          $votes = \Drupal::service('plugin.manager.votingapi.resultfunction');
          $results = $votes->getResults($rating_entity_type, $entity->id());
          //dpm($results);
          if (!empty($results)) {
            $ratings = $this->{$voting_api}($value, $results, $entity);
            $element['#attributes']['content']['ratingValue'] = $ratings[0];
            $element['#attributes']['content']['ratingCount'] = $ratings[1];
          }
        }
      }
    }
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    $items = [];
    $keys = ['@type','ratingValue','ratingCount','bestRating','worstRating'];
    foreach ($keys as $key) {
      switch ($key) {
        case '@type':
          $items[$key] = 'AggregateRating';
          break;

        default:
          $items[$key] = parent::testDefaultValue(2, ' ');
          break;

      }
    }
    return $items;
  }

  /**
   * {@inheritdoc}
   */
  public function __output() {
    $element = parent::output();
    if (!empty($element)) {
      $input_value = $element['#attributes']['content'];
      $element['#attributes']['content'] = self::outputValue($input_value);
    }
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function outputValue($input_value) {
    return $input_value;
  }

  /**
   * Get ratings for vote_up_down module.
   */
  public function voteUpDown($value, $results, $entity) {
    $rating = 0;
    $count = 0;

    // Get the vud configuration, which identifies the index to use.
    $config = \Drupal::config('vud.settings');
    $tag = $config->get('tag');
    foreach ($results as $type => $votes) {
      switch ($type) {
        case $tag:
          $rating = $results[$tag]['vote_sum'];
          $count = $results[$tag]['vote_count'];
          break;

      }
    }
    return [$rating, $count];
  }

  /**
   * Get ratings for like_and_dislike module.
   */
  public function likeAndDislike($value, $results, $entity) {
    $rating = 0;
    $count = 0;

    // Like and dislike stores votes in 'like' and 'dislike'.
    foreach ($results as $type => $votes) {
      switch ($type) {
        case 'dislike':
          $rating -= $votes['vote_sum'];
          break;

        case 'like':
          $rating += $votes['vote_sum'];
          break;

      }
      $count += $votes['vote_count'];
    }
    return [$rating, $count];
  }

  /**
   * Get ratings for rate module.
   */
  public function rate($value, $results, $entity) {
    $rating = 0;
    $count = 0;

    // Get rate configuration. Each widget has its own.
    $config = \Drupal::config('rate.settings');
    $widget_type = $config->get('widget_type');

    foreach ($results as $type => $votes) {
      switch ($type) {
        case 'up':
          $rating += $votes['vote_sum'];
          break;

        case 'down':
          $rating -= $votes['vote_sum'];
          break;

        case 'star1':
          $rating += ($votes['vote_sum'] * 1);
          break;

        case 'star2':
          $rating += ($votes['vote_sum'] * 2);
          break;

        case 'star3':
          $rating += ($votes['vote_sum'] * 3);
          break;

        case 'star4':
          $rating += ($votes['vote_sum'] * 4);
          break;

        case 'star5':
          $rating += ($votes['vote_sum'] * 5);
          break;

      }
      $count += $votes['vote_count'];
    }
    if ($widget_type == 'fivestar') {
      $rating = round(($rating / $count), 1);
    }
    return [$rating, $count];
  }

  /**
   * Get ratings for votingapi_widgets module.
   */
  public function votingapiWidgets($value, $results, $entity) {
    $rating = 0;
    $count = 0;
    $vote_type = '';
    $result_function = '';

    // Each field has its own configuration that determines the index and function to use.
    // Get vote configuration from the voting_api_field on this entity.
    $field_manager = \Drupal::service('entity_field.manager');
    $field_map = $field_manager->getFieldMapByFieldType('voting_api_field');
    $entity_type = $entity->getEntityTypeId();
    $entity_bundle = $entity->bundle();
    if (array_key_exists($entity_type, $field_map)) {
      foreach ($field_map[$entity_type] as $field_name => $data) {
        foreach ($data['bundles'] as $bundle) {
          if ($bundle == $entity_bundle) {
            if ($info = FieldConfig::loadByName($entity_type, $bundle, $field_name)) {
              $result_function = $info->getSetting('result_function');
              $vote_type = $info->getSetting('vote_type');
            }
          }
        }
      }
    }
    foreach ($results as $type => $votes) {
      switch ($type) {
        case $vote_type:
          $rating = $votes[$result_function];
          $count = $votes['vote_count'];
          break;

      }
    }
    return [$rating, $count];
  }

}
