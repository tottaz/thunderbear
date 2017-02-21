<?php
/**
 * functions specific to Easy Digital Downloads
 *
 * @package Thunderbear
 */


/**
 * Allow comments on downloads
 */
function thunderbear_edd_add_comments_support( $supports ) {
	$supports[] = 'comments';
	return $supports;
}
add_filter( 'edd_download_supports', 'thunderbear_edd_add_comments_support' );


/**
 * No purchase button below download content
 */
remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );


/*
 * If Subtitles plugin is activated, add support for Downloads
 */
function thunderbear_subtitles() {
	add_post_type_support( 'download', 'subtitles' );
}
add_action( 'init', 'thunderbear_subtitles' );


/*
 * Add HTML to the [downloads] shortcode for structure/styling
 */
function thunderbear_downloads_shortcode_wrap_open() {
	echo '<div class="vendd-download-information">';
}
add_action( 'edd_download_before', 'thunderbear_downloads_shortcode_wrap_open' );

function thunderbear_downloads_shortcode_wrap_close() {
	echo '</div>';
}
add_action( 'edd_download_after', 'thunderbear_downloads_shortcode_wrap_close' );


/**
 * check for EDD shortcodes and add post classes
 */
function thunderbear_edd_shortcodes_classes( $classes ) {
	global $post;

	if ( is_a( $post, 'WP_Post' ) &&
		has_shortcode( $post->post_content, 'edd_login' ) ||
		has_shortcode( $post->post_content, 'edd_register' ) ||
		has_shortcode( $post->post_content, 'edd_profile_editor' )
	) {
		$classes[] = 'vendd-edd-fes-shortcode';
	}

	return $classes;
}
add_filter( 'post_class', 'thunderbear_edd_shortcodes_classes' );


/**
 * Add downloads display to the empty cart
 */
function thunderbear_empty_cart_content( $message ) {
	$empty_cart_title         = get_theme_mod( 'thunderbear_empty_cart_title' );
	$empty_cart_text          = wpautop( get_theme_mod( 'thunderbear_empty_cart_text' ) );
	$empty_cart_downloads_qty = intval( get_theme_mod( 'thunderbear_empty_cart_downloads_count', 6 ) );
	
	if ( thunderbear_edd_is_activated() && ! edd_is_checkout() ) {
		$message = '<span>' . _x( 'Your cart is empty.', 'cart widget output when there are no items in the cart', 'vendd' ) . '</span>';
		return $message;
	}

	ob_start();

	if ( '' != $empty_cart_title ) {
		echo '<h3 class="entry-title empty-cart-title">' . $empty_cart_title . '</h3>';
	} else {
		echo '<h3 class="entry-title empty-cart-title">' . _x( 'Your cart is empty.', 'default title output on checkout page when there are no items in the cart', 'vendd' ) . '</h3>';
	}

	if ( '' != $empty_cart_text ) {
		echo $empty_cart_text;
	}

	if ( 0 != $empty_cart_downloads_qty ) {
		echo do_shortcode( '[downloads columns="2" number="' . $empty_cart_downloads_qty . '"]' );
	}

	$message = ob_get_clean();
	return $message;
}
add_filter( 'edd_empty_cart_message', 'thunderbear_empty_cart_content' );
