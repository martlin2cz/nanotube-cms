<?php

require_once(__DIR__ . '/../nanotube-cms/nanotube-cms/templates/definite/NPTWithAsideMenu.php');

/**
 * Template leaving the default just as is.
 * */
class MyTemplate extends NPTWithAsideMenu {

  public function __construct($config) {                                                                                
    parent::__construct($config);
  }
}

?>
