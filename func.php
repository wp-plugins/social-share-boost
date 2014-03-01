<?php
global $ssb;
function ssb_in_content($content)
{
    global $ssb;

if(is_singular()  ){ 

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
function ssb_in_excerpt($content)
{
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
function gplus_btn_script()
{
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
function ssb_shortcode( $atts )
{
     extract( shortcode_atts( array(
          'url' => get_permalink()
     ), $atts ) );
     global $ssb;
     $s = $ssb;
     $s['url2share'] = "{$url}";
     return ssb_output(0,$s,0);
}



 

class ssb_widget extends WP_Widget
{
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
        

        echo'<p><label for="'. $this->get_field_id('title').'">Title:</label><input class="widefat" id="'. $this->get_field_id('title').'" name="'. $this->get_field_name('title').'>" type="text" value="'. $title.'" /></p>';
        echo'<p><label for="'. $this->get_field_id('url').'">Url to share(leave empty to use homeurl):</label><input class="widefat" id="'. $this->get_field_id('url').'" name="'. $this->get_field_name('url').'>" type="text" value="'. $url.'" /></p>';

        echo'<p><label for="'. $this->get_field_id('fb_like').'">Facebook Like:</label> &nbsp;&nbsp; <input class="widefat" id="'. $this->get_field_id('fb_like').'" name="'. $this->get_field_name('fb_like').'>" type="checkbox" ';
        if ($fb_like)
            echo ' checked=checked ';
        echo'value="1" /></p>';

           echo'<p><label for="'. $this->get_field_id('fb_share').'">Facebook Share:</label> &nbsp;&nbsp; <input class="widefat" id="'. $this->get_field_id('fb_share').'" name="'. $this->get_field_name('fb_share').'>" type="checkbox" ';
        if ($fb_share)
            echo ' checked=checked ';
        echo'value="1" /></p>';


           echo'<p><label for="'. $this->get_field_id('twtr').'">Tweeter:</label> &nbsp;&nbsp; <input class="widefat" id="'. $this->get_field_id('twtr').'" name="'. $this->get_field_name('twtr').'>" type="checkbox" ';
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





    }
}
function ssb_widget_reg_func() {
    register_widget( 'ssb_widget' );
}
function ssb_notice() {
    global $current_user, $pagenow;
    $user_id = $current_user->ID;
    
    /* Check that the user hasn't already clicked to ignore the message */
    if ( ! get_user_meta($user_id, 'ssb_notice_ignore31') ) {
        if( $pagenow != 'admin.php' && $_GET['page'] != 'social-share-boost' ) {
            echo '<div class="updated"><p>';
            printf(__('<a href="%1$s" style="float: right;">Dismiss</a>'), '?ssb_notice_ignore31=0');
            echo '<strong>Social Share Boost has gone through a major overhaul in version 3.1! ';
            printf(__('<a href="%1$s">Find out what’s new!</a>'), 'admin.php?page=social-share-boost&whatsnew=true');
            echo '</strong>';
            echo "</p></div>";
        }
    }
}
function ssb_notice_ignore31_func() {
    global $current_user, $pagenow;

    $user_id = $current_user->ID;
    
    if( $pagenow == 'admin.php' && $_GET['page'] == 'social-share-boost' && isset($_GET['whatsnew']) && $_GET['whatsnew']=='true' ) {
        add_user_meta($user_id, 'ssb_notice_ignore31', 'true', true);
    }

    if ( isset($_GET['ssb_notice_ignore31']) && '0' == $_GET['ssb_notice_ignore31'] ) {
        add_user_meta($user_id, 'ssb_notice_ignore31', 'true', true);
    }

    if ( isset($_GET['ssb_whatsnewbox31']) && '0' == $_GET['ssb_whatsnewbox31'] ) {
        add_user_meta($user_id, 'ssb_whatsnewbox31', 'true', true);
    }
}




if(isset($ssb['show_shortcode'])){add_shortcode( 'ssboost', 'ssb_shortcode' );}
if(isset($ssb['show_excerpt'])){add_filter('the_excerpt', 'ssb_in_excerpt');}
if(isset($ssb['show_widget'])){add_action( 'widgets_init', 'ssb_widget_reg_func' );}
 
add_filter('the_content', 'ssb_in_content');
 
add_action( 'wp_enqueue_scripts', 'ssb_button_scripts' );
add_action('admin_notices', 'ssb_notice');
add_action('admin_init', 'ssb_notice_ignore31_func');
