<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.resoclick.com
 * @since      1.0.0
 *
 * @package    Like_This_Site
 * @subpackage Like_This_Site/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Like_This_Site
 * @subpackage Like_This_Site/admin
 * @author     Corinne Resoclick <resoclick@free.fr>
 */
class Like_This_Site_Admin {
  
  /**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
  
  	/**
	 * The settings of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $settings    The current settings of this plugin.
	 */
	private $settings = array();
  
  /**
	 * The prefix to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$prefix 	Prefix of the functions of this plugin
	 */
	private $prefix;

  
  /**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
  public function __construct($plugin_name, $version) {  
      $this->settings = get_option( $plugin_name .'_options' );
      
      //Si pas d'options en base de données, valeurs par défaut
      if (!$icon = $this->settings['like_this_site_icon']) : $icon = 'thumbs-up'; endif;
      if (!$color = $this->settings['like_this_site_color']) : $color = '8FFC00'; endif;
      if (!$label = $this->settings['like_this_site_label']) : $label = 'Votez pour ce site !'; endif;
      if (!$label_position = $this->settings['like_this_site_label_position']) : $label_position = 'top'; endif;
      if (!$label_result = $this->settings['like_this_site_label_result']) : $label_result = 'Nombre de votes'; endif;
      if (!$plugin_position = $this->settings['like_this_site_plugin_position']) : $plugin_position = 'sidebar'; endif;
      if (!$plugin_votes = $this->settings['like_this_site_plugin_votes']) : $plugin_votes = 0 ; endif;
      
      if (empty($this->settings)) {   
        $default_values = array (
        'like_this_site_icon'  => $icon,
        'like_this_site_color'  => $color,
        'like_this_site_label' => $label,
        'like_this_site_label_position' => $label_position,
        'like_this_site_label_result'   => $label_result,
        'like_this_site_plugin_position' => $plugin_position,
        'like_this_site_plugin_votes' => $plugin_votes
        );
        
        $this->settings = $default_values ;
     } 
       
      $this->plugin_name = $plugin_name;
		  $this->version = $version;
      $this->prefix = 'like_this_site';
  }
 
  

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Like_This_Site_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Like_This_Site_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
    
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/like-this-site-admin.css', array(), $this->version, 'all' );
    wp_enqueue_style( 'font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), '4.7.0', 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Like_This_Site_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Like_This_Site_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
    
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/like-this-site-admin.js', array( 'jquery' ), $this->version, true );
    wp_enqueue_script( 'jscolor', plugin_dir_url( __FILE__ ) . 'js/jscolor.min.js', array( 'jquery' ), $this->version, true );
	}
  
  /**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {
	
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Réglages LikeThisSite', 'like-this-site' ),
			__( 'Like This Site', 'like-this-site' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
	
	}
  
  /**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
		
    include_once 'partials/like-this-site-admin-display.php';
    
	}
  
   /**
	 * Register the settings of the plugin
	 *
	 * @since  1.0.0
	 */
	public function register_setting() {
   // Add a General section 
  	add_settings_section(
  		$this->prefix . '_general',
  		__( 'Réglages LikeThisSite', 'like-this-site' ),
  		array( $this, $this->prefix . '_general_cb' ),
  		$this->plugin_name
  	);  
    
    // Add a Result section to see how the things will appear
  	add_settings_section(
  		$this->prefix . '_resultat',
  		__( 'Résultat', 'like-this-site' ),
  		array( $this, $this->prefix . '_resultat_cb' ),
  		$this->plugin_name
  	);  
    
     add_settings_field(
  		$this->prefix . '_icon',
  		__( 'Icône', 'like-this-site' ),
  		array( $this, $this->prefix . '_icon_cb' ),
  		$this->plugin_name,
  		$this->prefix . '_general',
  		array( 'label_for' => $this->prefix . '_icon' )
  	);
    
    add_settings_field(
  		$this->prefix . '_color',
  		__( 'Couleur', 'like-this-site' ),
  		array( $this, $this->prefix . '_color_cb' ),
  		$this->plugin_name,
  		$this->prefix . '_general',
  		array( 'label_for' => $this->prefix . '_color' )
  	);
    
     add_settings_field(
  		$this->prefix . '_label',
  		__( 'Label à afficher', 'like-this-site' ),
  		array( $this, $this->prefix . '_label_cb' ),
  		$this->plugin_name,
  		$this->prefix . '_general',
  		array( 'label_for' => $this->prefix . '_label', 'name' => $this->plugin_name .'_options[' .$this->prefix . '_label]',
        'value' => $this->settings['like_this_site_label'],)
  	); 
    
    add_settings_field(
  		$this->prefix . '_label_position',
  		__( 'Position du label', 'like-this-site' ),
  		array( $this, $this->prefix . '_label_position_cb' ),
  		$this->plugin_name,
  		$this->prefix . '_general',
  		array( 'label_for' => $this->prefix . '_position' )
  	);
    
    add_settings_field(
  		$this->prefix . '_label_result',
  		__( 'Libellé du résultat', 'like-this-site' ),
  		array( $this, $this->prefix . '_label_result_cb' ),
  		$this->plugin_name,
  		$this->prefix . '_general',
  		array( 'label_for' => $this->prefix . '_label_result' )
  	);
    
     add_settings_field(
  		$this->prefix . '_plugin_position',
  		__( 'Emplacement du plugin', 'like-this-site' ),
  		array( $this, $this->prefix . '_plugin_position_cb' ),
  		$this->plugin_name,
  		$this->prefix . '_general',
  		array( 'label_for' => $this->prefix . '_plugin_position' )
  	);
    
    register_setting( $this->plugin_name, $this->plugin_name . '_options', array( $this, $this->prefix . '_validate_inputs' ));
   
  }
  
