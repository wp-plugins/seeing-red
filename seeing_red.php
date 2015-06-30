<?php
/*
Plugin Name: Seeing Red
Plugin URI: http://www.kjodle.net/wordpress/seeing-red/
Description: Makes "Screen Options" more noticeable
Version: 1.1
Author: Kenneth John Odle
Author URI: http://blog.kjodle.net

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
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
}

// Let's add our stylesheets:
function d12_sr_styles() {
	wp_register_style( 'd12sr_admin_css', plugins_url('css/red.css', __FILE__), false, '1.0.0' );
	wp_enqueue_style( 'd12sr_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'd12_sr_styles' );

//	Color gradients generated at http://www.colorzilla.com/gradient-editor/

?>