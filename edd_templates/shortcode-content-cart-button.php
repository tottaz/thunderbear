<?php
/**
 * hide purchase button behind a toggle button
 *
 * @package Thunderbear
 */
?>

<a class="product-link thunderbear-show-button" href="#"><i class="fa fa-plus-circle thunderbear-price-button-icon"></i></a>
<div class="thunderbear-price-button-container">
	<span class="thunderbear-price-button">
		<?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
	</span>
</div>
