<?php

function register_timeline_shortcode($atts) {
	$a = shortcode_atts(array(
		'id' => 'null',
	), $atts);

	if ($a['id'] === 'null') {
		return "Please enter a timeline id.";
	}

	$entries = intval(get_post_meta($a['id'], '_super_timeline_9000_entries', true));

	$print;

	$heads = array();
	$contents = array();
	
	$print .= "<div class='timeline-container'>";
	for ($i = 0; $i < $entries; $i++) {
		$head = get_post_meta($a['id'], '_super_timeline_9000_head-' . $i, true);
		$content = get_post_meta($a['id'], '_super_timeline_9000_content-' . $i, true);

		$print .= "<div class='timeline-row'>";
			$print .= "<div class='timeline-entry'>";
				$print .= "<h3 class='timeline-entry-head'>";
					$print .= $head;
				$print .= "</h3>";
				$print .= "<p class='timeline-entry-content'>";
					$print .= $content;
				$print .= "</p>";
			$print .= "</div>";
		$print .= "</div>";
	}
	$print .= "</div>";

	return $print;
}

?>