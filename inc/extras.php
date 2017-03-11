<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package thunderbear
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function thunderbear_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'thunderbear_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function thunderbear_body_classes( $classes ) {
	global $post;

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds classes based on template
	if ( is_front_page() && ! is_home() ) {
		$classes[] = 'front-page';
	}

	if ( is_search() && 1 == get_theme_mod( 'thunderbear_advanced_search_results', 0 ) ) {
		// Adds class based on empty EDD cart
		$classes[] = 'thunderbear-advanced-search-results';
	}

	if ( thunderbear_edd_is_activated() ) {
		// Adds classes based on EDD page template
		if ( is_page_template( 'edd_templates/edd-downloads-shortcode.php' ) ) {
			$classes[] = 'thunderbear-downloads-template thunderbear-edd-template';
		} elseif ( is_page_template( 'edd_templates/edd-checkout.php' ) ) {
			$classes[] = 'thunderbear-checkout-template thunderbear-edd-template';
		} elseif ( is_page_template( 'edd_templates/edd-confirmation.php' ) ) {
			$classes[] = 'thunderbear-confirmation-template thunderbear-edd-template';
		} elseif ( is_page_template( 'edd_templates/edd-history.php' ) ) {
			$classes[] = 'thunderbear-history-template thunderbear-edd-template';
		} elseif ( is_page_template( 'edd_templates/edd-members.php' ) ) {
			$classes[] = 'thunderbear-members-template thunderbear-edd-template';
		} elseif ( is_page_template( 'edd_templates/edd-failed.php' ) ) {
			$classes[] = 'thunderbear-failed-template thunderbear-edd-template';
		}
	}

	if ( is_page_template( 'page_templates/landing.php' ) ) {
		$classes[] = 'thunderbear-landing-page-template';
	} elseif ( is_page_template( 'page_templates/full-width.php' ) ) {
		$classes[] = 'thunderbear-full-width-page-template';
	} elseif ( is_page_template( 'page_templates/focus.php' ) ) {
		$classes[] = 'thunderbear-focus-page-template';
	}

	if ( thunderbear_edd_is_activated() && false === edd_get_cart_contents() ) {
		// Adds class based on empty EDD cart
		$classes[] = 'thunderbear-empty-cart';
	}

	if ( thunderbear_fes_is_activated() ) {
		// Adds classes based on FES page template
		if ( is_page_template( 'fes_templates/fes-dashboard.php' ) ) {
			$classes[] = 'thunderbear-fes-dashboard-template thunderbear-edd-template thunderbear-fes-template';
		} elseif ( is_page_template( 'fes_templates/fes-vendor.php' ) ) {
			$classes[] = 'thunderbear-fes-vendor-template thunderbear-edd-template';
		}
	}

	// Adds class based on whether or not is has a sidebar
	if (	is_page_template( 'edd_templates/edd-checkout.php' ) ||
			is_page_template( 'edd_templates/edd-confirmation.php' ) ||
			is_page_template( 'edd_templates/edd-history.php' ) ||
			is_page_template( 'edd_templates/edd-members.php' ) ||
			is_page_template( 'edd_templates/edd-failed.php' ) ||
			is_page_template( 'fes_templates/fes-vendor.php' ) ||
			is_post_type_archive( 'download' ) ||
			is_404() ) {
		$classes[] = 'thunderbear-no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'thunderbear_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function thunderbear_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'thunderbear' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'thunderbear_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function thunderbear_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'thunderbear_setup_author' );

/**
 * Add support for excerpts on pages.
 */
function thunderbear_download_excerpts() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'thunderbear_download_excerpts' );


/**
 * Set excerpt length
 */
