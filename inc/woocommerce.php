<?php
/**
 * Woocommerce Compatibility File
 * See: https://docs.woocommerce.com/document/declare-woocommerce-support-in-third-party-theme/
 *
 * @package thunderbear
 */

/**
 * Add theme support for Woocommerce.
 */
function thunderbear_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'thunderbear_woocommerce_support' );