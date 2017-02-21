<?php
// Custom Fields

$wordpress_install	=	get_field('wordpress_install');
$mobile_apps 		=	get_field('mobile_apps');
$sites_serviced		=	get_field('sites_serviced');
$contact_url		=	get_field('contact_url');
$button_text		=	get_field('button_text');
?>

<!-- HERO
================================================== -->
<section id="hero" data-type="background" data-speed="5">
	<article>
		<div class="container clearfix">
			<div class="row">
				
				<div class="col-sm-5">
					<div id="tagline-home">
						<div class="whatwedo active">
							<h2>Start off ...</h2><small> ... on the right foot</small>
						</div>
						</div>
				</div><!-- col -->
				
				<div class="col-sm-7 hero-text">
					<h1><?php bloginfo('name'); ?></h1>
					<p class="lead"><?php bloginfo('description'); ?></p>				
					
					<div id="price-timeline">
						<div class="whatwedo active">
							<h4>WordPress Sites<small>Installed!</small></h4>
							<span><?php echo $wordpress_install; ?></span>
						</div><!-- whatwedo -->
						
						<div class="whatwedo">
							<h4>Mobile Apps <small>developed!</small></h4>
							<span><?php echo $mobile_apps; ?></span>
						</div><!-- whatwedo -->
						
						<div class="whatwedo">
							<h4>Site Care <small>by us</small></h4>
							<span><?php echo $sites_serviced; ?></span>
						</div><!-- whatwedo -->
					</div><!-- price-timeline -->
					
					<p><a class="btn btn-lg btn-danger" href="<?php echo $contact_url; ?>" role="button"><?php echo $button_text; ?></a></p>
					
				</div><!-- col -->
				
			</div><!-- row -->
		</div><!-- container -->
	</article>
</section><!-- hero -->