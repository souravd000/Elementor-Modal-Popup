<?php
/**
 * Plugin Name: Modal Maker
 * Plugin URI: https://github.com/souravd000/modal-maker
 * Description: Create customizable modal popups in Elementor with ease, featuring flexible content options like button groups or rich text editors.
 * Version: 1.2
 * Author: souravd000
 * License: GPL v2 or later
 * Text Domain: modal-maker 
 */

// Define plugin version
define( 'mm', '1.1' );

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Enqueue necessary scripts and styles
function mm_widget_scripts() {
    // Use MODAL_MAKER_VERSION to ensure correct versioning
    wp_enqueue_style( 'my-modal-style', plugins_url( '/assets/css/my-modal-style.css', __FILE__ ), [], mm );
    wp_enqueue_script( 'my-modal-script', plugins_url( '/assets/js/my-modal-script.js', __FILE__ ), [ 'jquery' ], mm, true );
}
add_action( 'wp_enqueue_scripts', 'mm_widget_scripts' );


// Load the custom widget class.
function mm_widget_init() {
    // Check if Elementor is active and loaded.
    if ( did_action( 'elementor/loaded' ) ) {
        require_once __DIR__ . '/widgets/my-widget.php';
    }
}
add_action( 'elementor/widgets/register', 'mm_widget_init' );
