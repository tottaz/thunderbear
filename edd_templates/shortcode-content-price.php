<?php if ( edd_has_variable_prices( get_the_ID() ) ) : ?>
	<a class="product-price-wrap" href="<?php the_permalink(); ?>"><span class="product-price"><?php _e( 'Starting at: ', 'thunderbear'); echo edd_currency_filter( edd_get_lowest_price_option( get_the_ID() ) ); ?></span></a>
<?php elseif ( '0' != edd_get_download_price( get_the_ID() ) && ! edd_has_variable_prices( get_the_ID() ) ) : ?>
	<a class="product-price-wrap" href="<?php the_permalink(); ?>"><span class="product-price"><?php _e( 'Price: ', 'thunderbear' ); edd_price( get_the_ID() ); ?></span></a>
<?php else : ?>
	<a class="product-price-wrap" href="<?php the_permalink(); ?>"><span class="product-price"><?php _e( 'Free Download','thunderbear' ); ?></span></a>
<?php endif; ?>
