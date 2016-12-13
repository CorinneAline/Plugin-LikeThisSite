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
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'like_this_site';
  
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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

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
  		$this->option_name . '_general',
  		__( 'Réglages LikeThisSite', 'like-this-site' ),
  		array( $this, $this->option_name . '_general_cb' ),
  		$this->plugin_name
  	);  
    
    // Add a Result section to see how the things will appear
  	add_settings_section(
  		$this->option_name . '_resultat',
  		__( 'Résultat', 'like-this-site' ),
  		array( $this, $this->option_name . '_resultat_cb' ),
  		$this->plugin_name
  	);  
    
     add_settings_field(
  		$this->option_name . '_icon',
  		__( 'Icône', 'like-this-site' ),
  		array( $this, $this->option_name . '_icon_cb' ),
  		$this->plugin_name,
  		$this->option_name . '_general',
  		array( 'label_for' => $this->option_name . '_icon' )
  	);
    
    add_settings_field(
  		$this->option_name . '_color',
  		__( 'Couleur', 'like-this-site' ),
  		array( $this, $this->option_name . '_color_cb' ),
  		$this->plugin_name,
  		$this->option_name . '_general',
  		array( 'label_for' => $this->option_name . '_color' )
  	);
    
     add_settings_field(
  		$this->option_name . '_label',
  		__( 'Label à afficher', 'like-this-site' ),
  		array( $this, $this->option_name . '_label_cb' ),
  		$this->plugin_name,
  		$this->option_name . '_general',
  		array( 'label_for' => $this->option_name . '_label' )
  	); 
    
    add_settings_field(
  		$this->option_name . '_label_position',
  		__( 'Position du label', 'like-this-site' ),
  		array( $this, $this->option_name . '_label_position_cb' ),
  		$this->plugin_name,
  		$this->option_name . '_general',
  		array( 'label_for' => $this->option_name . '_position' )
  	);
    
    add_settings_field(
  		$this->option_name . '_class',
  		__( 'Classe css (facultatif)', 'like-this-site' ),
  		array( $this, $this->option_name . '_class_cb' ),
  		$this->plugin_name,
  		$this->option_name . '_general',
  		array( 'label_for' => $this->option_name . '_class' )
  	);
    
    add_settings_field(
  		$this->option_name . '_label_result',
  		__( 'Libellé du résultat', 'like-this-site' ),
  		array( $this, $this->option_name . '_label_result_cb' ),
  		$this->plugin_name,
  		$this->option_name . '_general',
  		array( 'label_for' => $this->option_name . '_label_result' )
  	);
    
     add_settings_field(
  		$this->option_name . '_plugin_position',
  		__( 'Emplacement du plugin', 'like-this-site' ),
  		array( $this, $this->option_name . '_plugin_position_cb' ),
  		$this->plugin_name,
  		$this->option_name . '_general',
  		array( 'label_for' => $this->option_name . '_plugin_position' )
  	);
    
    register_setting( $this->plugin_name, $this->option_name . '_icon', array( $this, $this->option_name . '_sanitize_icon' ) );
    register_setting( $this->plugin_name, $this->option_name . '_color', array( $this, $this->option_name . '_sanitize_color' ) );
    register_setting( $this->plugin_name, $this->option_name . '_label', array( $this, $this->option_name . '_sanitize_label' ) );
    register_setting( $this->plugin_name, $this->option_name . '_label_position', array( $this, $this->option_name . '_sanitize_label_position' ) );
    register_setting( $this->plugin_name, $this->option_name . '_class', array( $this, $this->option_name . '_sanitize_class' ) );
    register_setting( $this->plugin_name, $this->option_name . '_label_result', array( $this, $this->option_name . '_sanitize_label_result' ) );
    register_setting( $this->plugin_name, $this->option_name . '_plugin_position', array( $this, $this->option_name . '_sanitize_plugin_position' ) );
    
	 
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
		echo '<div id="like_this_site_zone_resultat">'.__( 'Visualisation du résultat.', 'like-this-site' ) . '<div id="like_this_site_resultat"></div></div>';
    echo '<br><button id="reset">'.__('Réinitialiser', 'like-this-site') .'</button>';
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
					<input type="radio" name="<?php echo $this->option_name . '_icon' ?>" id="<?php echo $this->option_name . '_icon' ?>" value="thumbs-up">
					<i class="fa fa-2x fa-thumbs-up"></i>
				</label>
				<br>
				<label>
          <input type="radio" name="<?php echo $this->option_name . '_icon' ?>" id="<?php echo $this->option_name . '_icon' ?>" value="thumbs-o-up">
          <i class="fa fa-2x fa-thumbs-o-up"></i>					
				</label>
        <br>
        <label>
					<input type="radio" name="<?php echo $this->option_name . '_icon' ?>" id="<?php echo $this->option_name . '_icon' ?>" value="heart">
					<i class="fa fa-2x fa-heart"></i>
				</label>
        <br>
        <label>
					<input type="radio" name="<?php echo $this->option_name . '_icon' ?>" id="<?php echo $this->option_name . '_icon' ?>" value="heart-o">
					<i class="fa fa-2x fa-heart-o"></i>
				</label>
        <br>
        <label>
					<input type="radio" name="<?php echo $this->option_name . '_icon' ?>" id="<?php echo $this->option_name . '_icon' ?>" value="plus">
					<i class="fa fa-2x fa-plus blue"></i>
				</label>
        <br>
        <label>
					<input type="radio" name="<?php echo $this->option_name . '_icon' ?>" id="<?php echo $this->option_name . '_icon' ?>" value="plus-circle">
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
  					<td><input type="radio" name="<?php echo $this->option_name . '_color' ?>" id="<?php echo $this->option_name . '_color' ?>" value="FFFFFF"></td>
  					<td class="td_color" bgcolor="#FFFFFF"></td>
            <td></td>
            <td><input type="radio" name="<?php echo $this->option_name . '_color' ?>" id="<?php echo $this->option_name . '_color' ?>" value="FF0000"></td>
  					<td class="td_color" bgcolor="#FF0000"></td>
            <td></td>
            <td><input type="radio" name="<?php echo $this->option_name . '_color' ?>" id="<?php echo $this->option_name . '_color' ?>" value="8FFC00"></td>
  					<td class="td_color" bgcolor="#8FFC00"></td>
            <td></td>
            <td><input type="radio" name="<?php echo $this->option_name . '_color' ?>" id="<?php echo $this->option_name . '_color' ?>" value="003CFF"></td>
  					<td class="td_color" bgcolor="#003CFF"></td>
            <td></td>
            <td><input type="radio" name="<?php echo $this->option_name . '_color' ?>" id="<?php echo $this->option_name . '_color' ?>" value="FC3F00"></td>
  					<td class="td_color" bgcolor="#FC3F00"></td>
  				</tr>
  				<tr>
  					<td><input type="radio" name="<?php echo $this->option_name . '_color' ?>" id="<?php echo $this->option_name . '_color' ?>" value="00BDFC"></td>
  					<td class="td_color" bgcolor="#00BDFC"></td>
            <td></td>
            <td><input type="radio" name="<?php echo $this->option_name . '_color' ?>" id="<?php echo $this->option_name . '_color' ?>" value="FCEB00"></td>
  					<td class="td_color" bgcolor="#FCEB00"></td>
            <td></td>
            <td><input type="radio" name="<?php echo $this->option_name . '_color' ?>" id="<?php echo $this->option_name . '_color' ?>" value="FC00E7"></td>
  					<td class="td_color" bgcolor="#FC00E7"></td>
            <td></td>
            <td><input type="radio" name="<?php echo $this->option_name . '_color' ?>" id="<?php echo $this->option_name . '_color' ?>" value="1AA125"></td>
  					<td class="td_color" bgcolor="1AA125"></td>
            <td></td>
            <td><input type="radio" name="<?php echo $this->option_name . '_color' ?>" id="<?php echo $this->option_name . '_color' ?>" value="A11A96"></td>
  					<td class="td_color" bgcolor="#A11A96"></td>
  					<td><button class="jscolor
                  {valueElement:'valueInput', styleElement:'styleInput'}">
                   Choisir une couleur personnalisée
                </button><input type="hidden" id="valueInput" value="ff6699"><button class="like_this_site_colorOk">Ok</button></td>
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
		echo '<input placeholder="'. __('Votez pour ce site!', 'like-this-site') .'" type="text" name="' . $this->option_name . '_label' . '" id="' . $this->option_name . '_label' . '"><button id="like_this_site_label_ok_btn">Valider</button> ';
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
					<input type="radio" name="<?php echo $this->option_name . '_label_position' ?>" value="top">
					<?php _e( 'Au dessus de l\'icône', 'like-this-site' ); ?>
				</label>
        <br>
        <label>
					<input type="radio" name="<?php echo $this->option_name . '_label_position' ?>" value="bottom">
					<?php _e( 'Au dessous de l\'icône', 'like-this-site' ); ?>
				</label>
			</fieldset>
    </div>
		<?php
	}
  
   /**
	 * Render the class to apply to the plugin
	 *
	 * @since  1.0.0
	 */
	public function like_this_site_class_cb() {
		echo '<input placeholder="'. __('Classe css (facultatif)', 'like-this-site') .'" type="text" name="' . $this->option_name . '_class' . '" > ';
	}
  
  /**
	 * Render the label_result to display
	 *
	 * @since  1.0.0
	 */
	public function like_this_site_label_result_cb() {
		echo '<input placeholder="'. __('Nombre de votes', 'like-this-site') .'" type="text" name="' . $this->option_name . '_label_result' . '" > ';
	}
  
  
   /**
	 * Render the radio input field for plugin position option
	 *
	 * @since  1.0.0
	 */
	public function like_this_site_plugin_position_cb() {
		?>
    <div id="like_this_site_plugin-position">
			<fieldset>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_plugin_position' ?>" value="footer">
					<?php _e( 'Dans le pied de page', 'like-this-site' ); ?>
				</label>
				<br>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_plugin_position' ?>" value="sidebar">
					<?php _e( 'Dans les barres latérales', 'like-this-site' ); ?>
				</label>
        <br>
        <label>
					<input type="radio" name="<?php echo $this->option_name . '_plugin_position' ?>" value="homepage">
					<?php _e( 'Sur la page d\'accueil', 'like-this-site' ); ?>
				</label>
			</fieldset>
    </div>
		<?php
	}
  
  
  /**
	 * Sanitize the icon value before being saved to database
	 *
	 * @param  string $icon $_POST value
	 * @since  1.0.0
	 * @return string           Sanitized value
	 */
	public function like_this_site_sanitize_icon( $icon ) {
		
    if ( !in_array( $icon, array( 'thumbs-up', 'thumbs-o-up','heart','heart-o','plus','plus-circle' ), true ) ) {
	        return;
	    }
    
    if (isset($icon) && !empty($icon)){
          return $icon;
    }
	}
  
  /**
	 * Sanitize the color value before being saved to database
	 *
	 * @param  string $color $_POST value
	 * @since  1.0.0
	 * @return string           Sanitized value
	 */
	public function like_this_site_sanitize_color( $color ) {
	  if (!preg_match('/[0-9a-fA-F]+/', $color, $matches)) {
      return;
    }	
    if (isset($color) && !empty($color)){
          return $color;
    }
	}
  
  /**
	 * Sanitize the label value before being saved to database
	 *
	 * @param  string $label $_POST value
	 * @since  1.0.0
	 * @return string           Sanitized value
	 */
	public function like_this_site_sanitize_label( $label ) {
		
    if (isset($label) && !empty($label)){
          return sanitize_text_field($label);
    }
	}
  
  /**
	 * Sanitize the label_position value before being saved to database
	 *
	 * @param  string $label_position $_POST value
	 * @since  1.0.0
	 * @return string           Sanitized value
	 */
	public function like_this_site_sanitize_label_position( $label_position ) {
		if ( !in_array( $label_position, array( 'top', 'bottom' ), true ) ) {
	        return;
	    }
      
    if (isset($label_position) && !empty($label_position)){
          return $label_position;
    }
	}
  
  /**
	 * Sanitize the class value before being saved to database
	 *
	 * @param  string $class $_POST value
	 * @since  1.0.0
	 * @return string           Sanitized value
	 */
	public function like_this_site_sanitize_class( $class ) {
		
    if (isset($class) && !empty($class)){
          return sanitize_text_field($class);
    }
	}
  
  /**
	 * Sanitize the label_result value before being saved to database
	 *
	 * @param  string $label_result $_POST value
	 * @since  1.0.0
	 * @return string           Sanitized value
	 */
	public function like_this_site_sanitize_label_result( $label_result ) {
		
    if (isset($label_result) && !empty($label_result)){
          return sanitize_text_field($label_result);
    }
	}
  
  /**
	 * Sanitize the plugin_position value before being saved to database
	 *
	 * @param  string $plugin_position $_POST value
	 * @since  1.0.0
	 * @return string           Sanitized value
	 */
	public function like_this_site_sanitize_plugin_position( $plugin_position ) {
		if ( !in_array( $plugin_position, array( 'footer', 'sidebar','homepage' ), true ) ) {
	        return ;
	    }
      
    if (isset($plugin_position) && !empty($plugin_position)){
          return $plugin_position;
    }
	}
  
}
