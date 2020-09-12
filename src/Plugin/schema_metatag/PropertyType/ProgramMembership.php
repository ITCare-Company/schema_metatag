<?php

namespace Drupal\schema_metatag\Plugin\schema_metatag\PropertyType;

use Drupal\schema_metatag\Plugin\schema_metatag\PropertyTypeBase;

/**
 * Provides a plugin for the 'ProgramMembership' Schema.org property type.
 *
 * @SchemaPropertyType(
 *   id = "program_membership",
 *   label = @Translation("Action"),
 *   tree_parent = {
 *     "ProgramMembership",
 *   },
 *   tree_depth = 0,
 *   property_type = "ProgramMembership",
 *   sub_properties = {
 *     "@type" = {
 *       "id" = "type",
 *       "label" = @Translation("@type"),
 *       "description" = "",
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "name" = {
 *       "id" = "text",
 *       "label" = @Translation("name"),
 *       "description" = @Translation("The name of the item."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "programName" = {
 *       "id" = "text",
 *       "label" = @Translation("programName"),
 *       "description" = @Translation("The program providing the membership."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "alternateName" = {
 *       "id" = "text",
 *       "label" = @Translation("alternateName"),
 *       "description" = @Translation("An alias for the item."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "membershipNumber" = {
 *       "id" = "text",
 *       "label" = @Translation("membershipNumber"),
 *       "description" = @Translation("A unique identifier for the membership."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "identifier" = {
 *       "id" = "text",
 *       "label" = @Translation("identifier"),
 *       "description" = @Translation("The identifier property represents any kind of identifier for any kind of Thing, such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides dedicated properties for representing many of these, either as textual strings or as URL (URI) links."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "additionalType" = {
 *       "id" = "text",
 *       "label" = @Translation("additionalType"),
 *       "description" = @Translation("An additional type for the item, typically used for adding more specific types from external vocabularies in microdata syntax. This is a relationship between something and a class that the thing is in."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "description" = {
 *       "id" = "text",
 *       "label" = @Translation("description"),
 *       "description" = @Translation("A description of the item."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "disambiguatingDescription" = {
 *       "id" = "text",
 *       "label" = @Translation("disambiguatingDescription"),
 *       "description" = @Translation("A sub property of description. A short description of the item used to disambiguate from other, similar items. Information from other properties (in particular, name) may be necessary for the description to be useful for disambiguation."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "mainEntityOfPage" = {
 *       "id" = "url",
 *       "label" = @Translation("mainEntityOfPage"),
 *       "description" = @Translation("If this is the main content of the page, provide url of the page."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "url" = {
 *       "id" = "url",
 *       "label" = @Translation("url"),
 *       "description" = @Translation("URL of the item."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "sameAs" = {
 *       "id" = "url",
 *       "label" = @Translation("sameAs"),
 *       "description" = @Translation("Url linked to the web site, such as wikipedia page or social profiles. Multiple values may be used, separated by a comma."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "hostingOrganization" = {
 *       "id" = "organization",
 *       "label" = @Translation("hostingOrganization"),
 *       "description" = @Translation("The organization (airline, travelers' club, etc.) the membership is made with."),
 *       "tree_parent" = {
 *         "Organization",
 *       },
 *       "tree_depth" = 1,
 *     },
 *     "member" = {
 *       "id" = "organization",
 *       "label" = @Translation("member"),
 *       "description" = @Translation("A member of an Organization or a ProgramMembership. Organizations can be members of organizations; ProgramMembership is typically for individuals."),
 *       "tree_parent" = {
 *         "Organization",
 *       },
 *       "tree_depth" = 1,
 *     },
 *     "image" = {
 *       "id" = "image_object",
 *       "label" = @Translation("image"),
 *       "description" = @Translation(""),
 *       "tree_parent" = {
 *         "ImageObject",
 *       },
 *       "tree_depth" = 0,
 *     },
 *   },
 * )
 */
class ProgramMembership extends PropertyTypeBase {

}
