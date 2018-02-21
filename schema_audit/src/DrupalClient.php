<?php

namespace Drupal\schema_audit;

class DrupalClient {

  protected $baseUrl;

  /**
   * Construct a Drupal.org client object.
   */
  public function __construct() {
    $this->baseUrl = 'https://cgit.drupalcode.org/schema_metatag/tree/';
  }

  /**
   * Retrieve and decode object data from Drupal.org.
   *
   * Use DomDocument to parse the code pages posted on Drupal.org.
   *
   * @param string $url
   *   The url of Drupal.org data to retrieve.
   * @param string $version
   *   The Drupal code version.
   *
   * @return object
   *   A DomDocument object.
   */
  public function getDomDocument($url = '', $version = 'D8') {

    if (empty($url)) {
      $url = $this->baseUrl;
    }
    if ($version == 'D7') {
      $url .= '?h=7.x-1.x';
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
   * Retrieve objects and properties.
   *
   * @param string $version
   *   The Drupal code version.
   *
   * @return array
   *   An array of data about Drupal objects and properties.
   */
  public function parseDrupal($version = 'D8') {
    $plugin_manager = \Drupal::service('plugin.manager.metatag.tag');
    $items = [];
    if ($directories = $this->getDirectoryList($this->baseUrl, $version)) {
      foreach ($directories as $name => $dir) {
        $result = [];
        $module_name = $dir->nodeValue;
        if (in_array($module_name, ['schema_article_example', 'schema_votingapi'])) {
          continue;
        }
        $result['module'] = $module_name;
        $prefix = $module_name == 'src' ? $this->baseUrl : $this->baseUrl . $module_name;
        $url = $prefix. '/src/Plugin/metatag/Group';
        if ($pages = $this->getPageList($url, $version)) {
          foreach ($pages as $page) {
            $object = $this->parseClassName($page->nodeValue, '');
            $class = str_replace('.php', '', $page->nodeValue);
            $result['object'] = $object;
            $result['class'] = $class;
          }
        }
        $tag_url = $prefix . '/src/Plugin/metatag/Tag';
        if ($tags = $this->getPageList($tag_url, $version)) {
          foreach ($tags as $tag_name => $tag) {
            $name = lcfirst($this->parseClassName($tag_name, $module_name));
            $result['properties'][$name] = $name;
          }
        }
        $items[$object] = $result;
      }
    }
    return $items;
  }

  /**
   * Convert a Drupal file name into the corresponding Schema.org object name.
   *
   * @param string $name
   *   The file name.
   * @param string $module_name
   *   The name of the module.
   *
   * @return string
   *   The adjusted name.
   */
  public function parseClassName($name, $module_name) {
    $parts = explode('_', $module_name);
    foreach ($parts as $i => $part) {
      $parts[$i] = ucfirst($part);
    }
    $module_name = implode($parts);
    $replace = [
      $module_name,
      'Schema',
      'Base',
      '.php'
    ];
    return str_replace($replace, '', $name) ;
  }

  /**
   * Retrieve an array of directories on a code listing page.
   *
   * @param string $url
   *   The url of Drupal.org data to retrieve.
   * @param string $version
   *   The Drupal code version.
   *
   * @return array
   *   An array of directory dom objects.
   */
  public function getDirectoryList($url, $version = 'D8') {
    if ($dom = $this->getDomDocument($url, $version)) {
      if ($table = $this->getTable($dom, $version)) {
        return $this->getDirectories($table, $version);
      }
    }
    return FALSE;
  }

  /**
   * Retrieve an array of pages on a code listing page.
   *
   * @param string $url
   *   The url of Drupal.org data to retrieve.
   * @param string $version
   *   The Drupal code version.
   *
   * @return array
   *   An array of page dom objects.
   */
  public function getPageList($url, $version = 'D8') {
    if ($dom = $this->getDomDocument($url, $version)) {
      if ($table = $this->getTable($dom, $version)) {
        return $this->getFileNames($table, $version);
      }
    }
    return FALSE;
  }

  /**
   * Parse the code list table out of a D.O. code listing page.
   *
   * @param string $dom
   *   A DomDocument object.
   * @param string $version
   *   The Drupal code version.
   *
   * @return object
   *   A DomDocument table object.
   */
  public function getTable($dom, $version = 'D8') {
    if ($dom) {
      foreach ($dom->getElementsByTagName('table') as $table) {
        if ($table->getAttribute('summary') == 'tree listing') {
          return $table;
        }
      }
    }
    return FALSE;
  }

  /**
   * Parse subdirectories td elements out of a D.O. code listing page.
   *
   * @param object $table
   *   A DomDomcument table object.
   * @param string $version
   *   The Drupal code version.
   *
   * @return array
   *   An array of directory dom objects.
   */
  public function getDirectories($table, $version = 'D8') {
    $items = [];
    if ($table) {
      foreach ($table->getElementsByTagName('tr') as $tr) {
        foreach ($tr->getElementsByTagName('td') as $td) {
          foreach ($td->getElementsByTagName('a') as $a) {
            if ($a->getAttribute('class') == 'ls-dir') {
              if ($td->nodeValue != 'tests') {
                $items[$td->nodeValue] = $td;
              }
            }
          }
        }
      }
    }
    return $items;
  }

  /**
   * Parse file names out of a D.O. code listing page.
   */
  public function getFileNames($table, $version = 'D8') {
    $items = [];
    if ($table) {
      foreach ($table->getElementsByTagName('tr') as $tr) {
        foreach ($tr->getElementsByTagName('td') as $td) {
          foreach ($td->getElementsByTagName('a') as $a) {
            if ($a->getAttribute('class') == 'ls-blob php') {
              $items[$td->nodeValue] = $td;
            }
          }
        }
      }
    }
    return $items;
  }

}
