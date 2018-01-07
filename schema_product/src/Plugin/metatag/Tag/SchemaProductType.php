<?php

namespace Drupal\schema_product\Plugin\metatag\Tag;

use \Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;

/**
 * Provides a plugin for the 'type' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_product_type",
 *   label = @Translation("@type"),
 *   description = @Translation("The type of product (fixed by standard)."),
 *   name = "@type",
 *   group = "schema_product",
 *   weight = -5,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class SchemaProductType extends SchemaNameBase {

  /**
   * Generate a form element for this meta tag.
   */
  public function form(array $element = []) {
    $form = [
      '#type' => 'select',
      '#title' => $this->label(),
      '#description' => $this->description(),
      '#empty_option' => t('- None -'),
      '#empty_value' => '',
      '#options' => $this->types(),
      '#default_value' => $this->value(),
    ];
    return $form;
  }

  /**
   * Return a list of organization types.
   */
  private function types() {
    $types = [
      'Product',
    ];
    return array_combine($types, $types);
  }
}