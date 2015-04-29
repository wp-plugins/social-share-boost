<?php

class ssb_widget extends WP_Widget{
	function ssb_widget()
	{
		parent::WP_Widget(false, $name = 'Social Share Boost');
	}
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		$url = apply_filters('widget_url', $instance['url']);
		$fb_like = apply_filters('widget_fb_like', $instance['fb_like']);
		$fb_share = apply_filters('widget_fb_share', $instance['fb_share']);
		$twtr = apply_filters('widget_twtr', $instance['twtr']);
		$gplus = apply_filters('widget_gplus', $instance['gplus']);
		$pint = apply_filters('widget_pint', $instance['pint']);
		$stmbl = apply_filters('widget_stmbl', $instance['stmbl']);
		$tumblr = apply_filters('widget_tumblr', $instance['tumblr']);
		$linkedin = apply_filters('widget_linkedin', $instance['linkedin']);
		$scoopit = apply_filters('widget_scoopit', $instance['scoopit']);

		

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		global $ssb;
		$s = array();
		if ($url=="")
			$s['url2share'] = home_url();
		else
			$s['url2share'] = $url;
		if($fb_like)
			$s['show_button_fb_like'] = 1;
		if($fb_share)
			$s['show_button_fb_share'] = 1;
		if($twtr)
			$s['show_button_twtr'] = 1;
		if($gplus)
			$s['show_button_gplus'] = 1;
		if($pint)
			$s['show_button_pintrest'] = 1;
		if($stmbl)
			$s['show_button_stumble'] = 1;
		if($tumblr)
			$s['show_button_tumblr'] = 1;
		if($linkedin)
			$s['show_button_linkedin'] = 1;
		if($scoopit)
			$s['show_button_scoopit'] = 1;


