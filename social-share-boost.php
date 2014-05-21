<?php
/* Plugin Name: Social Share Boost
Plugin URI: http://vasuchawla.com/
Description: Boost Your Social Sharing by automatically adding various social share tools above or below the posts, page and excerpts. This plug-in also provides the functionality to show the social tools using a simple shortcode.
Version: 3.2
Author: Vasu Chawla
Author URI: http://vasuchawla.com/
License: GPLv2 or later
*/



include_once(plugin_dir_path( __FILE__ ) . '/settings.php');
include_once(plugin_dir_path( __FILE__ ) . '/func.php');

function ssb_activ()
{
	$tnmp = array('show_pages'=>1 ,'show_posts' => 1 ,'show_excerpt' => 1 ,'show_widget' => 1 ,'show_shortcode' => 1 ,'hide_in_id' => '', 'show_bottom' => 1 ,'show_button_fb_like' => 1 ,'show_button_fb_share' => 1 ,'show_button_twtr' => 1 ,'show_button_gplus' => 1 , 'show_button_linkedin' => 1 );update_option("ssb_3_installed", 1);update_option("ssb_option", $tnmp);
}


function ssb_deact(){}

register_activation_hook(__FILE__, 'ssb_activ');
register_deactivation_hook(__FILE__, 'ssb_deact');

function ssb_plugpage_links( $links,$plugin ) {
	if($plugin == plugin_basename(__FILE__))
	{
		$links[] = '<a href="/wp-admin/admin.php?page=social-share-boost">Settings</a>';
		$links[] = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=F6UKBGTQ4YTZG" target="_blank"><strong><b>Buy Me A Coffee</b></strong></a>';
	}
	return $links;
}

add_filter('plugin_row_meta', 'ssb_plugpage_links',10,4);
add_filter( 'plugin_action_links', 'ssb_plugpage_links', 10,4);


// print_r($ssb);
// $ssb3 = get_option('ssb_3_installed');



function ssb_output($upu,$ssb_artificial,$is_widget)
{
	$ssb_html="";
	if($upu==1)
		$url_to_share = get_permalink();
	elseif($upu==0)
	{
		$url_to_share = $ssb_artificial['url2share'];
	}
	if($is_widget)
		$ssb_html.=  '<ul class="ssb_list_wrapper ssb_widget">';
	else
		$ssb_html.=  '<ul class="ssb_list_wrapper">';
	if(isset($ssb_artificial['show_button_fb_like']))
	{
		$ssb_html.='<li class="fb';
		if(isset($ssb_artificial['show_button_fb_share']))
			$ssb_html.='2';
		else
			$ssb_html.='1';
		$ssb_html.='"><iframe src="//www.facebook.com/plugins/like.php?href='.urlencode($url_to_share).'&amp;width=150&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=';
		if(isset($ssb_artificial['show_button_fb_share']))
			$ssb_html.='true';
		else
			$ssb_html.='false';
		$ssb_html.='&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe></li>';
	}
	if(isset($ssb_artificial['show_button_twtr']))
	{
		$ssb_html.='<li class="twtr"><a href="https://twitter.com/share" class="twitter-share-button" data-url="'.$url_to_share.'">&nbsp;</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script></li>';
	}

	// if($ssb_artificial['show_button_twtrfollow'])
	// 	$ssb_html.='<li></li>';

	if(isset($ssb_artificial['show_button_gplus']))
	{
		$ssb_html.='<li class="gplus"><div class="g-plusone" data-size="medium" data-href="'.$url_to_share.'"></div></li>';
		add_action('wp_footer', 'gplus_btn_script');
	}
	if(isset($ssb_artificial['show_button_pintrest']))
	{
		$ssb_html.='<li><a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" ><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" /></a></li>';
		wp_enqueue_script('pintrest_script');
	}
	if(isset($ssb_artificial['show_button_stumble']))
	{
		$ssb_html.='<li><su:badge layout="1" location="'.$url_to_share.'"></su:badge><script type="text/javascript">
		(function() {
			var li = document.createElement(\'script\'); li.type = \'text/javascript\'; li.async = true;
			li.src = (\'https:\' == document.location.protocol ? \'https:\' : \'http:\') + \'//platform.stumbleupon.com/1/widgets.js\';
			var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(li, s);
		})();</script></li>';
	}
	if(isset($ssb_artificial['show_button_tumblr']))
	{
		$ssb_html.='<li><a href="http://www.tumblr.com/share/link?url='.urlencode($url_to_share) .'&name='.urlencode('INSERT_NAME_HERE') .'&description='.urlencode('INSERT_DESCRIPTION_HERE') .'" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:81px; height:20px; background:url(\'http://platform.tumblr.com/v1/share_1.png\') top left no-repeat transparent;">Share on Tumblr</a></li>';
		wp_enqueue_script( 'tumblr_script' );
	}
	if(isset($ssb_artificial['show_button_linkedin']))
	{
		$ssb_html.='<li><script src="//platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script><script type="IN/Share" data-url="'.$url_to_share.'" data-counter="right"></script></li>';
	}
	$ssb_html.="</ul>";
	return $ssb_html;
}
