<div class="wrap">
	<h2>Top / Bottom Content Settings</h2>
	<p>Easily add content to the top and bottom of posts.</p>
	<form action="options.php" method="POST">
		<?php settings_fields('tbc_options'); ?>
		<?php do_settings_sections('tbc_options'); ?>
		
		<p>Enabled <input type="checkbox" name="tbc_enabled" id="tbc_enabled" <?php if(get_option('tbc_enabled')) { echo 'checked'; } ?> /></p>

		<p>You can use short codes + HTML in the content below.</p>

		<h3>Top Content</h3>
		<textarea name="tbc_top_content" style="width: 100%; height: 300px;"><?php echo get_option('tbc_top_content'); ?></textarea>

		<h3>Bottom Content</h3>
		<textarea name="tbc_bottom_content"  style="width: 100%; height: 300px;"><?php echo get_option('tbc_bottom_content'); ?></textarea>

		<?php submit_button(); ?>
	</form>
</div>