		echo ssb_output(0,$s,1);
		// echo ssb_shortcode();
		echo $after_widget;
	}
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['url'] = strip_tags($new_instance['url']);
		$instance['fb_like'] = strip_tags($new_instance['fb_like']);
		$instance['fb_share'] = strip_tags($new_instance['fb_share']);
		$instance['twtr'] = strip_tags($new_instance['twtr']);
		$instance['gplus'] = strip_tags($new_instance['gplus']);
		$instance['pint'] = strip_tags($new_instance['pint']);
		$instance['stmbl'] = strip_tags($new_instance['stmbl']);
		$instance['tumblr'] = strip_tags($new_instance['tumblr']);
		$instance['linkedin'] = strip_tags($new_instance['linkedin']);
		$instance['scoopit'] = strip_tags($new_instance['scoopit']);


		// $instance['message'] = strip_tags($new_instance['message']);
		return $instance;
	}
	function form($instance)
	{
		$title = esc_attr($instance['title']);
		$url = esc_attr($instance['url']);
		$fb_like = esc_attr($instance['fb_like']);
		$fb_share = esc_attr($instance['fb_share']);
		$twtr = esc_attr($instance['twtr']);
		$gplus = esc_attr($instance['gplus']);
		$pint = esc_attr($instance['pint']);
		$stmbl = esc_attr($instance['stmbl']);
		$tumblr = esc_attr($instance['tumblr']);
		$linkedin = esc_attr($instance['linkedin']);
		$scoopit = esc_attr($instance['scoopit']);
		echo'<p><label for="'. $this->get_field_id('title').'">Title:</label><input class="widefat" id="'. $this->get_field_id('title').'" name="'. $this->get_field_name('title').'>" type="text" value="'. $title.'" /></p>';
		echo'<p><label for="'. $this->get_field_id('url').'">Url to share(leave empty to use homeurl):</label><input class="widefat" id="'. $this->get_field_id('url').'" name="'. $this->get_field_name('url').'>" type="text" value="'. $url.'" /></p>';

		echo'<p><label for="'. $this->get_field_id('fb_like').'">Facebook Like:</label> &nbsp;&nbsp;<input class="widefat" id="'. $this->get_field_id('fb_like').'" name="'. $this->get_field_name('fb_like').'>" type="checkbox" ';
		if ($fb_like)
			echo ' checked=checked ';
		echo'value="1" /></p>';

		   echo'<p><label for="'. $this->get_field_id('fb_share').'">Facebook Share:</label> &nbsp;&nbsp;<input class="widefat" id="'. $this->get_field_id('fb_share').'" name="'. $this->get_field_name('fb_share').'>" type="checkbox" ';
		if ($fb_share)
			echo ' checked=checked ';
		echo'value="1" /></p>';


		   echo'<p><label for="'. $this->get_field_id('twtr').'">Tweeter:</label> &nbsp;&nbsp;<input class="widefat" id="'. $this->get_field_id('twtr').'" name="'. $this->get_field_name('twtr').'>" type="checkbox" ';
		if ($twtr)
			echo ' checked=checked ';
		echo'value="1" /></p>';

		   echo'<p><label for="'. $this->get_field_id('gplus').'">Google Plus:</label> &nbsp;&nbsp; <input class="widefat" id="'. $this->get_field_id('gplus').'" name="'. $this->get_field_name('gplus').'>" type="checkbox" ';
		if ($gplus)
			echo ' checked=checked ';
		echo'value="1" /></p>';

		   echo'<p><label for="'. $this->get_field_id('pint').'">Pinterest:</label> &nbsp;&nbsp; <input class="widefat" id="'. $this->get_field_id('pint').'" name="'. $this->get_field_name('pint').'>" type="checkbox" ';
		if ($pint)
			echo ' checked=checked ';
		echo'value="1" /></p>';

		   echo'<p><label for="'. $this->get_field_id('stmbl').'">Stumbleupon:</label> &nbsp;&nbsp; <input class="widefat" id="'. $this->get_field_id('stmbl').'" name="'. $this->get_field_name('stmbl').'>" type="checkbox" ';
		if ($stmbl)
			echo ' checked=checked ';
		echo'value="1" /></p>';

		   echo'<p><label for="'. $this->get_field_id('tumblr').'">Tumblr:</label> &nbsp;&nbsp; <input class="widefat" id="'. $this->get_field_id('tumblr').'" name="'. $this->get_field_name('tumblr').'>" type="checkbox" ';
		if ($tumblr)
			echo ' checked=checked ';
		echo'value="1" /></p>';

		   echo'<p><label for="'. $this->get_field_id('linkedin').'">LinkedIn:</label> &nbsp;&nbsp; <input class="widefat" id="'. $this->get_field_id('linkedin').'" name="'. $this->get_field_name('linkedin').'>" type="checkbox" ';
		if ($linkedin)
			echo ' checked=checked ';
		echo'value="1" /></p>';
		 echo'<p><label for="'. $this->get_field_id('scoopit').'">Scoop it:</label> &nbsp;&nbsp; <input class="widefat" id="'. $this->get_field_id('scoopit').'" name="'. $this->get_field_name('scoopit').'>" type="checkbox" ';
		if ($scoopit)
			echo ' checked=checked ';
		echo'value="1" /></p>';





	}
}




class ssb_fb_like_widget extends WP_Widget{
	function ssb_fb_like_widget()
	{
		parent::WP_Widget(false, $name = 'Social Share Boost :: Like Box');
	}
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		$url = $instance['url']; 
		$faces = $instance['faces'];
		$feed = $instance['feed'];
		$height = $instance['height'];
		$width = $instance['width'];
		$header = $instance['header'];
		$border = $instance['border'];
		$dark = $instance['dark'];



		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;


		echo '<iframe src="//www.facebook.com/plugins/likebox.php?href='.urlencode($url).'&amp;width='.$width.'&amp;height='.$height.'&amp;colorscheme=';

		if(!$dark)
			echo 'light';
		else
			echo 'dark';

		echo '&amp;show_faces=';