  /**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function like_this_site_general_cb() {
		echo '<p>'.__( 'Choisir les options.', 'like-this-site' ) . '</p>';
	}
  
   /**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function like_this_site_resultat_cb() {
    $display_label = '<div id="initial_label">' . $this->settings['like_this_site_label'] . '</div>';
    $display_icon =  '<div style="color:#' . $this->settings['like_this_site_color'] . '"><i class="fa fa-' . $this->settings['like_this_site_icon'] . ' fa-2x"></i></div>' ;
    $display_button = '<br><button id="reset">'.__('Réinitialiser', 'like-this-site') .'</button>';
    $display_number = '<b>' . $this->settings['like_this_site_plugin_votes'] . '</b>' ;
    $display_result = '<div class="display_result">'. $this->settings['like_this_site_label_result'] . '</div>'; 
    if ($this->settings['like_this_site_label_position'] == "top")
    {
        $output_display = $display_label.$display_icon ; 
    }
    else
    {
        $output_display = $display_icon.$display_label ; 
    }
		echo '<div id="like_this_site_zone_resultat">'.__( 'Visualisation du résultat.', 'like-this-site' ) . '<div id="like_this_site_resultat">'
             . $output_display . $display_number . $display_result .
    '</div></div>';
    echo $display_button;
	}
  
  /**
	 * Render the radio input field for icon option
	 *
	 * @since  1.0.0
	 */
	public function like_this_site_icon_cb() {
		?>
    <div id="like_this_site_icone">
      <fieldset>
				<label>
					<input type="radio" name="<?php echo $this->prefix . '_icon' ?>" id="<?php echo $this->prefix . '_icon' ?>" value="thumbs-up" <?php if ($this->settings['like_this_site_icon'] == 'thumbs-up') : ?>checked = "checked" <?php endif;  ?>>
					<i class="fa fa-2x fa-thumbs-up"></i>
				</label>
				<br>
				<label>
          <input type="radio" name="<?php echo $this->prefix . '_icon' ?>" id="<?php echo $this->prefix . '_icon' ?>" value="thumbs-o-up" <?php if ($this->settings['like_this_site_icon'] == 'thumbs-o-up') : ?>checked = "checked" <?php endif;  ?>>
          <i class="fa fa-2x fa-thumbs-o-up"></i>					
				</label>
        <br>
        <label>
					<input type="radio" name="<?php echo $this->prefix . '_icon' ?>" id="<?php echo $this->prefix . '_icon' ?>" value="heart" <?php if ($this->settings['like_this_site_icon'] == 'heart') : ?>checked = "checked" <?php endif;  ?>>
					<i class="fa fa-2x fa-heart"></i>
				</label>
        <br>
        <label>
					<input type="radio" name="<?php echo $this->prefix . '_icon' ?>" id="<?php echo $this->prefix . '_icon' ?>" value="heart-o" <?php if ($this->settings['like_this_site_icon'] == 'heart-o') : ?>checked = "checked" <?php endif;  ?>>
					<i class="fa fa-2x fa-heart-o"></i>
				</label>
        <br>
        <label>
					<input type="radio" name="<?php echo $this->prefix . '_icon' ?>" id="<?php echo $this->prefix . '_icon' ?>" value="plus" <?php if ($this->settings['like_this_site_icon'] == 'plus') : ?>checked = "checked" <?php endif;  ?>>
					<i class="fa fa-2x fa-plus blue"></i>
				</label>
        <br>
        <label>
					<input type="radio" name="<?php echo $this->prefix . '_icon' ?>" id="<?php echo $this->prefix . '_icon' ?>" value="plus-circle" <?php if ($this->settings['like_this_site_icon'] == 'plus-circle') : ?>checked = "checked" <?php endif;  ?>>
					<i class="fa fa-2x fa-plus-circle"></i>
				</label>
			</fieldset>
    </div>
		<?php
	}
  
