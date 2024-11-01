<?php
/*
Plugin Name: text2image
Plugin URI: http://text2image.webup.org/
Description: This plugin allows to convert the text to an image, like this one has the option to use the web, even font that the visitor has not in your PC.
Version: 1.00
Author: Mario Spinaci
Author URI: http://www.webup.org/

Copyright 2008 Mario Spinaci  (email : m.spinaci@webup.org)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
####################################################################
define('T2I_SITEPATH', get_option('siteurl').'/wp-content/plugins/text2image');

$t2i_inc = 'inc/';
@include $t2i_inc.'rightside.php';
@include $t2i_inc.'functions.inc.php';
@include $t2i_inc.'insert.inc.php';
@include $t2i_inc.'list_table.inc.php';
@include $t2i_inc.'preview.inc.php';

$wp_ft_db_version = "2.0";
####################################################################
function wp_t2i_install() {
	global $wpdb;
	global $wp_t2i_db_version;
	$table_name = $wpdb->prefix . "text2image";
	if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
		$sql = "CREATE TABLE " . $table_name . " (
			id INT(10) NOT NULL AUTO_INCREMENT,
			nome text(60) NOT NULL,
			width int(5) NOT NULL,
			height int(5) NOT NULL,
			background text(6) NOT NULL,
			foreground text(6) NOT NULL,
			testo text(255) NOT NULL,
			nomefont text(255) NOT NULL,
			theight int(5) NOT NULL,
			left_tx int(5) NOT NULL,
			top_tx int(5) NOT NULL,
			tr int(1) NOT NULL,
			PRIMARY KEY (id)
		);";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		$insert = "INSERT INTO " . $table_name .
			" (nome, width, height, background, foreground, testo, nomefont, theight, left_tx, top_tx, tr) " .
			"VALUES ('__title__',300,50,'000000','ffffff','".__('Example´s test', 'text2image')."','SF Automaton.ttf',25,2,30,0)";

		$results = $wpdb->query( $insert );
		add_option("wp_t2i_db_version", $wp_t2i_db_version);
	}
}
register_activation_hook(__FILE__,'wp_t2i_install');
/* dichiara menu */
function text2image_admin_page(){
	add_submenu_page('themes.php', 'Text2Image', 'Text2Image', 5, 'text2image.php', 'text2image_options_page');
}
add_action('admin_menu', 'text2image_admin_page');
add_action('init', 'text2image_init');
define('TEXT2IMAGE', plugin_basename( dirname(__FILE__)) );
/* fine dichiara menu */

// Load language
function text2image_init(){
	if (function_exists('load_plugin_textdomain')) {
		if ( !defined('WP_PLUGIN_DIR') ) {
			load_plugin_textdomain('text2image','wp-content/plugins/' . TEXT2IMAGE . '/lang');
		} else {
			load_plugin_textdomain('text2image', false, dirname(plugin_basename(__FILE__)) . '/lang');
		}
	}
}
####################################################################
function text2image_options_page(){
	if ($_POST['func']){$func=$_POST['func'];}else{$func=$_GET['func'];}
	switch ($func) {
		case '':
			show_list();
			break;
		case __('Delete', 'text2image'):
			delete();
			show_list();
			break;
		case __('New', 'text2image'):
			show_insert();
			break;
		case __('Back', 'text2image'):
			show_insert();
			break;
		case __('Preview', 'text2image'):
			if ($_POST['bkg']!='' && $_POST['frg']!='' && $_POST['width_b']!='' && $_POST['height_b']!='' && 
			$_POST['nf']!='' && $_POST['theight']!='' && $_POST['left_tx']!='' && $_POST['top_tx']!='' && $_POST['tr']!='' && $_POST['text']!='') {
				show_preview();
			} else {
				print  __('Fill all', 'text2image');
				show_list();
			}
			break;
		case __('Insert', 'text2image'):
			insert();
			show_list();
			break;
		case __('Update', 'text2image'):
			update();
			show_list();
			break;
		default:
			show_insert();
	}

}
####################################################################
function t2i($cid){

	global 			$wpdb;
	global 			$wp_t2i_db_version;
	$table_name = 	$wpdb->prefix . "text2image";
	$selezione = 	"FROM $table_name where id='".$cid."';";
	
	$background =	$wpdb->get_var("SELECT background ".$selezione);
	$foreground =	$wpdb->get_var("SELECT foreground ".$selezione);
	
	$nome =			stringa($wpdb->get_var("SELECT nome ".$selezione));
	$width = 		$wpdb->get_var("SELECT width ".$selezione);
	$height = 		$wpdb->get_var("SELECT height ".$selezione);
	$tr = 			$wpdb->get_var("SELECT tr ".$selezione);
	$theight = 		$wpdb->get_var("SELECT theight ".$selezione);
	$left_tx = 		$wpdb->get_var("SELECT left_tx ".$selezione);
	$top_tx = 		$wpdb->get_var("SELECT top_tx ".$selezione);
	$nomefont = 	stringa($wpdb->get_var("SELECT nomefont ".$selezione));
	$testo = 		stringa($wpdb->get_var("SELECT testo ".$selezione));
	
	$stringa = 	'w='.$width.'&h='.$height.'&tr='.$tr.'&th='.$theight.
				'&bkg='.$background.'&frg='.$foreground.
				'&ltx='.$left_tx.'&ttx='.$top_tx.'&nf='.$nomefont.'&text=';
	
	echo '<img src="'.T2I_SITEPATH.'/image.php?'.$stringa;
	
	if ($nome == '__title__'){
		the_title();
	} else {
		echo $testo;
	}
	
	echo '" />';
}

?>
