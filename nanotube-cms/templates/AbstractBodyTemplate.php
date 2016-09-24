<?php

interface AbstractBodyTemplate {
	public function prepare_body($apc);	

	public function render_body($apc);
}
?>
