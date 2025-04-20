<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://ridwan-arifandi.com
 * @since      1.0.0
 *
 * @package    Wp_Mc_Mm
 * @subpackage Wp_Mc_Mm/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Mc_Mm
 * @subpackage Wp_Mc_Mm/admin
 * @author     Ridwan Arifandi <orangerdigiart@gmail.com>
 */
class Wp_Mc_Mm_Admin {

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
	 * Load the Carbon Fields library.
	 * Hooks into the 'after_setup_theme' action. Priority 10.
	 * This method is responsible for loading the Carbon Fields library.
	 * @since 1.0.0
	 * @return void
	 */
	public function load_crb() {
		\Carbon_Fields\Carbon_Fields::boot();
	}

	public function register_theme_options() {
		Container::make( 'theme_options', __( 'MasterCard Megamenu', 'wp-mc-mm' ) )
			->set_page_menu_position( 2 )
			->set_page_menu_title( __( 'MasterCard Megamenu', 'wp-mc-mm' ) )
			->set_page_parent( 'themes.php' )
			->add_fields( array(
				// main menu
				Field::make( 'complex', 'mc_mm_items', __( 'Menu Items', 'wp-mc-mm' ) )
					->set_layout( 'tabbed-vertical' )
					->set_header_template( '<%- title %>' )
					->add_fields( array(
						Field::make( 'text', 'title', __( 'Title', 'wp-mc-mm' ) ),
						Field::make( 'text', 'url', __( 'URL', 'wp-mc-mm' ) )
							->set_default_value( '#' ),
						Field::make( 'file', 'background_image', __( 'Background Image', 'wp-mc-mm' ) )
							->set_help_text( __( 'This image will be used as the background for the menu.', 'wp-mc-mm' ) )
							->set_type( 'image' ),

						Field::make( 'checkbox', 'enable_children', __( 'Enable Children', 'wp-mc-mm' ) )
							->set_help_text( __( 'Enable this option to add child items to this menu item.', 'wp-mc-mm' ) ),

						// first level children
						Field::make( 'complex', 'children', __( 'Children', 'wp-mc-mm' ) )
							->set_layout( 'tabbed-vertical' )
							->add_fields( array(
								Field::make( 'text', 'title', __( 'Title', 'wp-mc-mm' ) ),
								Field::make( 'text', 'url', __( 'URL', 'wp-mc-mm' ) )
									->set_default_value( '#' ),
								Field::make( 'checkbox', 'enable_children', __( 'Enable Children', 'wp-mc-mm' ) )
									->set_help_text( __( 'Enable this option to add child items to this menu item.', 'wp-mc-mm' ) ),

								// second level children
								Field::make( 'complex', 'children', __( 'Children', 'wp-mc-mm' ) )
									->set_header_template( '<%- title %>' )
									->set_layout( 'tabbed-vertical' )
									->add_fields( array(
										Field::make( 'text', 'title', __( 'Title', 'wp-mc-mm' ) ),
										Field::make( 'text', 'url', __( 'URL', 'wp-mc-mm' ) )
											->set_default_value( '#' ),
										Field::make( 'checkbox', 'enable_children', __( 'Enable Children', 'wp-mc-mm' ) )
											->set_help_text( __( 'Enable this option to add child items to this menu item.', 'wp-mc-mm' ) ),

										// third level children
										Field::make( 'complex', 'children', __( 'Children', 'wp-mc-mm' ) )
											->set_header_template( '<%- title %>' )
											->set_layout( 'tabbed-vertical' )
											->add_fields( array(
												Field::make( 'text', 'title', __( 'Title', 'wp-mc-mm' ) ),
												Field::make( 'text', 'url', __( 'URL', 'wp-mc-mm' ) )
													->set_default_value( '#' ),
												Field::make( 'checkbox', 'enable_children', __( 'Enable Children', 'wp-mc-mm' ) )
													->set_help_text( __( 'Enable this option to add child items to this menu item.', 'wp-mc-mm' ) ),

												// fourth level children
												Field::make( 'complex', 'children', __( 'Children', 'wp-mc-mm' ) )
													->set_header_template( '<%- title %>' )
													->set_layout( 'tabbed-vertical' )
													->add_fields( array(
														Field::make( 'text', 'title', __( 'Title', 'wp-mc-mm' ) ),
														Field::make( 'text', 'url', __( 'URL', 'wp-mc-mm' ) )
															->set_default_value( '#' ),
													) )
													->set_header_template( '<%- title %>' )
											) )
											->set_header_template( '<%- title %>' )
									) )
									->set_header_template( '<%- title %>' )
							) )
							->set_header_template( '<%- title %>' )
					) )
					->set_header_template( '<%- title %>' )

			) );
	}

}
