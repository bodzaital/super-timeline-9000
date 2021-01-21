<?php

function register_timeline_metabox()
{
    add_meta_box('timeline_metabox' ,'Timeline Contents' ,'render_timeline_metabox' ,'super_timeline_9000' ,'normal' ,'high');
}
add_action('admin_init', 'register_timeline_metabox');

function render_timeline_metabox($post)
{
	wp_nonce_field('super_timeline_9000_action', 'super_timeline_9000_nonce');

	$entries = intval(get_post_meta($post->ID, '_super_timeline_9000_entries', true));

	$heads = array();
	$contents = array();
	for ($i = 0; $i < $entries; $i++) { 
		array_push($heads, get_post_meta($post->ID, '_super_timeline_9000_head-' . $i, true));
		array_push($contents, get_post_meta($post->ID, '_super_timeline_9000_content-' . $i, true));
	}

	?>

	<div class="super_timeline_9000_shortcode">Shortcode: [timeline-insert id="<?php echo $post->ID; ?>"]</div>
	
	<span id="super_timeline_9000_communicator" data-message="editing"></span>
	<input type="hidden" id="_super_timeline_9000_entries" name="_super_timeline_9000_entries" value="<?php echo $entries; ?>">

	<div class="super_timeline_9000_cloneable">
		<h2>New entry</h2>
		<div class="timeline-entry">
			<div class="super_timeline_9000_formLine">
				<label for="_super_timeline_9000_head">Date or time</label>
				<input type="text" value="" id="_super_timeline_9000_head-" name="_super_timeline_9000_head-">
			</div>
			<div class="super_timeline_9000_formLine">
				<label for="_super_timeline_9000_content">Content</label>
				<textarea name="_super_timeline_9000_content-" id="_super_timeline_9000_content-" cols="30" rows="10"></textarea>
			</div>
		</div>
	</div>


	<div class="super_timeline_9000_cloneParent">
		<?php for ($i = 0; $i < $entries; $i++) : ?>
			<div class="super_timeline_9000_clone">
				<h2>Entry</h2>
				<div class="timeline-entry">
					<div class="super_timeline_9000_formLine">
						<label>Date or time</label>
						<input type="text" value="<?php echo $heads[$i]; ?>" id="_super_timeline_9000_head-<?php echo $i; ?>" name="_super_timeline_9000_head-<?php echo $i; ?>">
					</div>
					<div class="super_timeline_9000_formLine">
						<label>Content</label>
						<textarea name="_super_timeline_9000_content-<?php echo $i; ?>" id="_super_timeline_9000_content-<?php echo $i; ?>" cols="30" rows="10"><?php echo $contents[$i]; ?></textarea>
					</div>
				</div>
			</div>
		<?php endfor; ?>
	</div>
	<h2 id="modify-buttons-h2" class="modify-buttons">Add/remove entries</h2>
	<div class="super_timeline_9000_modify">
		<a href="#" id="timeline-add">➕</a>
		<a href="#" id="timeline-remove">➖</a>
	</div>

	<?php
}

function save_timeline_metabox($post_id) {
	if (!isset($_POST['super_timeline_9000_nonce'])) {
		return $post;
	}

	$nonce = $_POST['super_timeline_9000_nonce'];

	if (!wp_verify_nonce( $nonce, 'super_timeline_9000_action')) {
		return $post;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post;
	}

	// Check the user's permissions.
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post ) ) {
			return $post;
		}
	} else {
		if ( ! current_user_can( 'edit_post', $post ) ) {
			return $post;
		}
	}

	$entries = intval($_POST['_super_timeline_9000_entries']);

	if (!add_post_meta($post_id, '_super_timeline_9000_entries', $entries, true)) {
		update_post_meta($post_id, '_super_timeline_9000_entries', $entries);
	}

	for ($i=0; $i < $entries; $i++) {
		if (!add_post_meta($post_id, '_super_timeline_9000_head-' . $i, sanitize_text_field($_POST['_super_timeline_9000_head-' . $i]), true)) {
			update_post_meta($post_id, '_super_timeline_9000_head-' . $i, sanitize_text_field($_POST['_super_timeline_9000_head-' . $i]));
		}
	
		if (!add_post_meta($post_id, '_super_timeline_9000_content-' . $i, sanitize_textarea_field($_POST['_super_timeline_9000_content-' . $i]), true)) {
			update_post_meta($post_id, '_super_timeline_9000_content-' . $i, sanitize_textarea_field($_POST['_super_timeline_9000_content-' . $i]));
		}
	}
}
add_action('save_post', 'save_timeline_metabox');

?>