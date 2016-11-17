<?php

require_once(__DIR__ . '/../../AbstractPlugin.php');

class BasicPhotogalleryPlugin extends AbstractPlugin {

	public function __construct() {
		parent::__construct(__FILE__, 'Basic photogalerry');
	}

	public function get_description() {
		return "A simple lightbox photogalery. Shows images speficied by URL.";
	}

	public function get_usage() {
		return "Use: <code>&lt;?php plugin_BasicPhotogallery('http://first.im/age.png', '/second.jpg', ...); ?&gt</code>.";	
	}

  public function get_status() {
    return PLUGIN_STATUS_OK;
  }

  public function install() {
    return true;
  }
  
  public function uninstall() {                                                                                                        
    return true;
  }


	public function render_plugin_content($config, $apc, $args) {
		$images = $args[0];
	?>
	<div class="gallery">
		<?php foreach ($images as $image) { ?>
			<a href="<?= $image ?>"><img src="<?= $image ?>" alt="image" style="width: 25%;"></a>
		<?php } ?>
	</div>
	<?php
		//if ($this->get_instances_count() == 0) {	
			$apc->add_pre_head("<!- Basic Photogallery -->\n"
				. "<script src=\"https://code.jquery.com/jquery-3.1.1.min.js\"></script>\n"
				. "<link href=\"css/lightgallery/lightgallery.css\" rel=\"stylesheet\">\n"
				. "<script src=\"js/lightgallery/lightgallery.js\"></script>\n"
				. "<script src=\"js/lightgallery/lg-fullscreen.js\"></script>\n"
				. "<script src=\"js/lightgallery/lg-pager.js\"></script>\n"
				. "<!-- end of Basic Photogalerry -->\n");
				
				//FIXME EEE!!!!
				?><script> $('ready', function() {
					var config = { download: false };
					$('.gallery').each(function(i) { 	$(this).lightGallery(config); });
				});
				</script><?php
		//}
	}

	static public function put($images) {
		$plugin = new BasicPhotogalleryPlugin();
		$plugin->render_plugin($images);	
	}
}

function plugin_BasicPhotogallery() {
	BasicPhotogalleryPlugin::put(func_get_args());
}

?>
