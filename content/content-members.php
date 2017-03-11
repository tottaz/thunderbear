<?php
/**
 * The template used for displaying the EDD checkout
 *
 * @package Thunderbear
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'thunderbear-edd-fes-shortcode' ); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php echo do_shortcode( '[purchase_history]' ); ?>
		<?php echo do_shortcode( '[edd_profile_editor]' ); ?>
	</div>
</article>
