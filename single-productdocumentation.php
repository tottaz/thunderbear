<?php
/**
 * The template for displaying all single posts.
 *
 * @package thunderbear
 */

get_header(); ?>

	<!-- BLOG CONTENT
	================================================== -->
	<div class="container">
		<div class="row" id="primary">
				
			<main id="content" class="col-sm-12">

			<?php while ( have_posts() ) : the_post(); ?>
	
				<?php get_template_part( 'content/content', 'single' ); ?>
	
				<?php thunderbear_post_nav(); ?>
	
			<?php endwhile; // end of the loop. ?>

			</main><!-- #content -->
			
			
		</div><!-- #primary -->
	</div><!-- .container -->

<?php get_footer(); ?>
