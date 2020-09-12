<?php

namespace Drupal\schema_metatag\Plugin\schema_metatag\PropertyType;

use Drupal\schema_metatag\Plugin\schema_metatag\PropertyTypeBase;

/**
 * Provides a plugin for the 'NutritionInformation' Schema.org property type.
 *
 * @SchemaPropertyType(
 *   id = "nutrition_information",
 *   label = @Translation("NutritionInformation"),
 *   tree_parent = {
 *     "NutritionInformation",
 *   },
 *   tree_depth = -1,
 *   property_type = "NutritionInformation",
 *   sub_properties = {
 *     "@type" = {
 *       "id" = "type",
 *       "label" = @Translation("@type"),
 *       "description" = "",
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "servingSize" = {
 *       "id" = "text",
 *       "label" = @Translation("servingSize"),
 *       "description" = @Translation("The serving size, in terms of the number of volume or mass."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "calories" = {
 *       "id" = "text",
 *       "label" = @Translation("calories"),
 *       "description" = @Translation("The number of calories."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "carbohydrateContent" = {
 *       "id" = "mass",
 *       "label" = @Translation("carbohydrateContent"),
 *       "description" = @Translation("The number of grams of carbohydrates."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "cholesterolContent" = {
 *       "id" = "mass",
 *       "label" = @Translation("cholesterolContent"),
 *       "description" = @Translation("The number of milligrams of cholesterol."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "fiberContent" = {
 *       "id" = "mass",
 *       "label" = @Translation("fiberContent"),
 *       "description" = @Translation("The number of grams of fiber."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "proteinContent" = {
 *       "id" = "mass",
 *       "label" = @Translation("proteinContent"),
 *       "description" = @Translation("The number of grams of protein."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "sodiumContent" = {
 *       "id" = "mass",
 *       "label" = @Translation("sodiumContent"),
 *       "description" = @Translation("The number of milligrams of sodium."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "sugarContent" = {
 *       "id" = "mass",
 *       "label" = @Translation("sugarContent"),
 *       "description" = @Translation("The number of grams of sugar."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "fatContent" = {
 *       "id" = "mass",
 *       "label" = @Translation("fatContent"),
 *       "description" = @Translation("The number of grams of fat."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "saturatedFatContent" = {
 *       "id" = "mass",
 *       "label" = @Translation("saturatedFatContent"),
 *       "description" = @Translation("The number of grams of saturated fat."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "unsaturatedFatContent" = {
 *       "id" = "mass",
 *       "label" = @Translation("unsaturatedFatContent"),
 *       "description" = @Translation("The number of grams of unsaturated fat."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *     "transFatContent" = {
 *       "id" = "mass",
 *       "label" = @Translation("transFatContent"),
 *       "description" = @Translation("The number of grams of trans fat."),
 *       "tree_parent" = {},
 *       "tree_depth" = -1,
 *     },
 *   },
 * )
 */
class NutritionInformation extends PropertyTypeBase {

}
