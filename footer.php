<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package thunderbear
 */
?>

	</div><!-- #content -->

<?php wp_footer(); ?>

<!-- SIGN UP SECTION
================================================== -->

<?php if( !empty(get_field('wp_support_text')) ): ?>
<section id="signup" data-type="background" data-speed="4">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<h2><?php echo get_field('wp_support_text'); ?></h2>
				<p><a href="<?php echo get_field('wp_support_button_text'); ?>" class="btn btn-lg btn-block btn-success"><?php echo get_field('wp_support_url'); ?></a></p>
			</div><!-- end col -->
		</div><!-- row -->
	</div><!-- container -->
</section><!-- signup -->
<?php endif; ?>

<!-- FOOTER
================================================== -->
<footer>
	<div class="container">
		<div class="col-sm-3">

		</div><!-- end col -->
		<div class="col-sm-6">
			<?php
				wp_nav_menu( array(					
					'theme_location'	=> 'footer',
					'container'			=> 'nav',
					'menu_class'		=> 'list-unstyled list-inline'
				) );
			?>
		</div><!-- end col -->
		<div class="col-sm-3">
			<p class="pull-right"><?php bloginfo('name'); ?> &copy; <?php echo date('Y'); ?> </p>
		</div><!-- end col -->
	</div><!-- container -->
</footer>


<!-- MODAL
================================================== -->
<div class="modal fade" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope"></i> Subscribe to our Mailing List</h4>
			</div><!-- modal-header -->
			
			<div class="modal-body">
				<p>Simply enter your name and email! We're going to give you one of our best-selling wordpress plugins, <em>for free!</em></p>
				
				<form class="form-inline" role="form">
					<div class="form-group">
						<label class="sr-only" for="subscribe-name">Your first name</label>
						<input type="text" class="form-control" id="subscribe-name" placeholder="Your first name">
					</div><!-- form-group -->
					<div class="form-group">
						<label class="sr-only" for="subscribe-email">and your email</label>
						<input type="text" class="form-control" id="subscribe-email" placeholder="and your email">
					</div><!-- form-group -->
					
					<input type="submit" class="btn btn-danger" value="Subscribe!">
				</form>
				
				<hr>
				
				<p><small>By providing your email you consent to receiving occasional promotional emails &amp; newsletters. <br>No Spam. Just good stuff. We respect your privacy &amp; you may unsubscribe at any time.</small></p>
			</div><!-- modal-body -->
			
		</div><!-- modal-content -->
	</div><!-- modal-dialog -->
</div><!-- modal -->

<!-- BOOTSTRAP CORE JAVASCRIPT
	 Placed at the end of the document so the pages
	 load faster!
================================================== -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ) ?>/assets/js/jquery-2.1.1.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ) ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ) ?>/assets/js/main.js"></script>

</body>
</html>