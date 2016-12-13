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
 */    //from footer.php the place where it must appear  ?>
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php $options = get_option( 'like_this_site' ); ?> 
<div id="vote" class="<?php echo $options['like_this_site_class']; ?>">            
    <?php if ($options['like_this_site_label_position'] == "top") {
      echo $options['like_this_site_label']; } ?>  
        <a href="#"><i style="color:<?php echo $options['like_this_site_color']; ?>;" class="fa fa-<?php echo $options['like_this_site_icon']; ?> fa-2x"></i></a>
    <?php if ($options['like_this_site_label_position'] == "bottom") {
      echo $options['like_this_site_label']; } ?>
      <div class="result-label-<?php echo $options['like_this_site_class']; ?>"><?php echo $options['like_this_site_label_result']; ?></div>
      <div class="result-count-<?php echo $options['like_this_site_class']; ?>">resultat</div> 
</div>     

<div id="count" class="hide"></div>
    
<div id="thankyouModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-body">
    <p class="center main-color"><h2>Merci pour votre soutien !</h2></p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
  </div>
</div>