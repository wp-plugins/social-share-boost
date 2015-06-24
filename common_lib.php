<?php

add_action('admin_menu', 'syntatical_settings_menu');
if(!function_exists('syntatical_settings_menu'))
{
	function syntatical_settings_menu(){add_menu_page('S.S. Boost', 'S.S. Boost', 'administrator', 'syntatical_plugins', 'syntatical_contents');
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
					<h4><a target="_blank" href="http://sumome.com/app/share/?src=ssb">Share</a> - Get more traffic to your site with these super easy to setup share buttons!</h4><br /><br />
				
					<h4><a target="_blank" href="http://sumome.com/app/list-builder/?src=ssb">List Builder</a> - Double your daily email list growth</h4><br /><br />
					<h4><a target="_blank" href="http://sumome.com/app/scroll-box/?src=ssb">Scroll Box</a> - Ask for an email address at the right time</h4><br /><br />
		
				</div>
			</div>
		</div>


				 
				<div class="row">
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
			check_admin_referer( 'social-share-boost-settings' );
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
		wp_nonce_field( 'social-share-boost-settings' );
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
			<div style="margin: 5px 0 15px;" class="coffe_box"><p><a style="text-decoration:none;" href="http://sumome.com/?src=ssb" target="_blank">Get more free tools to increase your sharing at SumoMe.com</a></p></div>
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
						$html.='<textarea style="width: 25em;" rows=4 id="'.$field['id'].'" name="'.htmlentities($optn_val).'['.$field['id'].']" class="regular-text">'. htmlentities($curval).'</textarea>';
									break;
								case 'text':
									$html.='<input id="'.$field['id'].'" type="text" name="'.htmlentities($optn_val).'['.$field['id'].']" value="'. htmlentities($curval).'" class="regular-text" />';
									break;
								case 'checkbox':
									$html.='<input id="'.$field['id'].'" type="checkbox" name="'.htmlentities($optn_val).'['.$field['id'].']" value="1" class="" ';
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

