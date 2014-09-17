<?php

add_action('admin_menu', 'syntatical_settings_menu');
if(!function_exists('syntatical_settings_menu'))
{
	function syntatical_settings_menu(){add_menu_page('Syntatical', 'Syntatical', 'administrator', 'syntatical_plugins', 'syntatical_contents');
	add_submenu_page( 'syntatical_plugins',  'Syntatical Plugins Dashboard','Dashboard', 'administrator', 'syntatical_plugins', 'syntatical_contents' );
}

}

if(!function_exists('syntatical_contents'))
{
	function syntatical_contents(){
		?>
	<div class="wrap">
		<h2>Plugins by SumoMe</h2>
		<div class="postbox">
			<h3 class="hndle" style="padding: 7px;  font-size: 15px;"><span>Plugins to help your blog:</span></h3>
			<div class="inside">
				<style>.has_ifr iframe{vertical-align: bottom;}</style>
				<div class="row has_ifr">
					<h4><a target="_blank" href="http://sumome.com/app/list-builder/?src=ssb">List Builder</a> - Double your daily email list growth</h4><br /><br />
					<h4><a target="_blank" href="http://sumome.com/app/scroll-box/?src=ssb">Scroll Box</a> - Double your daily email list growth</h4><br /><br />
					<h4><a target="_blank" href="http://sumome.com/app/list-builder/?src=ssb">List Builder</a> - Double your daily email list growth</h4><br /><br />
					<h4><a target="_blank" href="http://sumome.com/app/list-builder/?src=ssb">List Builder</a> - Double your daily email list growth</h4><br /><br />				
	
				</div>
			</div>
		</div>


				 
				<div class="row">

					<ul><li style="float:left;display:inline-block;padding-right:20px;"><iframe src="//www.facebook.com/plugins/follow.php?href=https%3A%2F%2Fwww.facebook.com%2Fvasuchawla26&amp;width=100&amp;height=80&amp;colorscheme=light&amp;layout=button&amp;show_faces=true&amp;appId=307091639398582" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:22px;width:80px" allowTransparency="true"></iframe></li><li style="float:left;display:inline-block;padding-right:20px;"><div class="g-follow" data-annotation="none" data-height="20" data-href="//plus.google.com/u/0/105910197271343053773" data-rel="author"></div><script type="text/javascript">(function() {var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;po.src = 'https://apis.google.com/js/platform.js';var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);})();</script></li><li style="float:left;display:inline-block;padding-right:20px;"><a href="https://twitter.com/VasuChawla" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @vasuchawla</a></li><li style="float:left;display:inline-block;padding-right:20px;"><a href="https://twitter.com/syntatical" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @syntatical</a></li></ul>

				</div>
				<div class="row"> &nbsp;<br /></div>
			</div>
		</div>
	</div>
		<?php
	}
}



if(!function_exists('syntatical_settings_content'))
{
	function syntatical_settings_content($sett_val, $title, $optn_val)
	{

		if(!current_user_can('manage_options')){ wp_die('You do not have sufficient permissions to access this page.');}
		if (isset($_POST["update_settings"]))
		{
			$synt = $_POST[$optn_val];
			update_option($optn_val, $synt);
			echo'<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>Settings saved.</strong></p></div>';
		} 
		$opt = "";
		echo'<div class="wrap">';
		echo'<h2>'.$title.'</h2>';
		echo'<form method="POST" action=""><h3 class="nav-tab-wrapper">';
		$tabs  = $sett_val;
		$i=1;
		foreach($tabs as $tab=>$field_ary)
		{
			if($i==1){$class ="nav-tab-active";}else{$class='';}
			echo '<a href="#tab'.$i.'" class="nav-tab nac-tab '.$class.'">'.$tab.'</a>';
			$opt.=syntatical_get_fields_html($field_ary,$i, $optn_val);
			$i++;
		}
		echo'</h3>';
		echo $opt;
		echo'<p class="submit"><input name="update_settings" id="submit_options_form" type="submit" class="button-primary" value="Save Settings" /></p></form></div>';
		return '';
	}
}


if(!function_exists('syntatical_get_fields_html')){
	function syntatical_get_fields_html($field_ary,$i,$optn_val)
	{
		$html ="";
		$class="";$class2="";
		if($i!=1)
		   $class = 'style="display:none;"';

		$html.= '<div class="wp-tab-panela" id="tab'.$i.'" '.$class.' >
			<div style="margin: 5px 0 15px;" class="coffe_box"><p><a style="text-decoration:none;" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=F6UKBGTQ4YTZG" target="_blank">Support Creativity ! Buy me a coffee =)</a> | <a style="text-decoration:none;" href="http://www.vasuchawla.com" target="_blank">Need Help ? or suggest me my next plugin</a></p></div>
		<table class="form-table">';

		foreach ($field_ary as $field) {
			if($field['type']=='line')
				$html.='<tr><th colspan=2><hr /></th></tr>';
			elseif($field['type']=='hidden')
				$html.='<input type="hidden" name="nullval" value=1 />';
			else
			{
				$synt = get_option($optn_val);
				if(isset($synt[$field['id']]))
				 $curval = $synt[$field['id']];
			 else
				$curval='';
							$curval = stripslashes( $curval);
							$html.='<tr valign="top"><th scope="row"><label for="'.$field['id'].'">'.$field['title'].'</label></th><td>';

				switch($field['type'])
				{
					case 'textarea':
						$html.='<textarea style="width: 25em;" rows=4 id="'.$field['id'].'" name="'.$optn_val.'['.$field['id'].']" class="regular-text">'. $curval.'</textarea>';
									break;
								case 'text':
									$html.='<input id="'.$field['id'].'" type="text" name="'.$optn_val.'['.$field['id'].']" value="'. $curval.'" class="regular-text" />';
									break;
								case 'checkbox':
									$html.='<input id="'.$field['id'].'" type="checkbox" name="'.$optn_val.'['.$field['id'].']" value="1" class="" ';
									if($curval==1)
										$html.=' checked="checked" ';
									$html.='/>';
									break;
				}
				$html.= '</td></tr>';
			}
			// print_r($field);
		}
		$html.= '</table></div>';
		return $html;
	}
}

if(!function_exists('syntatatical_admin_script'))
{
	add_action( 'admin_enqueue_scripts', 'syntatatical_admin_script' );
	function syntatatical_admin_script()
	{
		wp_register_script( 'synt_admin_js', plugins_url('js/admin-js.js', __FILE__));
		wp_enqueue_script( 'synt_admin_js' );
	}
}

