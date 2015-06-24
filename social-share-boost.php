<?php
/* Plugin Name: Social Share Boost
Plugin URI: http://sumome.com/
Description: Boost Your Social Sharing by automatically adding various social share tools above or below the posts, page and excerpts. This plug-in also provides the functionality to show the social tools using a simple shortcode.
Version: 4.4
Author: SumoMe
Author URI: http://SumoMe.com/
License: GPLv2 or later
*/


global $ssb;
$ssb = get_option("ssb_option");
if(isset($ssb['hide_erors']) && ($ssb['hide_erors']))
{
error_reporting(0);
}

// ssb_activ();

function ssb_activ()
{
	$tnmp = array('show_pages'=>1 ,'show_posts' => 1 ,'show_excerpt' => 1 , 'show_shortcode' => 1 ,'hide_in_id' => '', 'show_bottom' => 1 ,'show_button_fb_like' => 1 ,'show_button_fb_share' => 1 ,'show_button_twtr' => 1 ,'show_button_gplus' => 1 , 'show_button_linkedin' => 1 , 
		'width_button_fb_like'=>86 ,'width_button_fb_share'=>135 ,'width_button_twtr'=>90 ,'width_button_gplus'=>68 ,'width_button_pintrest'=>47 ,'width_button_stumble'=>75 ,'width_button_tumblr'=>85 ,'width_button_linkedin'=>64 ,'width_button_scoopit'=>90 ,'width_button_xing'=>56
	);

	update_option("ssb_4_installed", 1);

	update_option("ssb_option", $tnmp);
}
function ssb_deact(){}

register_activation_hook(__FILE__, 'ssb_activ');
register_deactivation_hook(__FILE__, 'ssb_deact');



include_once(plugin_dir_path( __FILE__ ) . '/common_lib.php');
include_once(plugin_dir_path( __FILE__ ) . '/ssb_widgets.php');
include_once(plugin_dir_path( __FILE__ ) . '/func.php');


function ssb_is_installed(){}


add_action('admin_menu', 'ssb_settings_menu');
if(!function_exists('ssb_settings_menu'))
{
	function ssb_settings_menu(){

	add_submenu_page( 'syntatical_plugins', 'Social Share Boost Settings', 'Settings', 'administrator', 'ssb_settings', 'ssb_settings_content' );
	}
}
if(!function_exists('ssb_settings_content'))
{
	function ssb_settings_content(){
		syntatical_settings_content(ssb_get_fields(), 'Social Share Boost', 'ssb_option');
	}
}





function ssb_plugpage_links( $links,$plugin ) {
	if($plugin == plugin_basename(__FILE__))
	{
		$links[] = '<a href="'.admin_url( 'admin.php?page=ssb_settings', 'http' ).'">Settings</a>';
		$links[] = '<a style="background: rgb(255, 169, 111);color: #442929;padding: 1px 4px;border-radius: 4px;font-weight: bold;font-size: 0.8em;" href="http://sumome.com/?src=ssb" target="_blank">Get More at SumoMe</a>';
	}
	return $links;
}

// add_filter('plugin_row_meta', 'ssb_plugpage_links',10,4);
add_filter( 'plugin_action_links', 'ssb_plugpage_links', 10,4);

