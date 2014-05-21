<?php
// print_r($_POST);die();
global $ssb;
$ssb = get_option("ssb_option");
// print_r($ssb);


function ssb_get_fields(){
    $fields = array();
    $fields['General'] = array(
        array('type'=>'hidden'), //this one is cuz, i dont want the settings array to be empty as this might show  "Illegal string offset" warning on Line 56
        array('title'=>'Show in pages','id'=>'show_pages','type'=>'checkbox'),
        array('title'=>'Show in posts','id'=>'show_posts','type'=>'checkbox'),
        array('title'=>'Show in Excerpt','id'=>'show_excerpt','type'=>'checkbox'),
        array('title'=>'Enable widget','id'=>'show_widget','type'=>'checkbox'),
        array('title'=>'Enable short code','id'=>'show_shortcode','type'=>'checkbox'),
        array('type'=>'line'),

        array('title'=>'Disable plugin in posts/pages ID (comma separated)','id'=>'hide_in_id','type'=>'text'),

        array('title'=>'Show in page/post top','id'=>'show_top','type'=>'checkbox'),
        array('title'=>'Show in page/post bottom','id'=>'show_bottom','type'=>'checkbox')
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
    );

    // $fields['Edit Css'] = array(
    //     array('title'=>'Facebook like button','id'=>'ssb_css','type'=>'textarea'),
    // );


return $fields;

}






function ssb_get_fields_html($field_ary,$i)
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
            $ssb_sub = get_option("ssb_option");
            if(isset($ssb_sub[$field['id']]))
             $curval = $ssb_sub[$field['id']];
         else
            $curval='';
                        $curval = str_replace("\'", "'", $curval);
                        $curval = str_replace("\\\"", "\"", $curval);


            $html.='<tr valign="top"><th scope="row"><label for="'.$field['id'].'">'.$field['title'].'</label></th><td>';

            switch($field['type'])
            {
                case 'textarea':
                    $html.='<textarea style="width: 25em;" rows=4 id="'.$field['id'].'" name="ssb_options['.$field['id'].']" class="regular-text">'. $curval.'</textarea>';
                                break;
                            case 'text':
                                $html.='<input id="'.$field['id'].'" type="text" name="ssb_options['.$field['id'].']" value="'. $curval.'" class="regular-text" />';
                                break;
                            case 'checkbox':
                                $html.='<input id="'.$field['id'].'" type="checkbox" name="ssb_options['.$field['id'].']" value="1" class="" ';
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



function ssb_admin_function(){
    if(!current_user_can('manage_options')){ wp_die('You do not have sufficient permissions to access this page.');}
    // $tabs = array('','Buttons','Others');

    if (isset($_POST["update_settings"]))
    {
        $ssb_settings = $_POST["ssb_options"];
        // print_r($_ssb_post);
        update_option("ssb_option", $ssb_settings);
        echo'<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>Settings saved.</strong></p></div>';
    }
    $ssb = get_option("ssb_option");
    // print_r($ssb);
    $opt = "";
    echo'<div class="wrap">';
    screen_icon('admin');
    echo'<h2>Social Share Boost Settings</h2>';









            global $current_user;

            $user_id = $current_user->ID;
            if ( !get_user_meta($user_id, 'ssb_whatsnewbox32') ):
        ?>
            <div id="whatsnew" style="background-color: #e4f2fd;border-color: #539bb9;color: #333;text-shadow: 1px 1px 0 #fff;padding: 1em;-webkit-border-radius: 3px;border-radius: 3px;border-width: 1px;border-style: solid;margin: 0 0 1em;">
            <h2>Social Share Boost – new and improved!</h2>
            <ul>

                <li><strong>3.2 FIX:</strong> Removed that stupid 'tweet' text</li>

                  <li> &nbsp;&nbsp;</li>
  <li></li>

                <li><strong>NEW FEATURE:</strong> It is now possible to de-activate the plugin on specific pages or posts, just write the ID's of the posts/pages <sub>(comma Separated)</sub> in the textbox below.</li>

                <li><strong>NEW FEATURE:</strong> It is now possible to edit the css directly from the wordpress dashboard.</li>

                <li><strong>NEW FEATURE:</strong>Added many new buttions.</li>
                <li><strong>NEW FEATURE:</strong>Buttons are separately enabled/disabled for widgets. Basically widget is more powerful now !</li>

                <li><strong>NEW SHORTCODE:</strong> <code>[ssboost url=<?php echo home_url();?>]</code> – outputs the buttons to share the url specified url field. <br />The plugin's shortcode can be used in 2 ways: <code>[ssboost url=<?php echo home_url();?>]</code> and <code>[ssboost]</code>.</li>


                <li><strong>3.2 FIX:</strong> Removed that stupid 'tweet' text</li>
                <li></li>


                <li>And many more <strong> performance improvements </strong> and <strong>bugfixes</strong>.</li>
            </ul>


            <a href="admin.php?page=social-share-boost&amp;ssb_whatsnewbox32=0" class="button-secondary">Dismiss</a>
            </div>
        <?php endif;
















    echo'<form method="POST" action=""><h3 class="nav-tab-wrapper">';
    $tabs  = ssb_get_fields();
    $i=1;
    foreach($tabs as $tab=>$field_ary)
    {
        if($i==1){$class ="nav-tab-active";}else{$class='';}
        echo '<a href="#tab'.$i.'" class="nav-tab nac-tab '.$class.'">'.$tab.'</a>';
        $opt.=ssb_get_fields_html($field_ary,$i);
        $i++;
    }

        echo '<a href="#tab'.$i.'" class="nav-tab nac-tab '.$class.'">Edit CSS</a>';
        $opt.=edit_css_func();
    echo'</h3>';
    echo $opt;
    echo'<p class="submit"><input name="update_settings" id="submit_options_form" type="submit" class="button-primary" value="Save Settings" /></p></form></div>';
    return '';
}


function ssb_settings_menu(){add_menu_page('Social Share Boost', 'S. S. Boost', 'administrator', 'social-share-boost', 'ssb_admin_function');}



function ssb_admin_script(){wp_register_script( 'theme_wp_admin_css', plugins_url('js/admin-js.js', __FILE__));wp_enqueue_script( 'theme_wp_admin_css' );}


add_action('admin_menu', 'ssb_settings_menu');


add_action( 'admin_enqueue_scripts', 'ssb_admin_script' );








function edit_css_func()
{
    $filename=plugin_dir_path( __FILE__ )."css/style.css";
    if(isset($_POST['css_editor']))
    {
        $fw = fopen($filename,'w') or die('line 5');
        //write to file
        $fb=fwrite($fw,stripslashes($_POST['css_editor'])) or die('line 7');
        //close file
        fclose($fw);
        // file_put_contents("css/style.css" ,$_POST['css_editor']);
    }

    $this_html ='';
    $this_html.='<div class="wp-tab-panela" id="tab3" style="display:none" ><table class="form-table">';
    $this_html.='<tr valign="top"><th scope="row"><label for="css_editor">Edit the css file: </label></th><td><textarea onkeypress="jQuery(this).attr(\'name\',\'css_editor\');" style="width: 25em;" rows=4 id="css_editor" name="css_editor2" class="regular-text">';
// $file_contents = file_get_contents( "" ,true);
 // $file_contents;


// clearstatcache();
$fh=fopen($filename ,'r',true) or die('line 11');

$this_html.= fread($fh,filesize($filename )) or die('unable to read');

fclose($fh);



$this_html.='</textarea></td></tr>';
$this_html .="</table></div>";
return $this_html;
}
