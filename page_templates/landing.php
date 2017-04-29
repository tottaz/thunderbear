<?php
/**
 * Template name: Landing Page
 * Template Post Type: post, page, product, productdocumentation
 *
 * A single column landing page template page template
 *
 * @package Thunderbear
 */

get_header(); ?>

	<div id="landing-page">

		<div id="landing-page-primary" class="landing-page-content-area">
			<main id="landing-page-main" class="landing-page-site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<section <?php post_class( 'landing-page-section' ); ?>>
						<header class="entry-header">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<?php
								// display featured image?
								if ( has_post_thumbnail() && 1 == get_theme_mod( 'thunderbear_page_featured_image', 0 ) ) :
									the_post_thumbnail( 'thunderbear_featured_image', array( 'class' => 'featured-img' ) );
								endif;

								the_content();

								wp_link_pages( array(
									'before' => '<div class="page-links">' . __( 'Pages:', 'thunderbear' ),
									'after'  => '</div>',
								) );
							?>
						</div><!-- .entry-content -->
					</section><!-- #post-## -->

				<?php endwhile; // end of the loop. ?>

			</main><!-- #landing-page-main -->
		</div><!-- #landing-page-primary -->

	</div>

<?php get_footer(); ?>
