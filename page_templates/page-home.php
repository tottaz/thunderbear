<?php
/*
	Template Name: Home Page	
*/

get_header(); ?>

	<?php get_template_part('home/content','hero'); ?>
	
	<?php get_template_part('home/content','optin'); ?>
	
	<?php get_template_part('home/content','boost'); ?>
	
	<?php get_template_part('home/content','whoshould'); ?>
	
	<?php get_template_part('home/content','servicefeatures'); ?>
	
	<?php get_template_part('home/content','projectfeatures'); ?>
	
	<?php get_template_part('home/content','videointro'); ?>
	
	<?php get_template_part('home/content','aboutus'); ?>
	
	<?php get_template_part('home/content','testimonials'); ?>

<?php get_footer(); ?>