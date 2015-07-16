<?php
/*
Plugin Name: Seeing Red
Plugin URI: http://www.kjodle.net/wordpress/seeing-red/
Description: Makes "Screen Options" more noticeable
Version: 2.0
Author: Kenneth John Odle
Author URI: http://techblog.kjodle.net
Text Domain: seeing-red

Copyright 2015 Kenneth John Odle
© 2015 Kenneth John Odle

Released under the GPL v.3, http://www.gnu.org/copyleft/gpl.html

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 3, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Prevent this page from being loaded directly.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


//	Only use this if the current user can edit pages and posts
function seeing_red_check() {
	if ( ! current_user_can('edit_posts') || ! current_user_can('edit_pages') )
		return;
}


// Register our activation/deactivation hooks
// register_activation_hook(__FILE__, 'add_defaults_d12sr');
register_uninstall_hook( __FILE__, 'delete_defaults_d12sr' );

// Define default option settings
/* Keep this until we get it figured out (or determine if it's even necessary).
function add_defaults_d12sr(){
	$tmp = get_option('d12sr_options');
	if(!is_array($tmp)) {
		$arr = array(
			"so" => "Red",
			"ch" => "Red"
		);
	}
	update_option('d12sr_options', $arr);
}
*/

// Delete database settings upon uninstall
function delete_defaults_d12sr(){
	$option_name = 'd12sr_options';
	delete_option( $option_name );
}


// Create a new admin panel
function d12sr_admin_panel_setup(){
	add_submenu_page(
	'options-general.php',
	'Seeing Red Options',
	'Seeing Red',
	'manage_options',
	'seeing-red-options',
	'd12sr_options_callback'
	);
}
add_action('admin_menu', 'd12sr_admin_panel_setup');


// Callback to create the setting page
function d12sr_options_callback(){
?>
	<div class="wrap">
	<h2>Seeing Red Options</h2>
	<p><strong>New!</strong> You now have the option to style the "Screen Options" and "Help" tabs separately.</p>
	<p>You can also choose from other color schemes besides red.</p>
	<form method="post" action="options.php"> 
	<?php settings_fields( 'd12sr_options_group' ); ?>
	<?php do_settings_sections( 'd12sr_settings' ); ?>
	<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e(__('Save Options','seeing-red')); ?>" />
	</form>
	</div>
<?php
};

// Add the admin settings
add_action( 'admin_init', 'd12sr_admin_init');
function d12sr_admin_init() {
	register_setting(
		'd12sr_options_group',
		'd12sr_options',
		'd12sr_options_validate'
	);
	add_settings_section(
		'd12sr_main',
		'',
		'so_settings_section',
		'd12sr_settings'
	);
	add_settings_field(
		'd12sr_so',
		'Screen Options tab color',
		'so_settings_field',
		'd12sr_settings',
		'd12sr_main'
	);
	add_settings_field(
		'd12sr_ch',
		'Help tab color',
		'ch_settings_field',
		'd12sr_settings',
		'd12sr_main'
	);
};

// Callback for setting_section
function so_settings_section() {
	echo '';
};

// Callback for settings_field for Screen Options tab
function so_settings_field(){
	$options = get_option( 'd12sr_options' );
	$items = array("Red", "Green", "Blue", "Default");
	echo "<select id='d12sr-so' name='d12sr_options[so]'>";
	foreach($items as $item) {
		$selected = ($options[so]==$item) ? 'selected="selected"' : '';
		echo "<option value='$item' $selected>$item</option>";
	}
	echo "</select>";
};

// Callback for settings_field for Contextual Help tab
function ch_settings_field(){
	$options = get_option( 'd12sr_options' );
	$items = array("Red", "Green", "Blue", "Default");
	echo "<select id='d12sr-ch' name='d12sr_options[ch]'>";
	foreach($items as $item) {
		$selected = ($options[ch]==$item) ? 'selected="selected"' : '';
		echo "<option value='$item' $selected>$item</option>";
	}
	echo "</select>";
};

// Since we are only using drop-downs, we don't need to validate
function d12sr_options_validate($input) {
	return $input; 
}


// Retrieve Screen Options options from database, register appropriate stylesheet, and enqueue
function d12so_retrieve() {
	$sroptions = get_option('d12sr_options');
	switch($sroptions['so']) {
		case "Red" :
			wp_register_style( 'd12sr_admin_socss', plugins_url('css/sored.css', __FILE__), false, '1.0.0' );
			break;
		case "Green" :
			wp_register_style( 'd12sr_admin_socss', plugins_url('css/sogreen.css', __FILE__), false, '1.0.0' );
			break;
		case "Blue" :
			wp_register_style( 'd12sr_admin_socss', plugins_url('css/soblue.css', __FILE__), false, '1.0.0' );
			break;
		default:
			return;
	}
	wp_enqueue_style( 'd12sr_admin_socss' );
}
add_action( 'admin_enqueue_scripts', 'd12so_retrieve' );


// Retrieve Screen Options options from database, register appropriate stylesheet, and enqueue
function d12ch_retrieve() {
	$sroptions = get_option('d12sr_options');
	switch($sroptions['ch']) {
		case "Red" :
			wp_register_style( 'd12sr_admin_chcss', plugins_url('css/chred.css', __FILE__), false, '1.0.0' );
			break;
		case "Green" :
			wp_register_style( 'd12sr_admin_chcss', plugins_url('css/chgreen.css', __FILE__), false, '1.0.0' );
			break;
		case "Blue" :
			wp_register_style( 'd12sr_admin_chcss', plugins_url('css/chblue.css', __FILE__), false, '1.0.0' );
			break;
		default:
			return;
	}
	wp_enqueue_style( 'd12sr_admin_chcss' );
}
add_action( 'admin_enqueue_scripts', 'd12ch_retrieve' );

?>