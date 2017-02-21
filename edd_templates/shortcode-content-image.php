<?php if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( get_the_ID() ) ) : ?>
	<div class="edd_download_image">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php
				$product_image = apply_filters( 'thunderbear_crop_product_image', true ) ? 'thunderbear_product_image' : 'full';
				echo get_the_post_thumbnail( get_the_ID(), $product_image );
			?>
		</a>
	</div>
<?php elseif ( get_theme_mod( 'thunderbear_product_image_upload' ) && get_theme_mod( 'thunderbear_product_image' ) ) : ?>
	<div class="edd_download_image">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<img src="<?php echo get_theme_mod( 'thunderbear_product_image_upload' ); ?>" alt="<?php echo esc_attr( get_the_title( get_the_ID() ) ); ?>">
		</a>
	</div>
<?php endif; ?>
