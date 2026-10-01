<?php

declare(strict_types=1);

namespace Drupal\schema_metatag\Attribute;

use Drupal\Component\Plugin\Attribute\Plugin;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Defines a Schema property type attribute object.
 *
 * @see \Drupal\schema_metatag\Annotation\SchemaPropertyType
 * @see \Drupal\schema_metatag\Plugin\schema_metatag\PropertyTypeManager
 * @see plugin_api
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
class SchemaPropertyType extends Plugin {

  /**
   * Constructs a SchemaPropertyType attribute.
   *
   * @param string $id
   *   The plugin ID.
   * @param \Drupal\Core\StringTranslation\TranslatableMarkup $label
   *   The label of the plugin.
   * @param string|null $property_type
   *   (optional) The type of Schema.org property being defined.
   * @param array|null $sub_properties
   *   (optional) A key/value array of sub-properties used in this property.
   * @param array|null $tree_parent
   *   (optional) An array of the top level Schema.org class(es) used by this
   *   property type.
   * @param int|null $tree_depth
   *   (optional) The depth used for $tree_parent to create the desired array
   *   of @type values.
   */
  public function __construct(
    public readonly string $id,
    public readonly TranslatableMarkup $label,
    public readonly ?string $property_type = NULL,
    public readonly ?array $sub_properties = NULL,
    public readonly ?array $tree_parent = NULL,
    public readonly ?int $tree_depth = NULL,
  ) {}

}
