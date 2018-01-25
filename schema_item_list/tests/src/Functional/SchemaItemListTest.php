<?php

namespace Drupal\Tests\schema_item_list\Functional;

use Drupal\Tests\schema_metatag\Functional\SchemaMetatagTagsTestBase;

/**
 * Tests that each of the Schema Metatag Articles tags work correctly.
 *
 * @group schema_metatag
 * @group schema_item_list
 */
class SchemaItemListTest extends SchemaMetatagTagsTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['schema_item_list'];

  /**
   * {@inheritdoc}
   */
  public $moduleName = 'schema_item_list';

  /**
   * {@inheritdoc}
   */
  public $schemaTagsNamespace = '\\Drupal\\schema_item_list\\Plugin\\metatag\\Tag\\';

  /**
   * {@inheritdoc}
   */
  public $schemaTags = [
    //'schema_item_list_element' => 'SchemaItemListElement',
    'schema_item_list_id' => 'SchemaItemListId',
    'schema_item_list_main_entity_of_page' => 'SchemaItemListMainEntityOfPage',
    'schema_item_list_type' => 'SchemaItemListType',
  ];

  /**
   * {@inheritdoc}
   */
  public function getKey($tag_name) {
    switch ($tag_name) {
      // The tag itemListElement doesn't match the pattern of other tag names.
      case 'schema_item_list_element':
        return 'itemListElement';
        break;
      default:
        return parent::getKey($tag_name);
        break;
    }
  }
}
