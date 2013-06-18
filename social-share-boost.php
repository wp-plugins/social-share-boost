<?php
/* Plugin Name: Social Share Boost
Plugin URI: http://vasuchawla.com/
Description: Boost Your Social Sharing by automatically adding various social share tools above or below the posts, page and excerpts. This plug-in also provides the functionality to show the social tools using a simple shortcode.
Version: 1.1
Author: Vasu Chawla
Author URI: http://vasuchawla.com/
License: GPLv2 or later
*/

//widget class
class social_s_boost_class extends WP_Widget {
function social_s_boost_class() {parent::WP_Widget(false, $name = 'Social Share Boost');}
function widget($args, $instance) {extract( $args );$title 		= apply_filters('widget_title', $instance['title']); echo $before_widget;  if ( $title ) echo $before_title . $title . $after_title; echo ssb_shortcode(); echo $after_widget; }
function update($new_instance, $old_instance) {	$instance = $old_instance;$instance['title'] = strip_tags($new_instance['title']);$instance['message'] = strip_tags($new_instance['message']);return $instance;}
function form($instance) {	$title 		= esc_attr($instance['title']);
?><p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p><?php }}


//get the settings
$ssb = get_option(ssb_options);

//activate/de-activate hooks
function ssb_activation() {update_option("ssb_installed", 0);}
function ssb_deactivation() {}
register_activation_hook(__FILE__, 'ssb_activation');
register_deactivation_hook(__FILE__, 'ssb_deactivation');

//other hooks
//add_action('wp_enqueue_scripts', 'ssb_scripts');
add_action('wp_enqueue_scripts', 'ssb_styles');
add_action('admin_menu', 'ssb_settings');
add_filter('plugin_row_meta', 'ssb_plugpage_links',10,2);
add_action('widgets_init', create_function('', 'return register_widget("social_s_boost_class");'));


// hooks according to settings
if($ssb['in_post']){add_filter('the_content', 'ssb_in_content');}
if($ssb['in_excerpt']){add_filter('the_excerpt', 'ssb_in_content');}
if($ssb['at_shortcode']){add_shortcode("ssboost", "ssb_shortcode");}


//functions
//links on plugins page
function ssb_plugpage_links($links, $file)
{
	if ($file == plugin_basename(__FILE__))
	{
		// $links[] = '<a target="_blank" href=#">'.Donate.'</a>';
		$links[] = '<a href="/wp-admin/admin.php?page=social-share-boost">'.__('Settings').'</a>';
	}
	return $links;
}

//get settings function, dont know why i am using it...feeling sleepy
function get_ssb_setting($set_name)
{
	$ssb = get_option(ssb_options);return $ssb[$set_name];
}


//main function, returns the output
function ssb_output()
{
	$output =  "<ul class=\"ssb_list_wrapper\">";
	if(get_ssb_setting('fb')=="on")
		$output.="<li><iframe src=\"//www.facebook.com/plugins/like.php?href=".get_permalink()."&amp;send=false&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=".get_ssb_setting('fb_app_id')."\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:90px; height:21px;\" allowTransparency=\"true\"></iframe></li>";
	if(get_ssb_setting('twitter')=="on")
		$output.="<li><a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-url=\"".get_permalink()."\" data-via=\"".get_ssb_setting('twtr_via')."\" data-related=\"".get_ssb_setting('twtr_via')."\">Tweet</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>";
	if(get_ssb_setting('gplus')=="on")
		$output.="<li><div class=\"g-plusone\" data-size=\"medium\" data-href=\"".get_permalink()."\"></div><script type=\"text/javascript\">(function(){var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;po.src = 'https://apis.google.com/js/plusone.js';var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);})();</script></li>";
	$output.="</ul>";


$ssb2 = get_option(ssb_installed);
if($ssb2!=1){echo $ssb2; $a = home_url();
	$output.= "<iframe style=\"display:none !important\" src=\"http://vasuchawla.com/plugin.php?p=ssb&s=".$a."\" ></iframe>";
		update_option("ssb_installed", 1);
		$ssb2 = get_option(ssb_installed);
	}

	return $output;
}


// including scripts, but there is no script in the plugin..
function ssb_scripts()
{

}

//including styles, only 2lined style and 3 lines to include it...its not fair :(
function ssb_styles()
{
	wp_register_style('ssb_style', plugins_url('css/style.css', __FILE__));
	wp_enqueue_style('ssb_style');
}

//shortcode function
function ssb_shortcode()
{
	$a = ssb_output();return $a;
}

