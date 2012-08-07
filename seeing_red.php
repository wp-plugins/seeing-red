<?php
/*
Plugin Name: Seeing Red
Plugin URI: http://blog.kjodle.net
Description: Makes "Screen Options" more noticeable
Version: 1.0
Author: Kenneth John Odle
Author URI: http://blog.kjodle.net

Released under the GPL v.2, http://www.gnu.org/copyleft/gpl.html

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
*/

//	Only use this if the current user can edit pages and posts
function seeing_red_check() {
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
}
//	 A function to echo our selected CSS
function seeing_red() {
	echo "
	<style type='text/css'>
	#contextual-help-link-wrap, #screen-options-link-wrap {
		border-bottom: 1px solid #ff5d5d;
		border-left: 1px solid #ff5d5d;
		border-right: 1px solid #ff5d5d;
		background: #f1f1f1; /* Old browsers */
		background: -moz-linear-gradient(top, #fff5f5 0%, #ffd1d1 100%); /* FF3.6+ */ /* May have to adjust top value for other browsers */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f1f1f1), color-stop(100%,#ffd1d1)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #f1f1f1 0%,#ffd1d1 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #f1f1f1 0%,#ffd1d1 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #f1f1f1 0%,#ffd1d1 100%); /* IE10+ */
		background: linear-gradient(to bottom, #f1f1f1 0%,#ffd1d1 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f1f1f1', endColorstr='#ffd1d1',GradientType=0 ); /* IE6-9 */
	}
	#contextual-help-back, .contextual-help-tabs .active {
		border-color: #FF5D5D;
	}
	#screen-meta {
		background: #fff5f5;
		border-color: #ff5d5d;
	}
	#screen-meta-links a.show-settings {
		color: #ff5d5d;
		text-shadow: none;
		font-weight: bold;
	}
	#screen-meta-links a.show-settings:hover {
		color: #c00909;
		background: url(\"../images/arrows.png\") no-repeat scroll right 4px transparent #ff5d5d;
		font-weight: bold;
	}
	</style>
	";
}

//	Color gradients generated at http://www.colorzilla.com/gradient-editor/

//	Add this action to the admin page
add_action('admin_notices' , 'seeing_red');

?>