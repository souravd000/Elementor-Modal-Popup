<?php
/**
 * Plugin Name: Modal Maker
 * Plugin URI: https://github.com/souravd000/modal-maker
 * Description: Create customizable modal popups in Elementor with ease, featuring flexible content options like button groups or rich text editors.
 * Version: 1.0
 * Author: souravd000
 * License: GPL v2 or later
 * Text Domain: modal-maker  // <-- Make sure this is 'modal-maker'
 */

// Define plugin version
define( 'MODAL_MAKER_VERSION', '1.0' );

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Enqueue necessary scripts and styles
function my_custom_widget_scripts() {
    // Use MODAL_MAKER_VERSION to ensure correct versioning
    wp_enqueue_style( 'my-modal-style', plugins_url( '/assets/css/my-modal-style.css', __FILE__ ), [], MODAL_MAKER_VERSION );
    wp_enqueue_script( 'my-modal-script', plugins_url( '/assets/js/my-modal-script.js', __FILE__ ), [ 'jquery' ], MODAL_MAKER_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'my_custom_widget_scripts' );


// Load the custom widget class.
function my_custom_widget_init() {
    // Check if Elementor is active and loaded.
    if ( did_action( 'elementor/loaded' ) ) {
        require_once __DIR__ . '/widgets/my-widget.php';
    }
}
add_action( 'elementor/widgets/register', 'my_custom_widget_init' );
