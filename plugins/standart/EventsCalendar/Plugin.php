<?php

require_once(__DIR__ . '/../../AbstractPlugin.php');
require_once(__DIR__ . '/database/Events.php');
require_once(__DIR__ . '/../../../nanoadmin/impl/WebTools.php');


class EventsCalendarPlugin extends AbstractPlugin {
	private $events;

	public function __construct() {
		parent::__construct(__FILE__, 'Events Calendar');
		$this->events = new Events();
	}

	public function get_description() {
		return "Plugin displaying events. Simply, in list.";
	}

	public function get_usage() {
		return "<code>&lt;?php plugin_EventsCalendar(true or false); ?&gt;</code>, "
			. "where <code>true</code> specifies only future events, <code>false</code> all";	
	}

	public function get_status() {
		if ($this->events->is_ok()) {
			return PLUGIN_STATUS_INSTALLED;
		} else {
			return PLUGIN_STATUS_UNINSTALLED;
		}
	}

	public function install() {
		return $this->events->install();
	}
	
	public function uninstall() {
		return $this->events->uninstall();
	}
	public function render_plugin_content($config, $apc, $args) { ?>
		<?php 
			if (!$this->yet_on_site()) {
				$apc->add_post_head(
					'<link rel="stylesheet" href="' .  $this->resource('css/default-styles.css') . '" type="text/css"></style>'
				);	
			}
		?>
		<?php $only_future = $args[0]; ?>
		<ol class="events-calendar">
		<?php foreach ($this->events->all_events($only_future) as $event) { ?>
			<li class="event">
				<span class="event-date"><?= WebTools::format_only_date($event->get_date()) ?></span>,
				<span class="event-when"><?= $event->get_when() ?></span>:
				<span class="event-title"><?= $event->get_title() ?></span>
				<div class="event-description"><?= $event->get_description() ?></div>
			</li>
		<?php } ?>
		<ol>
	<?php }

	static public function put($only_future) {
		$plugin = new EventsCalendarPlugin();
		$plugin->render_plugin($only_future);	
	}
}

function plugin_EventsCalendar($only_future) {
	EventsCalendarPlugin::put($only_future);
}

?>
