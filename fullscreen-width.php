<?php
/*
Plugin Name: FullscreenWidth
Plugin URI: http://www.devshare.de/wordpress/plugins/wordpress-fullscreenwidth-plugin
Description: FullscreenWidth adds a input field to change the editarea width, next to the toolbar buttons at the fullscreen view.
Author: Johannes Gamperl
Version: 1.0
Author URI: http://devshare.de
*/

if ( !class_exists('FullscreenWidth') ):

class FullscreenWidth 
{
	/**
	 * Setup the object
	 *
	 * @param $options An array of options for this object
	 */
	function __construct( $options = array() ) 
	{
		add_action('admin_head', array($this, 'add_field'));
	}
	
	
	/**
	 * Add the input field to the fullscreen toolbar
	 * @return JavaScript
	 */
	public function add_field() {
	
		// Capabilities check
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		{
			return;
		}
		echo '
			<script type="text/javascript">
			;(function($){
				$(function()
				{
					$(\'<div style="padding:6px;"><span>Edit width: <input id="jog_fullscreen_width" name="value" style="width:40px;border:1px solid #ccc;" placeholder=" 647" /></span></div>\').appendTo(\'#wp-fullscreen-buttons\');
					$(\'#jog_fullscreen_width\').blur(function(){ $(\'#wp-fullscreen-wrap\').css("width", $(this).val()+\'px\'); });
				});	
			}(jQuery));
			</script>
		';
	}
}

$FullscreenWidth = new FullscreenWidth();

endif; // class_exists