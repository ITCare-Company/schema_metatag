<?php

namespace Drupal\schema_audit;


class GoogleClient {

  /**
   * Retrieve and decode a response from a remote client.
   *
   * @type url
   *   The url of the document to retrieve.
   *
   * @return object
   *   A DomDocument.
   *
   */
  public function getDomDocument($url = '') {

    // If no url is defined, use the primary guide page.
    if (empty($url)) {
      $url = 'https://developers.google.com/search/docs/guides/search-gallery';
    }

    try {
      $doc = new \DOMDocument();
      libxml_use_internal_errors(true);
      $doc->loadHTMLFile($url);
      $doc->preserveWhiteSpace = false;
      return $doc;
    }
    catch (\Exception $e) {
      watchdog_exception('schema_audit', $e);
    }
    return FALSE;
  }

  /**
   * Parse object and property data from Google.
   *
   * @return array
   *   Return an associative array of objects and properties.
   */
  public function parseGoogle() {
    $objects = $this->getObjects();
    foreach ($objects as $key => $object) {
      if (!empty($object['url'])) {
        $objects[$key]['properties'] = $this->getProperties($object['url']);
      }
    }
    return $objects;
  }

  /**
   * Retrieve objects.
   *
   * @return array
   *   An array of objects and the info about each.
   */
  public function getObjects() {
    $items = [];
    $doc = $this->getDomDocument();
    foreach ($doc->getElementsByTagName('table') as $table) {
      foreach ($table->getElementsByTagName('tr') as $row) {
        if ($row->getElementsByTagName('h3')->item(0)) {
          $result = [];
          $result['object'] = $row->getElementsByTagName('h3')->item(0)->nodeValue;
          $result['description'] = strip_tags($row->getElementsByTagName('p')->item(0)->nodeValue);
          if ($row->getElementsByTagName('a')->item(0)) {
            $url = $row->getElementsByTagName('a')->item(0)->getAttribute('href');
            $result['url'] = $url;
          }
          $items[] = $result;
        }
      }
    }
    return $items;
  }

  /**
   * Retrieve object properties.
   *
   * @param string $url
   *   The url of the Google guide for an object.
   *
   * @return array
   *   An array of properties and the info about each.
   */
  public function getProperties($url) {
    $items = [];
    $i = 0;
    if ($url && $guide = $this->getDomDocument($url)) {
      foreach ($guide->getElementsByTagName('table') as $table) {
        $classes = explode(' ', $table->getAttribute('class'));
        if (in_array('properties', $classes)) {
          foreach ($table->getElementsByTagName('tr') as $row) {
            $td = $row->getElementsByTagName('td');
            if ($td->item(0) && $td->item(1)) {
              $label = $td->item(0)->nodeValue;
              $text = $td->item(1)->nodeValue;
              $items[$i][$label] = strip_tags($text);
            }
          }
          $i++;
        }
      }
    }
    return $items;
  }

}
