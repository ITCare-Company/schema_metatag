<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

use Drupal\schema_metatag\SchemaMetatagManager;

/**
 * Schema.org CreativeWork trait.
 */
trait SchemaCreativeWorkTrait {

  use SchemaPersonOrgTrait, SchemaActionTrait {
    SchemaPersonOrgTrait::personOrgFormKeys insteadof SchemaActionTrait;
    SchemaPersonOrgTrait::personOrgForm insteadof SchemaActionTrait;
    SchemaPersonOrgTrait::imageFormKeys insteadof SchemaActionTrait;
    SchemaPersonOrgTrait::imageForm insteadof SchemaActionTrait;
  }

  /**
   * The keys for this form.
   *
   * @param string $object_type
   *   Optional, limit the keys to those that are required for a specific
   *   object type.
   *
   * @return array
   *   Return an array of the form keys.
   */
  public static function creativeWorkFormKeys($object_type = NULL) {
    $list = ['@type'];
    $types = static::creativeWorkObjects();
    foreach ($types as $type) {
      if ($type == $object_type || empty($object_type)) {
        $list = array_merge(array_keys(static::creativeWorkProperties($type)), $list);
      }
    }
    $list = array_merge(array_keys(static::creativeWorkProperties('All')), $list);
    return $list;
  }

  /**
   * Create the form element.
   *
   * @param array $input_values
   *   An array of values passed from a higher level form element to this.
   *
   * @return array
   *   The form element.
   */
  public function creativeWorkForm(array $input_values) {

    $input_values += SchemaMetatagManager::defaultInputValues();
    $value = $input_values['value'];

    // Get the id for the nested @type element.
    $selector = ':input[name="' . $input_values['visibility_selector'] . '[' . $input_values['visibility_type'] . ']"]';
    $visibility = ['invisible' => [$selector => ['value' => '']]];

    $form['#type'] = 'fieldset';
    $form['#title'] = $input_values['title'];
    $form['#description'] = $input_values['description'];
    $form['#tree'] = TRUE;

    $types = static::creativeWorkObjects();
    $options = array_combine($types, $types);
    $form['@type'] = [
      '#type' => 'select',
      '#title' => $this->t('@type'),
      '#default_value' => !empty($value['@type']) ? $value['@type'] : '',
      '#empty_option' => t('- None -'),
      '#empty_value' => '',
      '#options' => $options,
      '#required' => $input_values['#required'],
    ];

    // Build the form one object type at a time, using the visibility settings
    // to hide/show only form elements for the selected type.
    foreach ($types as $type) {

      // Properties specific to an object type appear only for that type.
      // Weight these properties ahead of general properties.
      $properties = static::creativeWorkProperties($type);
      foreach ($properties as $key => $property) {
        $property_visibility = ['visible' => [$selector => ['value' => $type]]];

        if (empty($property['formKeys'])) {
          $form[$key] = [
            '#type' => 'textfield',
            '#title' => $key,
            '#default_value' => !empty($value[$key]) ? $value[$key] : '',
            '#empty_option' => t('- None -'),
            '#empty_value' => '',
            '#required' => $input_values['#required'],
            '#description' => $property['description'],
            '#states' => $property_visibility,
            '#weight' => 0,
          ];
        }
        else {
          $sub_values = [
            'title' => $key,
            'description' => $property['description'],
            'value' => !empty($value[$key]) ? $value[$key] : [],
            '#required' => $input_values['#required'],
            'visibility_selector' => $input_values['visibility_selector'] . '[' . $key . ']',
            'visibility_type' => '@type',
          ];
          $method = $property['form'];
          $form[$key] = $this->$method($sub_values);
          $form[$key]['#states'] = $property_visibility;
          $form[$key]['#weight'] = 0;
        }
      }

      // Properties common to all objects appear for any object type.
      // Weight these after the object-specific properties.
      $properties = static::creativeWorkProperties('All');
      foreach ($properties as $key => $property) {

        if (empty($property['formKeys'])) {
          $form[$key] = [
            '#type' => 'textfield',
            '#title' => $key,
            '#default_value' => !empty($value[$key]) ? $value[$key] : '',
            '#empty_option' => t('- None -'),
            '#empty_value' => '',
            '#required' => $input_values['#required'],
            '#description' => $property['description'],
            '#states' => $visibility,
            '#weight' => 5,
          ];
        }
        else {
          $sub_values = [
            'title' => $key,
            'description' => $property['description'],
            'value' => !empty($value[$key]) ? $value[$key] : [],
            '#required' => $input_values['#required'],
            'visibility_selector' => $input_values['visibility_selector'] . '[' . $key . ']',
          ];
          $method = $property['form'];
          $form[$key] = $this->$method($sub_values);
          $form[$key]['#states'] = $visibility;
          $form[$key]['#weight'] = 5;
        }
      }
    }

    return $form;
  }