function custom_excerpt_length( $length ) {
	return 35;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/**
 * Replace excerpt ellipses with new ellipses and link to full article
 */
function thunderbear_excerpt_more( $more ) {
	return '...</p><p class="continue-reading"><a class="more-link" href="' . get_permalink( get_the_ID() ) . '">' . get_theme_mod( 'thunderbear_read_more', __( 'Continue reading', 'thunderbear' ) ) . ' &rarr;</a></p>';
}
add_filter( 'excerpt_more', 'thunderbear_excerpt_more' );


/**
 * stupid skip link thing with the more tag -- remove it -- NOW
 */
function thunderbear_remove_more_tag_link_jump( $link ) {
	$offset = strpos( $link, '#more-' );
	if ( $offset ) {
		$end = strpos( $link, '"', $offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}
add_filter( 'the_content_more_link', 'thunderbear_remove_more_tag_link_jump' );


/**
 * Removes Page Templates from Add/Edit Page screen based on plugin activation
 *
 * @return array
 */
function thunderbear_page_template_conditions( $page_templates ) {
	if ( ! thunderbear_fes_is_activated() ) {
		unset( $page_templates['fes_templates/fes-dashboard.php'] );
		unset( $page_templates['fes_templates/fes-vendor.php'] );
	}
	if ( ! thunderbear_edd_is_activated() ) {
		unset( $page_templates['edd_templates/edd-checkout.php'] );
		unset( $page_templates['edd_templates/edd-confirmation.php'] );
		unset( $page_templates['edd_templates/edd-failed.php'] );
		unset( $page_templates['edd_templates/edd-history.php'] );
		unset( $page_templates['edd_templates/edd-members.php'] );
		unset( $page_templates['edd_templates/edd-downloads-shortcode.php'] );
	}
	return $page_templates;
}
add_filter( 'theme_page_templates', 'thunderbear_page_template_conditions' );

/**
 * Add Social Network URL Fields to User Profile
 */
function thunderbear_add_social_profiles( $contactmethods ) {

	$contactmethods['twitter_profile']	= __( 'Twitter Profile URL', 'thunderbear' );
	$contactmethods['facebook_profile']	= __( 'Facebook Profile URL', 'thunderbear' );
	$contactmethods['gplus_profile']	= __( 'Google Plus Profile URL', 'thunderbear' );
	$contactmethods['youtube_profile']	= __( 'YouTube Profile URL', 'thunderbear' );

	return $contactmethods;
}
add_filter( 'user_contactmethods', 'thunderbear_add_social_profiles', 10, 1 );


/**
 * Filters posts_orderby to display advanced search results
 */
function thunderbear_advanced_search_results( $orderby, $query ) {
	global $wpdb;

	if ( $query->is_search && ( class_exists( 'bbPress' ) && ! is_bbpress() ) ) {
		return $wpdb->posts . '.post_type ASC';
	}
	return $orderby;
}
add_filter( 'posts_orderby', 'thunderbear_advanced_search_results', 10, 2 );


/**
 * Number of search results to show
 */
function thunderbear_search_filter( $query ) {
	if ( $query->is_search && ! is_admin() && ( class_exists( 'bbPress' ) && ! is_bbpress() ) ) {
		$query->set( 'posts_per_page', 99999 );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'thunderbear_search_filter' );


/**
 * social profiles
 *
 * @since 1.1.5
 */
function thunderbear_social_profiles() {
	if ( get_theme_mod( 'thunderbear_twitter' ) ||
		 get_theme_mod( 'thunderbear_facebook' ) ||
		 get_theme_mod( 'thunderbear_googleplus' ) ||
		 get_theme_mod( 'thunderbear_github' ) ||
		 get_theme_mod( 'thunderbear_instagram' ) ||
		 get_theme_mod( 'thunderbear_tumblr' ) ||
		 get_theme_mod( 'thunderbear_linkedin' ) ||
		 get_theme_mod( 'thunderbear_youtube' ) ||
		 get_theme_mod( 'thunderbear_pinterest' ) ||
		 get_theme_mod( 'thunderbear_dribbble' ) ||
		 get_theme_mod( 'thunderbear_wordpress' ) ) :
	?>
		<span class="social-links">
			<?php
				$social_profiles = array(
					'twitter'    => array(
						'class'  => 'thunderbear-twitter',
						'icon'   => '<i class="fa fa-twitter-square"></i>',
						'option' => esc_url( get_theme_mod( 'thunderbear_twitter' ) )
					),
					'facebook'   => array(
						'class'  => 'thunderbear-facebook',
						'icon'   => '<i class="fa fa-facebook-square"></i>',
						'option' => esc_url( get_theme_mod( 'thunderbear_facebook' ) )
					),
					'googleplus' => array(
						'class'  => 'thunderbear-googleplus',
						'icon'   => '<i class="fa fa-google-plus-square"></i>',
						'option' => esc_url( get_theme_mod( 'thunderbear_googleplus' ) )
					),
					'github'     => array(
						'class'  => 'thunderbear-github',
						'icon'   => '<i class="fa fa-github-square"></i>',
						'option' => esc_url( get_theme_mod( 'thunderbear_github' ) )
					),
					'instagram'  => array(
						'class'  => 'thunderbear-instagram',
						'icon'   => '<i class="fa fa-instagram"></i>',
						'option' => esc_url( get_theme_mod( 'thunderbear_instagram' ) )
					),
					'tumblr'     => array(
						'class'  => 'thunderbear-tumblr',
						'icon'   => '<i class="fa fa-tumblr-square"></i>',
						'option' => esc_url( get_theme_mod( 'thunderbear_tumblr' ) )
					),
					'linkedin'   => array(
						'class'  => 'thunderbear-linkedin',
						'icon'   => '<i class="fa fa-linkedin-square"></i>',
						'option' => esc_url( get_theme_mod( 'thunderbear_linkedin' ) )
					),
					'youtube'    => array(
						'class'  => 'thunderbear-youtube',
						'icon'   => '<i class="fa fa-youtube"></i>',
						'option' => esc_url( get_theme_mod( 'thunderbear_youtube' ) )
					),
					'pinterest'  => array(
						'class'  => 'thunderbear-pinterest',
						'icon'   => '<i class="fa fa-pinterest-square"></i>',
						'option' => esc_url( get_theme_mod( 'thunderbear_pinterest' ) )
					),
					'dribbble'   => array(
						'class'  => 'thunderbear-dribbble',
						'icon'   => '<i class="fa fa-dribbble"></i>',
						'option' => esc_url( get_theme_mod( 'thunderbear_dribbble' ) )
					),
					'wordpress'  => array(
						'class'  => 'thunderbear-wordpress',
						'icon'   => '<i class="fa fa-wordpress"></i>',
						'option' => esc_url( get_theme_mod( 'thunderbear_wordpress' ) )
					),
				);
				foreach ( $social_profiles as $profile ) {
					if ( '' != $profile[ 'option' ] ) :
						echo '<a class="', $profile[ 'class' ], '" href="', $profile[ 'option' ], '">', $profile[ 'icon' ], '</a>';
					endif;
				}
			?>
		</span>
	<?php
	endif; // end check for any social profile
}
add_action( 'thunderbear_social_profiles', 'thunderbear_social_profiles' );

/**
 * Render document title for backwards compatibility
 *
 * @resource https://make.wordpress.org/core/2015/10/20/document-title-in-4-4/
 * @since 1.1.4
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function thunderbear_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'thunderbear_render_title' );
}