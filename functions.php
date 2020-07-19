<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the BASE-STARTER Theme.
 *
 * @package BASE-STARTER
 * @author  Mark Corpuz
 * @license GPL-2.0+
 * @link    http://markcorpuz.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
function genesis_sample_localization_setup(){
	load_child_theme_textdomain( 'base-starter', get_stylesheet_directory() . '/languages' );
}

/*
// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );
*/

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'COR' );
define( 'CHILD_THEME_URL', 'http://layout.basestructure.com/cor' );
define( 'CHILD_THEME_VERSION', '2.4.0.28' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'basestarter_enqueue_scripts_styles' );
	function basestarter_enqueue_scripts_styles() {

		//wp_enqueue_style( 'basestarter-fonts', '//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Roboto+Condensed:300,400,700|Lato:100,300,400,700,900', array(), CHILD_THEME_VERSION );
		//wp_enqueue_style( 'dashicons' );

		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		wp_enqueue_script( 'menu-responsive', get_bloginfo( 'stylesheet_directory' ) . '/js/menu.js', array( 'jquery' ), '1.0.0', true );

	}

// Unregister Superfish Dropdown
function unregister_superfish() {
wp_deregister_script( 'superfish' );
wp_deregister_script( 'superfish-args' );
}
add_action( 'wp_enqueue_scripts', 'unregister_superfish' );

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Increase memory limit
define( 'WP_MEMORY_LIMIT', '256M' );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 405, TRUE );

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
	function genesis_sample_author_box_gravatar( $size ) {
		return 90;
	}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
	function genesis_sample_comments_gravatar( $args ) {
		$args['avatar_size'] = 60;
		return $args;
	}

//* Customize the entire footer | functions-sitefooter
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'swp_sitefooter' );
	function swp_sitefooter() {
		?>
		<div class="siteby"><a href="http://smarterwebpackages.com/">SmarterWebPackages.com</a></div>
		<div class="copyright">Copyright © <?php echo date("Y"); ?> UnderstandingRelatonships.com | All Rights Reserved | <a href="http://www.understandingrelationships.com/privacy-policy/">Privacy Policy</a><br>
		The Corey Wayne Companies | Orlando, FL USA<br>
		Site Design by <a href="http://smarterwebpackages.com/">SmarterWebPackages.com</a>
		</div>
		<?php
	}

// HOOK-CSWBEFORE (SINGLE POST)
add_action( 'genesis_before_content_sidebar_wrap', 'swp_hook_cswbefore' );
	function swp_hook_cswbefore() {
		?>
		<div class="hook-cswbefore"><div class="hook-wrap">
			<div class="item-ad-top">
				<?php echo do_shortcode( '[spk_adsbygoogle_js]' ); ?>
			</div>
			<div id="subscribeto" class="item-subscribeto"></div>
			<div id="booksto" class="item-booksto"></div>
		</div></div>
		<?php
	}

// HOOK-CSWAFTER (SINGLE POST)
add_action( 'genesis_after_content_sidebar_wrap', 'swp_hook_cswafter' );
	function swp_hook_cswafter() {
		?>
		<div class="hook-cswafter"><div class="hook-wrap">
			<div class="item-ad-bottom">
				<?php echo do_shortcode( '[spk_adsbygoogle_js]' ); ?>
			</div>
		</div></div>
		<?php
	}

// FEATURERIGHT (HOMEPAGE)
// FEATURELEFT (HOMEPAGE)
// FEATUREMAIN (HOMEPAGE)
add_action( 'genesis_after_loop', 'base226_belowloophome' );
	function base226_belowloophome() {
		if (is_front_page()) {
			genesis_widget_area( 'featureleft', array(
				'before' => '<div class="featureleft featurearea feature-60x60"><div class="areawrap">',
				'after' => '</div></div>',
			) );
			genesis_widget_area( 'featureright', array(
				'before' => '<div class="featureright featurearea feature-60x60"><div class="areawrap">',
				'after' => '</div></div>',
			) );
			genesis_widget_area( 'featuremain', array(
				'before' => '<div class="featuremain featurearea feature-150x150"><div class="areawrap">',
				'after' => '</div></div>',
			) );
		} else {
			// nothing
		}
	}

// FEATUREINPOST (SINGLE POST)
add_action( 'genesis_entry_footer', 'base226_entryfooter' );
	function base226_entryfooter() {
	    if (is_single()) {
		    genesis_widget_area( 'featureinpost', array(
				'before' => '<div class="featureinpost featurearea feature-150x150"><div class="areawrap">',
				'after' => '</div></div>',	    	
	    	) ); 
		} else {
			// nothing
		}
	}

// FEATURELEFT (HOMEPAGE)
//* Register widget area - featureleft
genesis_register_sidebar( array(
	'id'            => 'featureleft',
	'name'          => __( 'Feature Left', 'basic-226' ),
	'description'   => __( 'This is a widget area that displays the left feature area', 'basic-226' ),
) );

// FEATURERIGHT (HOMEPAGE)
//* Register widget area - featureright
genesis_register_sidebar( array(
	'id'            => 'featureright',
	'name'          => __( 'Feature Right', 'basic-226' ),
	'description'   => __( 'This is a widget area that displays the right feature area', 'basic-226' ),
) );

// FEATUREMAIN (HOMEPAGE)
//* Register widget area - featuremain
genesis_register_sidebar( array(
	'id'            => 'featuremain',
	'name'          => __( 'Feature Main', 'basic-226' ),
	'description'   => __( 'This is a widget area that displays the main feature area', 'basic-226' ),
) );

// FEATUREINPOST (SINGLE POST)
//* Register widget area - featureinpost
genesis_register_sidebar( array(
	'id'            => 'featureinpost',
	'name'          => __( 'Feature Inpost', 'basic-226' ),
	'description'   => __( 'This is a widget area that displays the feature area after post entries', 'basic-226' ),
) );