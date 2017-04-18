<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package thunderbear
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- Bootstrap core CSS -->
<link href="<?php echo esc_url( get_template_directory_uri() ) ?>/assets/css/bootstrap.min.css" rel="stylesheet">

<!-- FontAwesome Icons -->
<link href="<?php echo esc_url( get_template_directory_uri() ) ?>/assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">

<!-- Google Fonts -->
<link href="//fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet" type="text/css">

<?php wp_head(); ?>

<!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'thunderbear' ); ?></a>
	
	<!-- HEADER
	================================================== -->
	<header class="site-header" role="banner">
		
		<?php if ( thunderbear_edd_is_activated() && ! thunderbear_is_checkout() && ! thunderbear_is_landing_page() ) : ?>
			<?php if ( apply_filters( 'thunderbear_show_header_cart_info', true, $post ) ) : ?>
				<a href="<?php echo edd_get_checkout_uri(); ?>" class="header-cart">
					<i class="fa fa-shopping-cart"></i>
					<?php printf( __( 'Cart total: %s', 'thunderbear' ), '<span class="header-cart-total">' . edd_currency_filter( edd_format_amount( edd_get_cart_total() ) ) . '</span>' ); ?>
				</a>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php if ( ! thunderbear_is_checkout() && ! thunderbear_is_landing_page() && has_nav_menu( 'primary' ) ) : ?>

		<!-- NAVBAR
		================================================== -->
		<div class="navbar-wrapper">
			
			<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						
						<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ) ?>/assets/img/logo.gif" alt="ThunderBear Design"></a>
						
					</div><!-- navbar-header -->
					
					<?php
                		wp_nav_menu( array(
                    		'menu'              => 'primary',
                    		'theme_location'    => 'primary',
                    		'depth'             => 4,
                    		'container'         => 'div',
                    		'container_class'   => 'collapse navbar-collapse',
            				'container_id'      => 'bs-example-navbar-collapse-1',
                    		'menu_class'        => 'nav navbar-nav navbar-right',
                    		'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                   	 		'walker'            => new wp_bootstrap_navwalker())
                		) ;
            		?>
					
				</div><!-- container -->
			</div><!-- navbar -->
		</div><!-- navbar-wrapper -->
		<?php endif ?>

	</header>

	<div id="content" class="site-content">