  /**
   * All object types.
   *
   * @return array
   *   An array of all possible object types.
   */
  public static function creativeWorkObjects() {
    return [
      'CreativeWork',
      'Article',
      'Book',
      'Blog',
      'Course',
      'Review',
      'Movie',
      'MusicComposition',
      'MusicPlaylist',
      'MediaObject',
      'Clip',
      'CreativeWorkSeason',
      'CreativeWorkSeries',
      'Episode',
      'WebPage',
      'WebSite',
    ];
  }

  /**
   * Return an array of the unique properties for an object type.
   *
   * @param string $object_type
   *   The type of object. Use an object name for properties specific to that
   *   object type. Use 'All' for general properties that apply
   *   to all objects.
   *
   * @return array
   *   An array of all the unique properties for that type.
   */
  public static function creativeWorkProperties($object_type) {
    switch ($object_type) {

      case 'Book':
        return [
          'isbn' => [
            'class' => 'SchemaNameBase',
            'formKeys' => '',
            'form' => '',
            'description' => "The ISBN of the book.",
          ],
          'bookEdition' => [
            'class' => 'SchemaNameBase',
            'formKeys' => '',
            'form' => '',
            'description' => "The edition of the book.",
          ],
          'bookFormat' => [
            'class' => 'SchemaNameBase',
            'formKeys' => '',
            'form' => '',
            'description' => "The format of the book (comma-separated), i.e. http://schema.org/Hardcover,http://schema.org/Paperback,http://schema.org/EBook",
          ],
        ];

      case 'All':
        return [
          '@id' => [
            'class' => 'SchemaNameBase',
            'formKeys' => '',
            'form' => '',
            'description' => "Globally unique @id of the thing, usually a url, used to to link other properties to this object.",
          ],
          'name' => [
            'class' => 'SchemaNameBase',
            'formKeys' => '',
            'form' => '',
            'description' => "The name of the work.",
          ],
          'author' => [
            'class' => 'SchemaPersonOrgBase',
            'formKeys' => 'personOrgFormKeys',
            'form' => 'personOrgForm',
            'description' => "The author of the work.",
          ],
          'url' => [
            'class' => 'SchemaNameBase',
            'formKeys' => '',
            'form' => '',
            'description' => "Absolute URL of the canonical Web page for the work.",
          ],
          'sameAs' => [
            'class' => 'SchemaNameBase',
            'formKeys' => '',
            'form' => '',
            'description' => "Urls and social media links, comma-separated list of absolute URLs.",
          ],
          'datePublished' => [
            'class' => 'SchemaNameBase',
            'formKeys' => '',
            'form' => '',
            'description' => "Publication date.",
          ],
          'potentialAction' => [
            'class' => 'SchemaActionBase',
            'formKeys' => 'actionFormKeys',
            'form' => 'actionForm',
            'description' => "Potential action for the work, like a ReadAction.",
          ],
        ];

      default:
        return [];
    }
  }

}
