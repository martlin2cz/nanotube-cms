<?php

interface AbstractHeadTemplate {

	public function prepare_head($apc);

	public function render_head($apc);

}
?>
