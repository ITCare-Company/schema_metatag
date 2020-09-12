<?php

namespace Drupal\schema_metatag\Plugin\schema_metatag\PropertyType;

use Drupal\schema_metatag\Plugin\schema_metatag\PropertyTypeBase;

/**
 * Provides a plugin for the 'Event' Schema.org property type.
 *
 * @SchemaPropertyType(
 *   id = "event",
 *   label = @Translation("Event"),
 *   tree_parent = {
 *     "Event",
 *   },
 *   tree_depth = 0,
 *   property_type = "Event",
 *   sub_properties = {
 *     "@type" = {
 *       "id" = "type",
 *       "label" = @Translation("@type"),
 *       "description" = "",
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "@id" = {
 *       "id" = "text",
 *       "label" = @Translation("@id"),
 *       "description" = @Translation("Globally unique @id of the Event, usually a url, used to to link other properties to this object."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "name" = {
 *       "id" = "text",
 *       "label" = @Translation("name"),
 *       "description" = @Translation("Name of the Event."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "url" = {
 *       "id" = "url",
 *       "label" = @Translation("url"),
 *       "description" = @Translation("Absolute URL of the canonical Web page for the Event."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "startDate" = {
 *       "id" = "date",
 *       "label" = @Translation("startDate"),
 *       "description" = @Translation("Start date of the Event."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "location" =  {
 *       "id" = "place",
 *       "label" = @Translation("location"),
 *       "description" = @Translation("The location of the event."),
 *       "tree_parent" = {
 *         "Place",
 *         "VirtualLocation",
 *       },
 *       "tree_depth" = 1,
 *     },
 *   },
 * )
 */
class Event extends PropertyTypeBase {

}
