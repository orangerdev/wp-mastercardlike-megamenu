<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://ridwan-arifandi.com
 * @since      1.0.0
 *
 * @package    Wp_Mc_Mm
 * @subpackage Wp_Mc_Mm/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Mc_Mm
 * @subpackage Wp_Mc_Mm/public
 * @author     Ridwan Arifandi <orangerdigiart@gmail.com>
 */
class Wp_Mc_Mm_Public {

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


		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-mc-mm-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-mc-mm-public.js', array( 'jquery' ), $this->version, true );

	}

	/**
	 * Register the shortcode for the plugin.
	 * Hooks into the 'init' action. Priority 10.
	 */

	public function register_shortcode() {
		add_shortcode( 'wp_mc_mm', array( $this, 'render_shortcode' ) );
	}

	/**
	 * Render the shortcode.
	 *
	 * @param array $atts Shortcode attributes.
	 * @return string Rendered shortcode output.
	 */
	public function render_shortcode( $atts ) {
		// Extract shortcode attributes
		$atts = shortcode_atts( array(
			'title' => '',
			'content' => '',
		), $atts, 'wp_mc_mm' );

		// Output the shortcode content
		ob_start();
		require_once plugin_dir_path( __FILE__ ) . 'partials/wp-mc-mm-public-display.php';
		return ob_get_clean();
	}

}