  /**
	 * Render the radio input field for icon option
	 *
	 * @since  1.0.0
	 */
	public function like_this_site_color_cb() {
		?>
  <div id="like_this_site_color">
    <fieldset>
        <table>
  				<tr>
  					<td><input type="radio" name="<?php echo $this->prefix . '_color' ?>" id="<?php echo $this->prefix . '_color' ?>" value="FFFFFF" <?php if ($this->settings['like_this_site_color'] == "FFFFFF") : ?>checked = "checked" <?php endif;  ?>></td>
  					<td class="td_color" bgcolor="#FFFFFF"></td>
            <td></td>
            <td><input type="radio" name="<?php echo $this->prefix . '_color' ?>" id="<?php echo $this->prefix . '_color' ?>" value="FF0000" <?php if ($this->settings['like_this_site_color'] == "FF0000") : ?>checked = "checked" <?php endif;  ?>></td>
  					<td class="td_color" bgcolor="#FF0000"></td>
            <td></td>
            <td><input type="radio" name="<?php echo $this->prefix . '_color' ?>" id="<?php echo $this->prefix . '_color' ?>" value="8FFC00" <?php if ($this->settings['like_this_site_color'] == "8FFC00") : ?>checked = "checked" <?php endif;  ?>></td>
  					<td class="td_color" bgcolor="#8FFC00"></td>
            <td></td>
            <td><input type="radio" name="<?php echo $this->prefix . '_color' ?>" id="<?php echo $this->prefix . '_color' ?>" value="003CFF" <?php if ($this->settings['like_this_site_color'] == "003CFF") : ?>checked = "checked" <?php endif;  ?>></td>
  					<td class="td_color" bgcolor="#003CFF"></td>
            <td></td>
            <td><input type="radio" name="<?php echo $this->prefix . '_color' ?>" id="<?php echo $this->prefix . '_color' ?>" value="FC3F00" <?php if ($this->settings['like_this_site_color'] == "FC3F00") : ?>checked = "checked" <?php endif;  ?>></td>
  					<td class="td_color" bgcolor="#FC3F00"></td>
  				</tr>
  				<tr>
  					<td><input type="radio" name="<?php echo $this->prefix . '_color' ?>" id="<?php echo $this->prefix . '_color' ?>" value="00BDFC" <?php if ($this->settings['like_this_site_color'] == "00BDFC") : ?>checked = "checked" <?php endif;  ?>></td>
  					<td class="td_color" bgcolor="#00BDFC"></td>
            <td></td>
            <td><input type="radio" name="<?php echo $this->prefix . '_color' ?>" id="<?php echo $this->prefix . '_color' ?>" value="FCEB00" <?php if ($this->settings['like_this_site_color'] == "FCEB00") : ?>checked = "checked" <?php endif;  ?>></td>
  					<td class="td_color" bgcolor="#FCEB00"></td>
            <td></td>
            <td><input type="radio" name="<?php echo $this->prefix . '_color' ?>" id="<?php echo $this->prefix . '_color' ?>" value="FC00E7" <?php if ($this->settings['like_this_site_color'] == "FC00E7") : ?>checked = "checked" <?php endif;  ?>></td>
  					<td class="td_color" bgcolor="#FC00E7"></td>
            <td></td>
            <td><input type="radio" name="<?php echo $this->prefix . '_color' ?>" id="<?php echo $this->prefix . '_color' ?>" value="1AA125" <?php if ($this->settings['like_this_site_color'] == "1AA125") : ?>checked = "checked" <?php endif;  ?>></td>
  					<td class="td_color" bgcolor="1AA125"></td>
            <td></td>
            <td><input type="radio" name="<?php echo $this->prefix . '_color' ?>" id="<?php echo $this->prefix . '_color' ?>" value="A11A96" <?php if ($this->settings['like_this_site_color'] == "A11A96") : ?>checked = "checked" <?php endif;  ?>></td>
  					<td class="td_color" bgcolor="#A11A96"></td>
  				      <?php $colors_array = array('FFFFFF', 'FF0000','8FFC00','003CFF','FC3F00','00BDFC','FCEB00','FC00E7','1AA125','A11A96'); ?>
            <td><input class="perso-color" type="radio" name="<?php echo $this->prefix . '_color' ?>" id="<?php echo $this->prefix . '_color' ?>" value="<?php  $this->settings['like_this_site_color'] ?>"
                <?php if (!in_array($this->settings['like_this_site_color'],$colors_array)) : ?>checked = "checked" <?php endif;  ?>>
              Couleurs personnalisées
            </td>
            <td><button class="jscolor
                  {valueElement:'valueInput', styleElement:'styleInput'}">
                   Choisir
                </button><input type="hidden" id="valueInput" value="ff6699"><button class="like_this_site_colorOk">Ok</button>
            </td>
  				</tr>
  			</table>
      </fieldset>
    </div>
		<?php
	}
  
  
  /**
	 * Render the label to display
	 *
	 * @since  1.0.0
	 */
	public function like_this_site_label_cb() {
    
      echo '<input placeholder="'. __($this->settings['like_this_site_label'], 'like-this-site') .'" type="text" name="' . $this->prefix . '_label' . '" id="' . $this->prefix . '_label' . '">
      <button id="like_this_site_label_ok_btn">Valider</button> ';
    
	}
  
  
  /**
	 * Render the radio input field for position option
	 *
	 * @since  1.0.0
	 */
	public function like_this_site_label_position_cb() {
		?>
		<div id="like_this_site_label_position">	
      <fieldset>
				<label>
					<input type="radio" name="<?php echo $this->prefix . '_label_position' ?>" value="top" <?php if ($this->settings['like_this_site_label_position'] == 'top') : ?>checked = "checked" <?php endif;  ?>>
					<?php _e( 'Au dessus de l\'icône', 'like-this-site' ); ?>
				</label>
        <br>
        <label>
					<input type="radio" name="<?php echo $this->prefix . '_label_position' ?>" value="bottom" <?php if ($this->settings['like_this_site_label_position'] == 'bottom') : ?>checked = "checked" <?php endif;  ?>>
					<?php _e( 'Au dessous de l\'icône', 'like-this-site' ); ?>
				</label>
			</fieldset>
    </div>
		<?php
	}
  
  
  /**
	 * Render the label_result to display
	 *
	 * @since  1.0.0
	 */
	public function like_this_site_label_result_cb() {
		echo '<input placeholder="'. __($this->settings['like_this_site_label_result'], 'like-this-site') .'" type="text" name="' . $this->prefix . '_label_result' . '" > ';
	}
  
  
   /**
	 * Render the radio input field for plugin position option
	 *
	 * @since  1.0.0
	 */
	public function like_this_site_plugin_position_cb() {
		?>
    <div id="like_this_site_plugin_position">
			<fieldset>
				<label>
					<input type="radio" name="<?php echo $this->prefix . '_plugin_position' ?>" value="footer" <?php if ($this->settings['like_this_site_plugin_position'] == 'footer') : ?>checked = "checked" <?php endif;  ?>>
					<?php _e( 'Dans le pied de page', 'like-this-site' ); ?>
				</label>
				<br>
				<label>
					<input type="radio" name="<?php echo $this->prefix . '_plugin_position' ?>" value="sidebar" <?php if ($this->settings['like_this_site_plugin_position'] == 'sidebar') : ?>checked = "checked" <?php endif;  ?>>
					<?php _e( 'Dans les barres latérales', 'like-this-site' ); ?>
				</label>
        <br>
        <label>
					<input type="radio" name="<?php echo $this->prefix . '_plugin_position' ?>" value="homepage" <?php if ($this->settings['like_this_site_plugin_position'] == 'homepage') : ?>checked = "checked" <?php endif;  ?>>
					<?php _e( 'Sur la page d\'accueil', 'like-this-site' ); ?>
				</label>
			</fieldset>
    </div>
		<?php
	}
 
  
  