		if($faces)
			echo 'true';
		else
			echo 'false';

		echo '&amp;header=';

		if(!$header)
			echo 'true';
		else
			echo 'false';
		  echo '&amp;stream=';
		if($feed)
			echo 'true';
		else
			echo 'false';

		  echo '&amp;show_border=';
		 if(!$border)
			echo 'true';
		else
			echo 'false';


		  echo '&amp;appId=307091639398582" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px;" allowTransparency="true"></iframe>';



		echo $after_widget;
	}
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['url'] = strip_tags($new_instance['url']);
 
		$instance['faces'] = strip_tags($new_instance['faces']);
		$instance['feed'] = strip_tags($new_instance['feed']);
		$instance['height'] = strip_tags($new_instance['height']);
		$instance['width'] = strip_tags($new_instance['width']);
		$instance['header'] = strip_tags($new_instance['header']);
		$instance['border'] = strip_tags($new_instance['border']);
		$instance['dark'] = strip_tags($new_instance['dark']);


 

		return $instance;
	}
	function form($instance)
	{
		$title = esc_attr($instance['title']);
		$url = esc_attr($instance['url']); 
		$faces = esc_attr($instance['faces']);
		$feed = esc_attr($instance['feed']);
		$height = esc_attr($instance['height']);
		$width = esc_attr($instance['width']);
		$header = esc_attr($instance['header']);
		$border = esc_attr($instance['border']);
		$dark = esc_attr($instance['dark']);


		echo'<p><label for="'. $this->get_field_id('title').'">Title:</label><input class="widefat" id="'. $this->get_field_id('title').'" name="'. $this->get_field_name('title').'>" type="text" value="'. $title.'" /></p>';

		echo'<p><label for="'. $this->get_field_id('url').'">FB page URL:</label><input class="widefat" id="'. $this->get_field_id('url').'" name="'. $this->get_field_name('url').'>" type="text" value="'. $url.'" /></p>';

 


		echo'<p><label for="'. $this->get_field_id('height').'">Like Box Height:</label><input class="widefat" id="'. $this->get_field_id('height').'" name="'. $this->get_field_name('height').'>" type="text" value="'. $height.'" /></p>';

		echo'<p><label for="'. $this->get_field_id('width').'">Like Box Width:</label><input class="widefat" id="'. $this->get_field_id('width').'" name="'. $this->get_field_name('width').'>" type="text" value="'. $width.'" /></p>';
 




		   echo'<p><label for="'. $this->get_field_id('faces').'">Show Faces:</label> &nbsp;&nbsp;<input class="widefat" id="'. $this->get_field_id('faces').'" name="'. $this->get_field_name('faces').'>" type="checkbox" ';
		if ($faces)
			echo ' checked=checked ';
		echo'value="1" /></p>';

		   echo'<p><label for="'. $this->get_field_id('feed').'">Show Posts:</label> &nbsp;&nbsp;<input class="widefat" id="'. $this->get_field_id('feed').'" name="'. $this->get_field_name('feed').'>" type="checkbox" ';
		if ($feed)
			echo ' checked=checked ';
		echo'value="1" /></p>';
		   echo'<p><label for="'. $this->get_field_id('header').'">Hide Box Header:</label> &nbsp;&nbsp;<input class="widefat" id="'. $this->get_field_id('header').'" name="'. $this->get_field_name('header').'>" type="checkbox" ';
		if ($header)
			echo ' checked=checked ';
		echo'value="1" /></p>';
		   echo'<p><label for="'. $this->get_field_id('border').'">Hide Box Border:</label> &nbsp;&nbsp;<input class="widefat" id="'. $this->get_field_id('border').'" name="'. $this->get_field_name('border').'>" type="checkbox" ';
		if ($border)
			echo ' checked=checked ';
		echo'value="1" /></p>';	   echo'<p><label for="'. $this->get_field_id('dark').'">Use Dark Theme:</label> &nbsp;&nbsp;<input class="widefat" id="'. $this->get_field_id('dark').'" name="'. $this->get_field_name('dark').'>" type="checkbox" ';
		if ($dark)
			echo ' checked=checked ';
		echo'value="1" /></p>';

 




	}
}


