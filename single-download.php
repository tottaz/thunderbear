<?php
/**
 * The template for displaying Easy Digital Downloads Product Pages.
 *
 * @package thunderbear
 */

get_header(); ?>

	<!-- Easy Digital Download Content
	================================================== -->
	<div class="container">
		<div class="row" id="primary">
				
			<main id="content" class="col-sm-8">

			<?php while ( have_posts() ) : the_post(); ?>
	
				<?php get_template_part( 'content', 'single-download' ); ?>
	
				<?php thunderbear_post_nav(); ?>
	
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>
	
			<?php endwhile; // end of the loop. ?>

			</main><!-- #content -->
			<?php get_sidebar( 'download' ); ?>
		</div><!-- #primary -->
	</div><!-- .container -->

<?php get_footer(); ?>