  function like_this_site_validate_inputs( ) {
      //$output = array();
      $output = get_option( $plugin_name .'_options' );
      
      $input_icone = $_POST[$this->prefix . '_icon'];
      $input_label = $_POST[$this->prefix . '_label'];
      $input_color = $_POST[$this->prefix . '_color'] ;
      $input_label_position = $_POST[$this->prefix . '_label_position'] ;
      $input_label_result = $_POST[$this->prefix . '_label_result'] ;
      $input_plugin_position = $_POST[$this->prefix . '_plugin_position'] ; 
      
      if (isset($input_icone) && !empty($input_icone)){
          $default_icones = array('thumbs-up','thumbs-o-up','heart','heart-o','plus','plus-circle');
          if (in_array($input_icone, $default_icones))
          {
              $output['like_this_site_icon'] = $input_icone ;
          }
          else
          {
              add_settings_error(  $output['like_this_site_icon'], 'invalid-icone', __('L\'icône spécifié est invalide.' ));
          }
        }
        else {
          $output['like_this_site_icon'] =  $this->settings['like_this_site_icon'];
        }
      
      if (isset($input_label) && !empty($input_label)){
          $output['like_this_site_label'] = sanitize_text_field($input_label);
        }
        else {
          $output['like_this_site_label'] =  $this->settings['like_this_site_label'];
        }
        
      if (isset($input_color) && !empty($input_color)){
         
          if (preg_match_all('/([a-f0-9]{3}){1,2}\b/i',$input_color,$matches))
          {
              $output['like_this_site_color'] = $input_color ;
          }
          else
          {
              add_settings_error(  $output['like_this_site_color'], 'invalid-color', __('La couleur spécifiée est invalide.' ));
          }
        }
        else {
          $output['like_this_site_color'] =  $this->settings['like_this_site_color'];
        }
        
       if (isset($input_label_position) && !empty($input_label_position)){
          $default_label_positions = array('top','bottom');
          if (in_array($input_label_position, $default_label_positions))
          {
              $output['like_this_site_label_position'] = $input_label_position ;
          }
          else
          {
              add_settings_error(  $output['like_this_site_label_position'], 'invalid-label-position', __('La position spécifiée est invalide.' ));
          }
        }
        else {
          $output['like_this_site_label_position'] =  $this->settings['like_this_site_label_position'];
        }
        
       if (isset($input_plugin_position) && !empty($input_plugin_position)){
          $default_plugin_positions = array('footer','sidebar','homepage');
          if (in_array($input_plugin_position, $default_plugin_positions))
          {
              $output['like_this_site_plugin_position'] = $input_plugin_position ;
          }
          else
          {
              add_settings_error(  $output['like_this_site_plugin_position'], 'invalid-plugin-position', __('La position spécifiée est invalide.' ));
          }
        }
        else {
          $output['like_this_site_plugin_position'] =  $this->settings['like_this_site_plugin_position'];
        }
        
     if (isset($input_label_result) && !empty($input_label_result)){
          $output['like_this_site_label_result'] = sanitize_text_field($input_label_result);
        }
        else {
          $output['like_this_site_label_result'] =  $this->settings['like_this_site_label_result'];
        }
        
     //Gestion des votes
      if (!$this->settings['like_this_site_plugin_votes']) : $output['like_this_site_plugin_votes'] = 0; endif;
   
    return $output ;
        
        
  }
  

}
