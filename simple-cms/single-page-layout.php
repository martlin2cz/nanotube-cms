<?php
	/**
	 * Implementation of function templating single page layout.
	 * */
?>
<?php require_once('cms-impl.php'); ?>

<?php function single_page_layout_template($headers, $title, $footer) { ?>

<html>
	<head>
		<title><?= get_web_title() ?></title>
		<?= $headers ?>
	</head>
	<body>

	<header>
		<span class="spl-title">
			<?php if ($title) { ?>
				<?= $title ?>
			<?php } else { ?>
				<h1><?= get_web_title() ?></h1> 
			<?php } ?>
		</span>

		<nav>
			<ol class="spl-menu">	
				<?php	foreach (get_web_pages() as $id => $page) { ?>
					<li class="spl-menu-item">
						<a href="#<?= $id ?>">
							<?= get_title_of_page($page) ?>
						</a>
					</li>
				<?php } ?>
			</ol>
		</nav>
	</header>

	<main>
		<?php	foreach (get_web_pages() as $id => $page) { ?>
			<article id="<?= $id ?>">
				<h2 class="spl-article-title"><?= get_title_of_page($page) ?></h2>
				
				<div class="spl-article-content">	
					<?php insert_content_of_page($page); ?>
				</div>
			</article>
		<?php } ?>
	<main>

	<?php if ($footer) { ?>
		<footer>
			<?= $footer ?>	
		</footer>
	<?php } ?>

</body>
</html>
<?php } ?>
