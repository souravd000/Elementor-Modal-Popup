<?php
/**
 * Plugin Name: Modal Popup
 * Description: A simple custom Elementor widget for adding a modal popup.
 * Version: 1.0
 * Author: souravd000
 * License: GPL v2 or later
 * Text Domain: modal-popup-widget
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Enqueue necessary scripts and styles
function my_custom_widget_scripts() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_style( 'my-modal-style', plugins_url( '/assets/css/my-modal-style.css', __FILE__ ) );
    wp_enqueue_script( 'my-modal-script', plugins_url( '/assets/js/my-modal-script.js', __FILE__ ), [ 'jquery' ], false, true );
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