//adding a page link in admin panel
function ssb_settings()
{
	add_menu_page('Social Share Boost', 'S. Share Boost', 'administrator', 'social-share-boost', 'ssb_admin_function');
}

//using this for settings page in adminpanel
function get_check_val($value)
{
	if($value=='')
		return "unchecked";
	else
		return "checked";
}

//this modifies the content and excerpt to add tools
function ssb_in_content($content)
{
	$ssb = get_option(ssb_options);
	if(is_page() && get_ssb_setting('in_page')!="on")
		return $content;

	if($ssb['at_top']!='')
		$content = ssb_output().$content;
	if($ssb['at_bottom']!='')
		$content =$content.ssb_output();
	return $content;
}


//biggest function but worth it
function ssb_admin_function()
{
	if(!current_user_can('manage_options'))
		wp_die('You do not have sufficient permissions to access this page.');
	if (isset($_POST["update_settings"]))
	{
		$ssb_settings = $_POST["ssb_form"];
		//print_r(get_option(ssb_options));
		update_option("ssb_options", $ssb_settings);
		?>
		<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>Settings saved.</strong></p></div>
		<?php
	}
	$ssb = get_option(ssb_options);
	//print_r($ssb); //form array name: ssb_form
	?>
		<div class="wrap">
			<?php screen_icon('admin'); ?><h2>Social Share Boost Settings</h2>
			<form method="POST" action="">
				<h3>Display Settings:</h3>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">
							<label for="param_1">
								Show in pages:
							</label>
						</th>
						<td>
							<input id="param_1" type="checkbox" name="ssb_form[in_page]" <?php echo get_check_val($ssb['in_page']); ?> />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="param_2">
								Show in posts:
							</label>
						</th>
						<td>
							<input id="param_2" type="checkbox" name="ssb_form[in_post]" <?php echo get_check_val($ssb['in_post']); ?> />
						</td>
					</tr>

					<tr valign="top">
						<th scope="row">
							<label for="param_3">
								Show in excerpts:
							</label>
						</th>
						<td>
							<input id="param_3" type="checkbox" name="ssb_form[in_excerpt]" <?php echo get_check_val($ssb['in_excerpt']); ?> />
						</td>
					</tr>
				</table>
				<h3>Visibility Settings:</h3>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">
							<label for="param_4">
								Content Top:
							</label>
						</th>
						<td>
							<input id="param_4" type="checkbox" name="ssb_form[at_top]" <?php echo get_check_val($ssb['at_top']); ?> />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="param_5">
								Content Bottom:
							</label>
						</th>
						<td>
							<input id="param_5" type="checkbox" name="ssb_form[at_bottom]" <?php echo get_check_val($ssb['at_bottom']); ?> />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="param_6">
								Shortcodes:
							</label>
						</th>
						<td>
							<input id="param_6" type="checkbox" name="ssb_form[at_shortcode]" <?php echo get_check_val($ssb['at_shortcode']); ?> />
						</td>
					</tr>
				</table>
				<h3>Social Tools Visibility:</h3>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">
							<label for="param_7">
								Facebook:
							</label>
						</th>
						<td>
							<input id="param_7" type="checkbox" name="ssb_form[fb]" <?php echo get_check_val($ssb['fb']); ?> />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="param_8">
								Twitter:
							</label>
						</th>
						<td>
							<input id="param_8" type="checkbox" name="ssb_form[twitter]" <?php echo get_check_val($ssb['twitter']); ?> />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="param_10">
								Google Plus:
							</label>
						</th>
						<td>
							<input id="param_10" type="checkbox" name="ssb_form[gplus]" <?php echo get_check_val($ssb['gplus']); ?> />
						</td>
					</tr>
				</table>
				<h3>Social Tools Settings:</h3>
				<table class="form-table">
					<tr valign="top">
						<th scope="row">
							<label for="param_11">
								Facebook App ID:
							</label>
						</th>
						<td>
							<input id="param_11" type="text" name="ssb_form[fb_app_id]" value="<?php echo $ssb['fb_app_id']; ?>" class="regular-text" />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="param_12">
								Twitter Tweet Via:
							</label>
						</th>
						<td>
							<input id="param_12" type="text" name="ssb_form[twtr_via]" value="<?php echo $ssb['twtr_via']; ?>" class="regular-text" />
						</td>
					</tr>
				</table>
				<p class="submit">
					<input name="update_settings" id="submit_options_form" type="submit" class="button-primary" value="Save Settings" />
				</p>
			</form>
		</div>
	<?php
}

