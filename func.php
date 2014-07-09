<?php

function ssb_get_fields(){
	$fields = array();
	$fields['General'] = array(
		array('type'=>'hidden'), //this one is cuz, i dont want the settings array to be empty as this might show  "Illegal string offset" warning on Line 56
		array('title'=>'Show in pages','id'=>'show_pages','type'=>'checkbox'),
		array('title'=>'Show in posts','id'=>'show_posts','type'=>'checkbox'),
		array('title'=>'Show in Excerpt','id'=>'show_excerpt','type'=>'checkbox') ,
		array('type'=>'line'),
		array('title'=>'Disable plugin in posts/pages ID (comma separated)','id'=>'hide_in_id','type'=>'text'),
		array('title'=>'Show in page/post top','id'=>'show_top','type'=>'checkbox'),
		array('title'=>'Show in page/post bottom','id'=>'show_bottom','type'=>'checkbox'),
		array('title'=>'Hide Notices <sub>(enable this if you see some errors/notices)</sub>','id'=>'hide_erors','type'=>'checkbox')
	);

	$fields['Buttons'] = array(
		array('title'=>'Facebook like button','id'=>'show_button_fb_like','type'=>'checkbox'),
		array('title'=>'Facebook share button <sub>(like button above must be enabled)</sub>','id'=>'show_button_fb_share','type'=>'checkbox'),
		array('title'=>'Tweet Button','id'=>'show_button_twtr','type'=>'checkbox'),
		array('title'=>'Google+ button','id'=>'show_button_gplus','type'=>'checkbox'),
		array('title'=>'Pinterest button','id'=>'show_button_pintrest','type'=>'checkbox'),
		array('title'=>'Stumble button','id'=>'show_button_stumble','type'=>'checkbox'),
		array('title'=>'Tumblr button','id'=>'show_button_tumblr','type'=>'checkbox'),
		array('title'=>'LinkedIn button','id'=>'show_button_linkedin','type'=>'checkbox'),
		array('title'=>'Scoop It button','id'=>'show_button_scoopit','type'=>'checkbox'),
		array('title'=>'XING button','id'=>'show_button_xing','type'=>'checkbox'),



	);


	$fields['Button Width'] = array(
		array('title'=>'Facebook like button','id'=>'width_button_fb_like','type'=>'text'),
		array('title'=>'Facebook share button ','id'=>'width_button_fb_share','type'=>'text'),
		array('title'=>'Tweet Button','id'=>'width_button_twtr','type'=>'text'),
		array('title'=>'Google+ button','id'=>'width_button_gplus','type'=>'text'),
		array('title'=>'Pinterest button','id'=>'width_button_pintrest','type'=>'text'),
		array('title'=>'Stumble button','id'=>'width_button_stumble','type'=>'text'),
		array('title'=>'Tumblr button','id'=>'width_button_tumblr','type'=>'text'),
		array('title'=>'LinkedIn button','id'=>'width_button_linkedin','type'=>'text'),
		array('title'=>'Scoop It button','id'=>'width_button_scoopit','type'=>'text'),
		array('title'=>'XING button','id'=>'width_button_xing','type'=>'text'),



	);





// $fields['Social Profile Icons'] = array(
// 		array('title'=>'Facebook Page Url:','id'=>'show_button_fb_like','type'=>'checkbox'),
// 		array('title'=>'Twitter Profile Url','id'=>'show_button_fb_share','type'=>'checkbox'),
// 		array('title'=>'You Tube Channel Url','id'=>'show_button_twtr','type'=>'checkbox'),
// 		array('title'=>'Google+ button','id'=>'show_button_gplus','type'=>'checkbox'),
// 		array('title'=>'Pinterest button','id'=>'show_button_pintrest','type'=>'checkbox'),
// 		array('title'=>'Stumble button','id'=>'show_button_stumble','type'=>'checkbox'),
// 		array('title'=>'Tumblr button','id'=>'show_button_tumblr','type'=>'checkbox'),
// 		array('title'=>'LinkedIn button','id'=>'show_button_linkedin','type'=>'checkbox'),
// 		array('title'=>'Scoop It button','id'=>'show_button_scoopit','type'=>'checkbox'),

// 	);

	// $fields['Edit Css'] = array(
	//     array('title'=>'Facebook like button','id'=>'ssb_css','type'=>'textarea'),
	// );


return $fields;

}












