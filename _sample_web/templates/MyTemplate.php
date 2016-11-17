<?php

require_once(__DIR__ . '/../nanotube-cms/templates/definite/BasicNPT.php');

/**
 * Template overriding the default one by adding the menu into the footer.
 * */
class MyTemplate extends BasicNPT {

  public function __construct($config) {                                                                                
    parent::__construct($config);
  }	

  protected function do_page_footer($apc) { ?>                                                                                         
		<p>Looking for something else? Try:</p>
		<nav><?php plugin_Menu(); ?></nav>
		
		<p>Created by <em>nanotube-cms</em>.</p>
  <?php }

}

?>
