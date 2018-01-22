<?php

namespace Drupal\Tests\schema_metatag\Functional;

use Drupal\Tests\schema_metatag\Functional\SchemaMetatagTagsTestBase;

/**
 * Tests that each of the SchemaMetatagTest Metatag base tags work correctly.
 *
 * @group schema_metatag
 * @group schema_metatag_base
 */
class SchemaMetatagTagsTest extends SchemaMetatagTagsTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    // This module.
    'schema_metatag_test',

    // Required to test the list element.
    'views',
  ];

  /**
   * {@inheritdoc}
   */
  public $module_name = 'schema_metatag_test';

  /**
   * {@inheritdoc}
   */
  public $schema_tags_namespace = '\\Drupal\\schema_metatag_test\\Plugin\\metatag\\Tag\\';

  /**
   * {@inheritdoc}
   */
  public $schema_tags = [
    'schema_metatag_test_type' => 'SchemaMetatagTestType',
    'schema_metatag_test_address' => 'SchemaMetatagTestAddress',
    'schema_metatag_test_aggregate_rating' =>'SchemaMetatagTestAggregateRating',
    'schema_metatag_test_date' => 'SchemaMetatagTestDate',
    'schema_metatag_test_duration' => 'SchemaMetatagTestDuration',
    'schema_metatag_test_geo' => 'SchemaMetatagTestGeo',
    //'schema_metatag_test_has_part' => 'SchemaMetatagTestHasPart',
    'schema_metatag_test_image' => 'SchemaMetatagTestImage',
    'schema_metatag_test_is_accessible_for_free' => 'SchemaMetatagTestIsAccessibleForFree',
    //'schema_metatag_test_item_list' => 'SchemaMetatagTestItemList',
    'schema_metatag_test_main_entity_of_page' => 'SchemaMetatagTestMainEntityOfPage',
    'schema_metatag_test_name' => 'SchemaMetatagTestName',
    'schema_metatag_test_offer' => 'SchemaMetatagTestOffer',
    'schema_metatag_test_organization' => 'SchemaMetatagTestPersonOrg',
    'schema_metatag_test_place' => 'SchemaMetatagTestPlace',
  ];

}