class ssb_icons_widget extends WP_Widget{
	function ssb_icons_widget()
	{
		parent::WP_Widget(false, $name = 'Social Share Boost :: Social Profile Icons');
	}
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		$ico_arr = array();
		$ico_arr['fb'] = $instance['fb_url'];  
		$ico_arr['twtr'] = $instance['twtr_url'];  
		$ico_arr['pin'] = $instance['pin_url'];  
		$ico_arr['insta'] = $instance['insta_url'];  
		$ico_arr['yt'] = $instance['yt_url'];  
		$ico_arr['gp'] = $instance['gp_url'];  
		$ico_arr['rss'] = $instance['rss_url'];  
		$ico_arr['linkd'] = $instance['linkd_url'];  
		$ico_arr['vim'] = $instance['vim_url'];  

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		echo '<ul class="social_icons_wrap_ssb">';
		foreach ($ico_arr as $key => $value)
		{
			if($value!="")
			{
				echo '<li><a href="'.$value.'" target="_blank"><img src="'.plugins_url('images/'.$key.'.png', __FILE__).'" /></li>';
			}
		}
		echo '</ul>';
		echo $after_widget;
	}
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['fb_url'] = strip_tags($new_instance['fb_url']);
		$instance['twtr_url'] = strip_tags($new_instance['twtr_url']);
		$instance['pin_url'] = strip_tags($new_instance['pin_url']);
		$instance['insta_url'] = strip_tags($new_instance['insta_url']);
		$instance['yt_url'] = strip_tags($new_instance['yt_url']);
		$instance['gp_url'] = strip_tags($new_instance['gp_url']);
		$instance['rss_url'] = strip_tags($new_instance['rss_url']);
		$instance['vim_url'] = strip_tags($new_instance['vim_url']);
		$instance['linkd_url'] = strip_tags($new_instance['linkd_url']);


		return $instance;
	}
	function form($instance)
	{
		$title = esc_attr($instance['title']); 
		$ico_r = array();  
		
		$ico_r['fb_url'] = array('Facebook',esc_attr($instance['fb_url'])); 
		$ico_r['twtr_url'] = array('Twitter',esc_attr($instance['twtr_url']));
		$ico_r['pin_url'] = array('Pinterest',esc_attr($instance['pin_url'])); 
		$ico_r['insta_url'] = array('Instagram',esc_attr($instance['insta_url']));
		$ico_r['yt_url'] = array('Youtube',esc_attr($instance['yt_url'])); 
		$ico_r['gp_url'] = array('Google Plus',esc_attr($instance['gp_url']));
		$ico_r['rss_url'] = array('RSS',esc_attr($instance['rss_url'])); 
		$ico_r['vim_url'] = array('Vimeo',esc_attr($instance['vim_url']));  
		$ico_r['linkd_url'] = array('LinkedIn',esc_attr($instance['linkd_url']));  

		echo'<p><label for="'. $this->get_field_id('title').'">Title:</label><input class="widefat" id="'. $this->get_field_id('title').'" name="'. $this->get_field_name('title').'>" type="text" value="'. $title.'" /></p>';


 		foreach ($ico_r as $key => $value)
 		{
			echo'<p><label for="'. $this->get_field_id($key).'">'.$value[0].' Profile URL:</label><input class="widefat" id="'. $this->get_field_id($key).'" name="'. $this->get_field_name($key).'>" type="text" value="'. $value[1].'" /></p>';
 		}
	}
}
 




function ssb_widget_reg_func(){
	register_widget( 'ssb_widget' );
	register_widget( 'ssb_fb_like_widget' );
	register_widget( 'ssb_icons_widget' );
}

add_action( 'widgets_init', 'ssb_widget_reg_func' );
 
