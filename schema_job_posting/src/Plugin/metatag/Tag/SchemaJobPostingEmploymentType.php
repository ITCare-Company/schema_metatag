<?php

namespace Drupal\schema_job_posting\Plugin\metatag\Tag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;

/**
 * Provides a plugin for the 'employmentType' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_job_posting_employment_type",
 *   label = @Translation("employmentType"),
 *   description = @Translation("RECOMMENDED BY GOOGLE. The employment type of the jobPosting."),
 *   name = "employmentType",
 *   group = "schema_job_posting",
 *   weight = -5,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class SchemaJobPostingEmploymentType extends SchemaNameBase {

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
   * Return a list of employment types.
   */
  private function types() {
    $types = [
      'FULL-TIME',
      'PART-TIME',
      'CONTRACT',
      'TEMPORARY',
      'SEASONAL',
      'INTERNSHIP',
    ];
    return array_combine($types, $types);
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    return 'FULL-TIME';
  }

}
