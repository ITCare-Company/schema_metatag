<?php

namespace Drupal\Tests\schema_video_object\Functional;

use Drupal\Tests\schema_metatag\Functional\SchemaMetatagTagsTestBase;

/**
 * Tests that each of the Schema Metatag Articles tags work correctly.
 *
 * @group schema_metatag
 * @group schema_video_object
 */
class SchemaVideoObjectTest extends SchemaMetatagTagsTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['schema_video_object'];

  /**
   * {@inheritdoc}
   */
  public $module_name = 'schema_video_object';

  /**
   * {@inheritdoc}
   */
  public $schema_tags_namespace = '\\Drupal\\schema_video_object\\Plugin\\metatag\\Tag\\';

  /**
   * {@inheritdoc}
   */
  public $schema_tags = [
    'schema_video_object_content_url' => 'SchemaVideoObjectContentUrl',
    'schema_video_object_description' => 'SchemaVideoObjectDescription',
    'schema_video_object_duration' => 'SchemaVideoObjectDuration',
    'schema_video_object_embed_url' => 'SchemaVideoObjectEmbedUrl',
    'schema_video_object_expires' => 'SchemaVideoObjectExpires',
    'schema_video_object_id' => 'SchemaVideoObjectId',
    'schema_video_object_interaction_count' => 'SchemaVideoObjectInteractionCount',
    'schema_video_object_main_entity_of_page' => 'SchemaVideoObjectMainEntityOfPage',
    'schema_video_object_name' => 'SchemaVideoObjectName',
    'schema_video_object_thumbnail_url' => 'SchemaVideoObjectThumbnailUrl',
    'schema_video_object_type' => 'SchemaVideoObjectType',
    'schema_video_object_upload_date' => 'SchemaVideoObjectUploadDate',
  ];

}
