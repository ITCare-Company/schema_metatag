<?php

/**
 * @file
 * Contains Drupal\schema_blocks\Plugin\Block\LetterAuthor.
 */

namespace Drupal\schema_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Provides a 'TestPage' block.
 *
 * @Block(
 *  id = "test_block",
 *  admin_label = @Translation("Test structured data on Google."),
 *   context = {
 *     "node" = @ContextDefinition("entity:node", label = @Translation("Node"))
 *   }
 * )
 */
class TestBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];

    $heading = '<h3>Test this page</h3>';
    $description = "<p>Test the results of this page by checking it on Google's structured content tester.</p>";

    // Get current path.
    $options = ['absolute' => 'true'];
    $drupal_url = Url::fromRoute('<current>', [], $options)->toString();

    // Create the Google path with a fragment identifying the Drupal path.
    $google_url = Url::fromUri('https://search.google.com/structured-data/testing-tool' . '#url=' . $drupal_url);

    // Finally, create a link to Google that includes the current path.
    $link = Link::fromTextAndUrl(t('Test on Google'), $google_url);

    $build = [
      'description' => [
        '#type' => 'markup',
        '#markup' => $heading . $description,
      ],
      'description_link' =>  [
        $link->toRenderable(),
      ],
    ];

    return $build;
  }

}
