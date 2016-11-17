<?php

require_once(__DIR__ . '/../nanotube-cms/templates/definite/StandartSPT.php');

/**
 * Just extending the standart template. Nothing more needed to do here.
 * */
class MyTemplate extends StandartSPT {

  public function __construct($config) {                                                                                
    parent::__construct($config);
  }

}

?>
