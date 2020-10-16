<?php

namespace CollectionEntriesFilters\Controller;

use \Cockpit\AuthController;

/**
 * Admin controller class.
 */
class Admin extends AuthController {
  public function index() {
    $filters = $this->app->module("collectionentriesfilters")->loadFilters();
    return $this->render('collectionentriesfilters:views/settings/index.php', ['filters' => $filters]);
  }
}
