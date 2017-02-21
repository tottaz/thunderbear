<?php
$aboutus_section_title		= get_field('aboutus_section_title');
$aboutus_name				= get_field('aboutus_name');
$aboutus_excerpt			= get_field('aboutus_excerpt');
$full_aboutus				= get_field('full_aboutus');
$twitter_username			= get_field('twitter_username');
$facebook_username			= get_field('facebook_username');
$google_plus_username		= get_field('google_plus_username');
$num_plugins				= get_field('num_plugins');
$num_themes					= get_field('num_themes');
$num_mobileapps				= get_field('num_mobileapps');
?>

<!-- About US
================================================== -->
<section id="aboutus">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-md-6">
				<div class="row">
					<div class="col-lg-8">
						<h2><?php echo $aboutus_section_title; ?> <small><?php echo $aboutus_name; ?></small></h2>
					</div><!-- end col -->
					
					<div class="col-lg-4">
						
						<?php if( !empty($twitter_username) ): ?>
						<a href="https://twitter.com/<?php echo $twitter_username; ?>" target="_blank" class="badge social twitter"><i class="fa fa-twitter"></i></a>
						<?php endif; ?>
						
						<?php if( !empty($facebook_username) ): ?>
						<a href="https://facebook.com/<?php echo $facebook_username; ?>" target="_blank" class="badge social facebook"><i class="fa fa-facebook"></i></a>
						<?php endif; ?>
						
						<?php if( !empty($google_plus_username) ): ?>
						<a href="https://plus.google.com/<?php echo $google_plus_username; ?>" target="_blank" class="badge social gplus"><i class="fa fa-google-plus"></i></a>
						<?php endif; ?>
						
					</div><!-- end col -->
					
				</div><!-- row -->
				
				<p class="lead"><?php echo $aboutus_excerpt; ?></p>
				
				<?php echo $full_aboutus; ?>
				
				<hr>
				
				<h3>The Numbers <small>They Don't Lie</small></h3>
				
				<div class="row">
					<div class="col-xs-4">
						<div class="num">
							<div class="num-content">
								<?php echo $num_plugins; ?> <span>plugins</span>
							</div><!-- num-content -->
						</div><!-- num -->
					</div><!-- end col -->
					
					<div class="col-xs-4">
						<div class="num">
							<div class="num-content">
								<?php echo $num_themes; ?> <span>themes</span>
							</div><!-- num-content -->
						</div><!-- num -->
					</div><!-- end col -->
					
					<div class="col-xs-4">
						<div class="num">
							<div class="num-content">
								<?php echo $num_mobileapps; ?> <span>mobile apps</span>
							</div><!-- num-content -->
						</div><!-- num -->
					</div><!-- end col -->
				</div><!-- row -->
				
			</div><!-- end col -->
		</div><!-- row -->
	</div><!-- container -->
</section><!-- aboutus -->