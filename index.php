<?php 
	require_once('simple-cms/single-page-layout.php'); 
	
single_page_layout_template(
	/* specify HTML head headers here */	
'		<!-- headers -->
		<script type="text/javascript" src="jquery.js"></script>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<script type="text/javascript" src="scripts.js"></script>
', 
	/* specify title here */
'		<!-- title -->
		<i>(logo)</i>
',
/* specify footer here */
'		<!-- footer -->
		<p><em>Powered by <a href="https://github.com/martlin2cz/nanotube-cms">nanotube-cms<a/></em></p>
');	



?>
