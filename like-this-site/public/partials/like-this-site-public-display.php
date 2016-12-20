<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://www.resoclick.com
 * @since      1.0.0
 *
 * @package    Like_This_Site
 * @subpackage Like_This_Site/public/partials
 */   
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
function like_this_site_filter(){
    $options = get_option( 'like-this-site_options' ); 
    echo '<div id="primary class="col-md-3 sidebar widget-area">';            
    if ($options['like_this_site_label_position'] == "top") {
      echo '<h2>' . $options['like_this_site_label'] . '</h2>'; } 
    echo '<br><a id="vote" href="#"><i style="color:#' . $options['like_this_site_color'] .'" class="fa fa-' . $options['like_this_site_icon'] .' fa-2x"></i></a>';
    if ($options['like_this_site_label_position'] == "bottom") {
      echo $options['like_this_site_label']; } 
    echo   '<div class="result-label">' . $options['like_this_site_label_result'] .':<span id="votes">' . ($options['like_this_site_plugin_votes']) . '</span></div></div>';
     
}  

//add_shortcode('first', 'wp_first_shortcode'); 
add_filter( 'get_sidebar', 'like_this_site_filter' );
//do_action( 'test' );



?>

<div id="count" class="hide"></div>