function ssb_output($upu,$ssb_artificial,$is_widget)
{

	
$width_array = array();
$width_array['width_button_fb_like'] = ($ssb_artificial['width_button_fb_like']!="") ? $ssb_artificial['width_button_fb_like'] : '86';
$width_array['width_button_fb_share'] = ($ssb_artificial['width_button_fb_share']!="") ? $ssb_artificial['width_button_fb_share'] : '135';
$width_array['width_button_twtr'] = ($ssb_artificial['width_button_twtr']!="") ? $ssb_artificial['width_button_twtr'] : '90';
$width_array['width_button_gplus'] = ($ssb_artificial['width_button_gplus']!="") ? $ssb_artificial['width_button_gplus'] : '68';
$width_array['width_button_pintrest'] = ($ssb_artificial['width_button_pintrest']!="") ? $ssb_artificial['width_button_pintrest'] : '47';
$width_array['width_button_stumble'] = ($ssb_artificial['width_button_stumble']!="") ? $ssb_artificial['width_button_stumble'] : '75';
$width_array['width_button_tumblr'] = ($ssb_artificial['width_button_tumblr']!="") ? $ssb_artificial['width_button_tumblr'] : '85';
$width_array['width_button_linkedin'] = ($ssb_artificial['width_button_linkedin']!="") ? $ssb_artificial['width_button_linkedin'] : '64';
$width_array['width_button_scoopit'] = ($ssb_artificial['width_button_scoopit']!="") ? $ssb_artificial['width_button_scoopit'] : '90';
$width_array['width_button_xing'] = ($ssb_artificial['width_button_xing']!="") ? $ssb_artificial['width_button_xing'] : '56';




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
			$ssb_html.='2" style="width:'.$width_array['width_button_fb_share'].'px';
		else
			$ssb_html.='1" style="width:'.$width_array['width_button_fb_like'].'px';
		$ssb_html.='"><iframe src="//www.facebook.com/plugins/like.php?href='.urlencode($url_to_share).'&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=';

 
		if(isset($ssb_artificial['show_button_fb_share']))
			$ssb_html.='true&amp;width='.$width_array['width_button_fb_share'];
		else
			$ssb_html.='false&amp;width='.$width_array['width_button_fb_like'];
		$ssb_html.='&amp;height=21&amp;appId=307091639398582" scrolling="no" frameborder="0" style="border:none; overflow:hidden;  width:150px; height:21px;" allowTransparency="true"></iframe></li>';

 
 

	}
	if(isset($ssb_artificial['show_button_twtr']))
	{
		$ssb_html.='<li class="twtr" style="width:'.$width_array['width_button_twtr'].'px"><a href="https://twitter.com/share" class="twitter-share-button" data-url="'.$url_to_share.'">&nbsp;</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script></li>';
	}

	// if($ssb_artificial['show_button_twtrfollow'])
	// 	$ssb_html.='<li></li>';

	if(isset($ssb_artificial['show_button_gplus']))
	{
		$ssb_html.='<li class="gplus" style="width:'.$width_array['width_button_gplus'].'px"><div class="g-plusone" data-size="medium" data-href="'.$url_to_share.'"></div></li>';
		add_action('wp_footer', 'gplus_btn_script');
	}
	if(isset($ssb_artificial['show_button_pintrest']))
	{
		$ssb_html.='<li class="ssb_pin" style="width:'.$width_array['width_button_pintrest'].'px"><a href="//www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" ><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" /></a></li>';
		wp_enqueue_script('pintrest_script');
	}
	if(isset($ssb_artificial['show_button_stumble']))
	{
		$ssb_html.='<li class="ssb_stum" style="width:'.$width_array['width_button_stumble'].'px"><su:badge layout="1" location="'.$url_to_share.'"></su:badge><script type="text/javascript">
		(function() {
			var li = document.createElement(\'script\'); li.type = \'text/javascript\'; li.async = true;
			li.src = (\'https:\' == document.location.protocol ? \'https:\' : \'http:\') + \'//platform.stumbleupon.com/1/widgets.js\';
			var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(li, s);
		})();</script></li>';
	}
	if(isset($ssb_artificial['show_button_tumblr']))
	{
		$ssb_html.='<li class="ssb_tublr" style="width:'.$width_array['width_button_tumblr'].'px"><a href="http://www.tumblr.com/share/link?url='.urlencode($url_to_share) .'&name='.urlencode('INSERT_NAME_HERE') .'&description='.urlencode('INSERT_DESCRIPTION_HERE') .'" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:'.$width_array['width_button_tumblr'].'px; height:20px; background:url(\'http://platform.tumblr.com/v1/share_1.png\') top left no-repeat transparent;">Share on Tumblr</a></li>';
		wp_enqueue_script( 'tumblr_script' );
	}
	if(isset($ssb_artificial['show_button_linkedin']))
	{
		$ssb_html.='<li class="ssb_linkedin" style="width:'.$width_array['width_button_linkedin'].'px"><script src="//platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script><script type="IN/Share" data-url="'.$url_to_share.'" data-counter="right"></script></li>';
	}

		if(isset($ssb_artificial['show_button_scoopit']))
	{
		$ssb_html.='<li class="ssb_scoopit" style="width:'.$width_array['width_button_scoopit'].'px"><a href="http://www.scoop.it" class="scoopit-button" scit-position="horizontal" scit-url="'.$url_to_share.'" >&nbsp;</a><script type="text/javascript" src="http://www.scoop.it/button/scit.js"></script>
		</li>';
	}

if(isset($ssb_artificial['show_button_xing']))
	{


	$ssb_html.='<li class="ssb_xing" style="width:'.$width_array['width_button_xing'].'px"><div data-type="XING/Share" data-counter="right"   style="width:'.$width_array['width_button_xing'].'px" data-url="'.$url_to_share.'"></div>
<script>
  ;(function (d, s) {
    var x = d.createElement(s),
      s = d.getElementsByTagName(s)[0];
      x.src = "https://www.xing-share.com/js/external/share.js";
      s.parentNode.insertBefore(x, s);
  })(document, "script");
</script></li>';


}






	$ssb_html.="</ul>";

	
	return $ssb_html;
}



function ssb_in_content($content){
	global $ssb; 

	if(1 ){

	$hide_list = $ssb['hide_in_id'];
	$hide_arr = explode(",", $hide_list);

	foreach ($hide_arr as $key => $value) {
		$hide_arr[$key] = trim($value);
	}
	//print_r($hide_arr);
	$this_id = get_the_ID();
	if (in_array($this_id, $hide_arr))
		return $content;
	if(  (get_post_type( $this_id )=="page" && isset($ssb['show_pages'])) or  (get_post_type( $this_id )=="post" && isset($ssb['show_posts']))   )
	{
		// print_r($ssb);
		if(isset($ssb['show_top']) && $ssb['show_top']==1)
			$content = ssb_output(1, $ssb,0).$content;
		if(isset($ssb['show_bottom']) && $ssb['show_bottom']==1)
			$content =$content.ssb_output(1, $ssb,0);
	}}

	  return $content;
}


function ssb_in_excerpt($content){
	global $ssb;

	if(1 ){
	if( get_post_type( $this_id )=="post" && isset($ssb['show_posts']))
	{
		// print_r($ssb);
		if(isset($ssb['show_top']) && $ssb['show_top']==1)
			$content = ssb_output(1, $ssb,0).$content;
		if(isset($ssb['show_bottom']) && $ssb['show_bottom']==1)
			$content =$content.ssb_output(1, $ssb,0);
	}

   }
	  return $content;
}



function ssb_button_scripts() {
	wp_register_script('tumblr_script','http://platform.tumblr.com/v1/share.js',false,'1.0',true);
	wp_register_script('pintrest_script','//assets.pinterest.com/js/pinit.js',false,'1.0',true);
	wp_register_style('ssb_style', plugins_url('css/style.css', __FILE__));
	wp_enqueue_style('ssb_style');
}
function gplus_btn_script(){
	?>
	<script type="text/javascript">
	(function() {
		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		po.src = 'https://apis.google.com/js/platform.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	})();
	</script>
	<?php
}

function ssb_shortcode( $atts ){
	 extract( shortcode_atts( array(
		  'url' => get_permalink()
	 ), $atts ) );
	 global $ssb;
	 $s = $ssb;
	 $s['url2share'] = "{$url}";
	 return ssb_output(0,$s,0);
}

 add_shortcode( 'ssboost', 'ssb_shortcode' ); 
if(isset($ssb['show_excerpt'])){add_filter('the_excerpt', 'ssb_in_excerpt');}

add_filter('the_content', 'ssb_in_content');
add_action( 'wp_enqueue_scripts', 'ssb_button_scripts' );




