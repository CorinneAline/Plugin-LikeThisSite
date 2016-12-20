<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.resoclick.com
 * @since      1.0.0
 *
 * @package    Like_This_Site
 * @subpackage Like_This_Site/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Like_This_Site
 * @subpackage Like_This_Site/public
 * @author     Corinne Resoclick <resoclick@free.fr>
 */
class Like_This_Site_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/like-this-site-public.css', array(), $this->version, 'all' );
    wp_enqueue_style( 'font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), '4.7.0', 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/like-this-site-public.js', array( 'jquery' ), $this->version, true );
    wp_localize_script('script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
	}
  
  public function displayLikeThisSite()
  {
     add_action( 'wp_ajax_site_like', 'site_like' );
     add_action( 'wp_ajax_nopriv_site_like', 'site_like' );
     include_once 'partials/like-this-site-public-display.php';
  }
  
  function site_like() {
    $options = get_option( 'like-this-site_options' ); 
  	$param = $_POST['param'];
    
    update_option( $options['like_this_site_plugin_votes'], $param );
      echo $param;
  
  	die();
  }
}
