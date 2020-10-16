<?php
/**
 * @file
 * Cockpit Addon Collection Entries Filters config file.
 */

$this->module('collectionentriesfilters')->extend([
  'loadFilters' => function() {
    $entry = $this->app->storage->findOne('collectionentriesfilters');
    return json_decode($entry['filters'], true);
  },
  'saveFilters' => function($filters) {
    $existing = $this->app->storage->findOne('collectionentriesfilters');
    $entry = ["filters" => json_encode($filters)];
    if ($existing) {
      $entry['_id'] = $existing['_id'];
      $this->app->storage->save('collectionentriesfilters', $entry);
    } else {
      $this->app->storage->insert('collectionentriesfilters', $entry);
    }
    return ['success' => true];
  }
]);

// Incldude admin.
if (COCKPIT_ADMIN && !COCKPIT_API_REQUEST) {
  include_once __DIR__ . '/admin.php';
}