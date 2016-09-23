<html>
	<head>
		<!--TODO -->
		<title>Single page layout</title>
	</head>
	<body>
	<?php
		$sites = new Sites();

		foreach ($sites->all_sites() as $site) {
			echo "<h1>" . $site->get_title() . " (" . $site->get_id() . ")</h1>\n";
			echo "<div>" . $site->get_content() . "</div>\n";
		} 
	?>
	</body>
</html>
