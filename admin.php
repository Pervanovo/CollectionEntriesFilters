<?php
$this("acl")->addResource('collectionentriesfilters', [
  'manage'
]);

/**
 * Add filters to collection entries page
 */
$this->on('collections.entries', function ($collection) use ($app) {
  $filters = $app->module("collectionentriesfilters")->loadFilters();
  $this->renderView("collectionentriesfilters:views/partials/filters.php", ['collection' => $collection, 'filters' => $filters[$collection['name']]]);
});

/**
 * Initialize addon settings page
 */
$app->on('admin.init', function () use ($app)  {
  $this->bindClass('CollectionEntriesFilters\\Controller\\Admin', 'settings/collection-entries-filters');
});

/*
 * Add menu entry if the user has access to group stuff
 */
$this->on('cockpit.view.settings.item', function () use ($app) {
  if ($app->module('cockpit')->hasaccess('collectionentriesfilters', 'manage')) {
     $this->renderView("collectionentriesfilters:views/partials/settings.php");
  }
});
