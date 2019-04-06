<?php

require_once(__DIR__ . '/../../AbstractPlugin.php');
require_once(__DIR__ . '/database/Photos.php');
require_once(__DIR__ . '/../../../nanoadmin/impl/WebTools.php');


class StandartPhotogalleryPlugin extends AbstractPlugin {
	private $photos;

	public function __construct() {
		parent::__construct(__FILE__, 'Standart Photogallery');
		$this->photos = new Photos();
	}

	public function get_description() {
		return "Plugin displaying photos in galleries. Allows to upload custom images and work with galleries.";
	}

	public function get_usage() {
		return "<code>&lt;?php plugin_StandartPhotogallery('<em>gallery id</em>'); ?&gt;</code>";	
	}

	public function get_status() {
		if ($this->photos->is_ok()) {
			return PLUGIN_STATUS_INSTALLED;
		} else {
			return PLUGIN_STATUS_UNINSTALLED;
		}
	}

	public function install() {
		return $this->photos->install();
	}
	
	public function uninstall() {
		return $this->photos->uninstall();
	}
	public function render_plugin_content($config, $apc, $args) { ?>
		<?php $gallery_id = $args[0]; ?>
		<?php 
			if (!$this->yet_on_site()) {
				$apc->add_pre_head(
					'<script type="text/javascript" src="' . $this->resource('js/jquery.js') . '"></script>' .
					'<link rel="stylesheet" href="' .  $this->resource('lightGallery/css/lightgallery.css') . '" type="text/css"></style>' .
					'<script type="text/javascript" src="' . $this->resource('lightGallery/js/lightgallery.js') . '"></script>' . 
					'<script type="text/javascript" src="' . $this->resource('lightGallery/js/lg-fullscreen.js') . '"></script>' .
					'<script type="text/javascript" src="' . $this->resource('lightGallery/js/lg-pager.js') . '"></script>' 
				);	
	
				$apc->add_post_head(
					'<link rel="stylesheet" href="' .  $this->resource('css/custom-styles.css') . '" type="text/css"></style>' . 
					'<script type="text/javascript" src="' . $this->resource('js/run-gallery.js') . '"></script>' 
				);	
			}
		?>
		<div class="gallery">
		<?php foreach ($this->photos->photos_of($gallery_id) as $photo) { ?>
			<?php $url = "nanotube-cms/plugins/standart/StandartPhotogallery/impl/image.php?gallery=" . $gallery_id . "&amp;name=" . $photo->get_file_name(); ?>
			<a href="<?= $url ?>" data-sub-html="<?= $photo->get_description() ?>">
				<img src="<?= $url ?>" 
					alt="<?= $photo->get_title() ?>"
 	      	class="<?= $this->photos->get_css_of_thumbnail($photo) ?>">
			</a>
		<?php } ?>
		</div>
	<?php }

	static public function put($gallery_id) {
		$plugin = new StandartPhotogalleryPlugin();
		$plugin->render_plugin($gallery_id);	
	}
}

function plugin_StandartPhotogallery($gallery_id) {
	StandartPhotogalleryPlugin::put($gallery_id);
}

?>
