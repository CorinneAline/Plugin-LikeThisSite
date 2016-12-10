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

<div id="vote">            
  <a href="#"><i class="fa fa-thumbs-up fa-5x main-color"></i></a>
</div>            
           <?php 
           $file_dir = get_theme_root().'/resoclick-verso/';
           $file = $file_dir.'/likes.txt';
           $handle = @fopen($file, "r");
            if ($handle) {
                while (($buffer = fgets($handle, 4096)) !== false) {
                    $count = $buffer;
                }
                if (!feof($handle)) {
                    echo "Erreur: fgets() a échoué\n";
                }
                fclose($handle);
            }
           
           ?> 
    <div class="row-fluid voffset3">
    <h5>Total des votes</h5>
    <i class="fa fa-thumbs-up fa-2x"></i>
    <span id="total" class="label"><?php echo $count ; ?></span>
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