<?php

/**
 * Defines interface of the template - just needs to render itself into html
 * */
interface AbstractPageTemplate {

	/**
	 * Renders page into html document
	 * */
	public function render_template();

}

?>
