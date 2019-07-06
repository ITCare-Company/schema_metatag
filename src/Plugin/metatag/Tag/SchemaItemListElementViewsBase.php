<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

use Drupal\Core\Entity\Plugin\DataType\EntityAdapter;

/**
 * All Schema.org views itemListElement tags should extend this class.
 */
class SchemaItemListElementViewsBase extends SchemaItemListElementBase {

  /**
   * {@inheritdoc}
   */
  public function form(array $element = []) {
    $form = parent::form($element);
    $form['#description'] = $this->t("Provide the machine name of the view, the machine name of the display, and any argument values, separated by colons, i.e. 'view_name:display_id' or 'view_name:display_id:article. This will create a <a href=':url'>Summary View</a> list, which assumes each list item contains the url to a view page for the entity. The view rows should contain content (like teaser views) rather than fields for this to work correctly.", [':url' => 'https://developers.google.com/search/docs/guides/mark-up-listings']);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    return 'frontpage:page_1';
  }

  /**
   * {@inheritdoc}
   */
  public static function getItems($input_value) {
    $values = [];
    $args = explode(':', $input_value);

    // Allow modules to alter the arguments passed to views_get_view_result().
    \Drupal::moduleHandler()->alter('schema_item_list_views_get_view_result', $args);

    if (!empty($args) && $result = call_user_func_array('views_get_view_result', $args)) {
      // Get the view results.
      $key = 1;
      foreach ($result as $item) {
        // If this is a display that does not provide an entity in the result,
        // there is really nothing more to do.
        $entity = static::getEntityFromRow($item);
        if (!$entity) {
          return '';
        }
        // Get the absolute path to this entity.
        $url = $entity->toUrl()->setAbsolute()->toString();
        $values[$key] = [
          '@id' => $url,
          'name' => $entity->label(),
          'url' => $url,
        ];
        $key++;
      }
    }
    return $values;
  }

  /**
   * Tries to retrieve an entity from a Views row.
   *
   * @param $row
   *   The Views row
   *
   * @return \Drupal\Core\Entity\EntityInterface|null
   */
  protected static function getEntityFromRow($row) {
    if (!empty($row->_entity)) {
      return $row->_entity;
    }

    if (isset($row->_object) && $row->_object instanceof EntityAdapter) {
      return $row->_object->getValue();
    }

    return NULL;
  }

}
