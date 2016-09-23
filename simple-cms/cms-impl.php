<?php
/**
 * The implementation of simple-cms framework.
 * m@rtlin, 17.-18. 8. 2016
 *
 * */

	/**
	 * The directory where are pages'contents stored. Must end with / 
	 * */
	define ('PAGES_DIR', 'pages/');

	/**
	 * The name (or path) to the web config file.
	 * */
	define ('WEB_CONFIG_FILE', 'web-config.php');
?>

<?php require_once(WEB_CONFIG_FILE); ?>

<?php
/**
 * Returns title of web.
 * */
function get_web_title() {
	return WEB_TITLE;
}

/**
 * Returns list of pages, use `foreach (get_web_pages() as $id => $page) ` to iterate over.
 * */
function get_web_pages() {
	return WEB_PAGES;
}

/**
 * Returns page of given id.
 * */
function get_page_of_id($id) {
	return WEB_PAGES[$id];
}

/**
 * Returns title of specified page.
 * */
function get_title_of_page($page) {
	return $page[0];
}

/**
 * Puts into page content of specified page (if exists!).
 * */
function insert_content_of_page($page) {
	$file = $page[1];
	$path = PAGES_DIR . $file;

	include_once($path);
}

?>
