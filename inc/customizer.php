<?php
/**
 * thunderbear Theme Customizer
 *
 * @package thunderbear
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function thunderbear_customize_register( $wp_customize ) {
	global $edd_options;

	/** ===============
	 * Extends controls class to add textarea with description
	 */
	class thunderbear_WP_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
		public $description = '';
		public function render_content() { ?>

		<label>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ) . ' '; ?>
				<span class="thunderbear-toggle-wrap">
					<?php if ( ! empty( $this->description ) ) { ?>
						<a href="#" class="thunderbear-toggle-description">?</a>
					<?php } ?>
				</span>
			</span>
			<div class="control-description thunderbear-control-description"><?php echo esc_html( $this->description ); ?></div>
			<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>

		<?php }
	}

	/** ===============
	 * Extends controls class to add descriptions to text input controls
	 */
	class thunderbear_WP_Customize_Text_Control extends WP_Customize_Control {
		public $type = 'customtext';
		public $description = '';
		public function render_content() { ?>

		<label>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ) . ' '; ?>
				<span class="thunderbear-toggle-wrap">
					<?php if ( ! empty( $this->description ) ) { ?>
						<a href="#" class="thunderbear-toggle-description">?</a>
					<?php } ?>
				</span>
			</span>
			<div class="control-description thunderbear-control-description"><?php echo esc_html( $this->description ); ?></div>
			<input type="text" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
		</label>

		<?php }
	}

	/** ===============
	 * Site Title (Logo) & Tagline
	 */
	// section adjustments
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Site Title (Logo) & Tagline', 'thunderbear' );
	$wp_customize->get_section( 'title_tagline' )->priority = 10;

	// site title
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_control( 'blogname' )->priority = 10;

	// logo uploader
	$wp_customize->add_setting( 'thunderbear_logo', array( 'default' => null ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'thunderbear_logo', array(
		'label'     => __( 'Custom Site Logo (replaces title)', 'thunderbear' ),
		'section'   => 'title_tagline',
		'settings'  => 'thunderbear_logo',
		'priority'  => 20
	) ) );

	// site tagline
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_control( 'blogdescription' )->priority = 30;

	// hide the tagline?
	$wp_customize->add_setting( 'thunderbear_hide_tagline', array(
		'default'			=> 0,
		'sanitize_callback'	=> 'thunderbear_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'thunderbear_hide_tagline', array(
		'label'     => __( 'Hide Tagline', 'thunderbear' ),
		'section'   => 'title_tagline',
		'priority'  => 40,
		'type'      => 'checkbox',
	) );

	/** ===============
	 * Content Options
	 */
	$wp_customize->add_section( 'thunderbear_content_section', array(
		'title'         => __( 'Content Options', 'thunderbear' ),
		'description'   => __( 'Adjust the display of content on your website. All options have a default value that can be left as-is but you are free to customize.', 'thunderbear' ),
		'priority'      => 30,
	) );

	// post content
	$wp_customize->add_setting( 'thunderbear_post_content', array(
		'default'           => 1,
		'sanitize_callback' => 'thunderbear_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'thunderbear_post_content', array(
		'label'     => __( 'Display Post Excerpts', 'thunderbear' ),
		'section'   => 'thunderbear_content_section',
		'priority'  => 10,
		'type'      => 'checkbox',
	) );

	// read more link
	$wp_customize->add_setting( 'thunderbear_read_more', array(
		'default'           => __( 'Continue reading', 'thunderbear' ),
		'sanitize_callback' => 'thunderbear_sanitize_text'
	) );
	$wp_customize->add_control( new thunderbear_WP_Customize_Text_Control( $wp_customize, 'thunderbear_read_more', array(
	    'label'     => __( 'Excerpt & More Link Text', 'thunderbear' ),
	    'section'   => 'thunderbear_content_section',
		'description'   => __( 'This is the link text displayed at the end of blog post excerpts and content truncated with the "more tag." No HTML allowed.', 'thunderbear' ),
		'priority'  => 20,
	) ) );

	// show featured images on feed?
	$wp_customize->add_setting( 'thunderbear_feed_featured_image', array(
		'default'           => 1,
		'sanitize_callback' => 'thunderbear_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'thunderbear_feed_featured_image', array(
		'label'     => __( 'Show Featured Images in Post Listings', 'thunderbear' ),
		'section'   => 'thunderbear_content_section',
		'priority'  => 30,
		'type'      => 'checkbox',
	) );

	// show featured images on posts?
	$wp_customize->add_setting( 'thunderbear_single_featured_image', array(
		'default'           => 1,
		'sanitize_callback' => 'thunderbear_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'thunderbear_single_featured_image', array(
		'label'     => __( 'Show Featured Images on Single Posts', 'thunderbear' ),
		'section'   => 'thunderbear_content_section',
		'priority'  => 40,
		'type'      => 'checkbox',
	) );

	// show featured images on pages?
	$wp_customize->add_setting( 'thunderbear_page_featured_image', array(
		'default'           => 0,
		'sanitize_callback' => 'thunderbear_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'thunderbear_page_featured_image', array(
		'label'     => __( 'Show Featured Images on Pages', 'thunderbear' ),
		'section'   => 'thunderbear_content_section',
		'priority'  => 45,
		'type'      => 'checkbox',
	) );

	// comments on pages?
	$wp_customize->add_setting( 'thunderbear_page_comments', array(
		'default'           => 0,
		'sanitize_callback' => 'thunderbear_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'thunderbear_page_comments', array(
		'label'     => __( 'Enable Comments on Standard Pages', 'thunderbear' ),
		'section'   => 'thunderbear_content_section',
		'priority'  => 50,
		'type'      => 'checkbox',
	) );

	// show search form in main menu?
	$wp_customize->add_setting( 'thunderbear_menu_search', array(
		'default'			=> 0,
		'sanitize_callback'	=> 'thunderbear_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'thunderbear_menu_search', array(
		'label'     => __( 'Show search in Main Menu', 'thunderbear' ),
		'section'   => 'thunderbear_content_section',
		'priority'  => 60,
		'type'      => 'checkbox',
	) );

	// advanced search results
	$wp_customize->add_setting( 'thunderbear_advanced_search_results', array(
		'default'           => 0,
		'sanitize_callback' => 'thunderbear_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'thunderbear_advanced_search_results', array(
		'label'     => __( 'Use Advanced Search Results', 'thunderbear' ),
		'section'   => 'thunderbear_content_section',
		'priority'  => 70,
		'type'      => 'checkbox',
	) );

	// Information Bar text
	$wp_customize->add_setting( 'thunderbear_info_bar', array(
		'default'           => null,
		'sanitize_callback' => 'thunderbear_sanitize_textarea_lite',
	) );
	$wp_customize->add_control( new thunderbear_WP_Customize_Textarea_Control( $wp_customize, 'thunderbear_info_bar', array(
		'label'         => __( 'Information Bar Text', 'thunderbear' ),
		'section'       => 'thunderbear_content_section',
		'description'   => __( 'This text appears at the very top of your site aligned to the left. Allowed tags:', 'thunderbear' ) . ' <a>, <span>, <em>, <strong>',
		'priority'      => 80,
	) ) );

	// credits & copyright
	$wp_customize->add_setting( 'thunderbear_credits_copyright', array(
		'default'           => null,
		'sanitize_callback' => 'thunderbear_sanitize_textarea',
	) );
	$wp_customize->add_control( new thunderbear_WP_Customize_Textarea_Control( $wp_customize, 'thunderbear_credits_copyright', array(
		'label'         => __( 'Footer Credits & Copyright', 'thunderbear' ),
		'section'       => 'thunderbear_content_section',
		'description'   => __( 'Displays site title, tagline, copyright, and year by default. Allowed tags: ', 'thunderbear' ) . ' <img>, <a>, <div>, <span>, <blockquote>, <p>, <em>, <strong>, <form>, <input>, <br>, <s>, <i>, <b>',
		'priority'      => 90,
	) ) );


	/** ===============
	 * Social Profiles
	 */
	$wp_customize->add_section( 'thunderbear_social_profiles_section', array(
		'title'         => __( 'Social Profiles', 'thunderbear' ),
		'description'   => __( 'Enter the <strong>full URLs</strong> for your social profiles. They will display in various areas around the theme.', 'thunderbear' ),
		'priority'      => 40,
	) );

	// show social profiles in Information Bar?
	$wp_customize->add_setting( 'thunderbear_info_bar_social_profiles', array(
		'default'           => 0,
		'sanitize_callback'	=> 'thunderbear_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'thunderbear_info_bar_social_profiles', array(
		'label'     => __( 'Show social profiles in Information Bar?', 'thunderbear' ),
		'section'   => 'thunderbear_social_profiles_section',
		'priority'  => 10,
		'type'      => 'checkbox',
	) );

	/**
	 * all supported social profiles
	 *
	 * Any time a new profile is added to the array, do the following:
	 *
	 * 1. create a new add_control() below for the new profile
	 * 2. update thunderbear_social_profiles() function in inc/extras.php
	 */
	$profiles = array(
		'twitter',
		'facebook',
		'googleplus',
		'github',
		'instagram',
		'tumblr',
		'linkedin',
		'youtube',
		'pinterest',
		'dribbble',
		'wordpress',
	);
	foreach ( $profiles as $profile ) {
		$wp_customize->add_setting( 'thunderbear_' . $profile, array(
			'default'           => null,
			'sanitize_callback' => 'thunderbear_sanitize_text'
		) );
	}

	// full add_control() list to respect brand names (capitalization, symbols, etc.)
	$wp_customize->add_control( new thunderbear_WP_Customize_Text_Control( $wp_customize, 'thunderbear_twitter', array(
		'label'     => 'Twitter',
		'section'   => 'thunderbear_social_profiles_section'
	) ) );
	$wp_customize->add_control( new thunderbear_WP_Customize_Text_Control( $wp_customize, 'thunderbear_facebook', array(
		'label'     => 'Facebook',
		'section'   => 'thunderbear_social_profiles_section'
	) ) );
	$wp_customize->add_control( new thunderbear_WP_Customize_Text_Control( $wp_customize, 'thunderbear_googleplus', array(
		'label'     => 'Google+',
		'section'   => 'thunderbear_social_profiles_section'
	) ) );
	$wp_customize->add_control( new thunderbear_WP_Customize_Text_Control( $wp_customize, 'thunderbear_github', array(
		'label'     => 'GitHub',
		'section'   => 'thunderbear_social_profiles_section'
	) ) );
	$wp_customize->add_control( new thunderbear_WP_Customize_Text_Control( $wp_customize, 'thunderbear_instagram', array(
		'label'     => 'Instagram',
		'section'   => 'thunderbear_social_profiles_section'
	) ) );
	$wp_customize->add_control( new thunderbear_WP_Customize_Text_Control( $wp_customize, 'thunderbear_tumblr', array(
		'label'     => 'Tumblr',
		'section'   => 'thunderbear_social_profiles_section'
	) ) );
	$wp_customize->add_control( new thunderbear_WP_Customize_Text_Control( $wp_customize, 'thunderbear_linkedin', array(
		'label'     => 'LinkedIn',
		'section'   => 'thunderbear_social_profiles_section'
	) ) );
	$wp_customize->add_control( new thunderbear_WP_Customize_Text_Control( $wp_customize, 'thunderbear_youtube', array(
		'label'     => 'YouTube',
		'section'   => 'thunderbear_social_profiles_section'
	) ) );
	$wp_customize->add_control( new thunderbear_WP_Customize_Text_Control( $wp_customize, 'thunderbear_pinterest', array(
		'label'     => 'Pinterest',
		'section'   => 'thunderbear_social_profiles_section'
	) ) );
	$wp_customize->add_control( new thunderbear_WP_Customize_Text_Control( $wp_customize, 'thunderbear_dribbble', array(
		'label'     => 'Dribbble',
		'section'   => 'thunderbear_social_profiles_section'
	) ) );
	$wp_customize->add_control( new thunderbear_WP_Customize_Text_Control( $wp_customize, 'thunderbear_wordpress', array(
		'label'     => 'WordPress',
		'section'   => 'thunderbear_social_profiles_section'
	) ) );


	/** ===============
	 * Easy Digital Downloads Options
	 */
	// only if EDD is activated
	if ( thunderbear_edd_is_activated() ) {
		$wp_customize->add_section( 'thunderbear_edd_options', array(
			'title'         => __( 'Easy Digital Downloads', 'thunderbear' ),
			'description'   => __( 'All other EDD options are under Dashboard => Downloads. If you deactivate EDD, these options will no longer appear.', 'thunderbear' ),
			'priority'      => 50,
		) );

		// show featured images on products?
		$wp_customize->add_setting( 'thunderbear_product_featured_image', array(
			'default'           => 1,
			'sanitize_callback' => 'thunderbear_sanitize_checkbox'
		) );
		$wp_customize->add_control( 'thunderbear_product_featured_image', array(
			'label'     => __( 'Show Featured Images on Products', 'thunderbear' ),
			'section'   => 'thunderbear_edd_options',
			'priority'  => 5,
			'type'      => 'checkbox',
		) );

		// product image uploader
		$wp_customize->add_setting( 'thunderbear_product_image_upload', array( 'default' => null ) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'thunderbear_product_image_upload', array(
			'label'        => __( 'Default Product Image', 'thunderbear' ),
			'section'      => 'thunderbear_edd_options',
			'description'  => __( 'Recommended: default product image should be the same dimensions as your uploaded Download Images (if used). Thunderbear default product image crop dimensions: 722px 361px.', 'thunderbear' ),
			'settings'     => 'thunderbear_product_image_upload',
			'priority'     => 10
		) ) );

		// use default image fallback
		$wp_customize->add_setting( 'thunderbear_product_image', array(
			'default'           => 0,
			'sanitize_callback' => 'thunderbear_sanitize_checkbox'
		) );
		$wp_customize->add_control( 'thunderbear_product_image', array(
			'label'     => __( 'Use Default Product Image Fallback', 'thunderbear' ),
			'section'   => 'thunderbear_edd_options',
			'priority'  => 20,
			'type'      => 'checkbox',
		) );

		// show comments on downloads?
		$wp_customize->add_setting( 'thunderbear_download_comments', array(
			'default'           => 0,
			'sanitize_callback' => 'thunderbear_sanitize_checkbox'
		) );
		$wp_customize->add_control( 'thunderbear_download_comments', array(
			'label'     => __( 'Show Comments on Downloads', 'thunderbear' ),
			'section'   => 'thunderbear_edd_options',
			'priority'  => 30,
			'type'      => 'checkbox',
		) );

		// show categories/tags on [downloads] shortcode?
		$wp_customize->add_setting( 'thunderbear_downloads_taxonomies', array(
			'default'           => 0,
			'sanitize_callback' => 'thunderbear_sanitize_checkbox'
		) );
		$wp_customize->add_control( 'thunderbear_downloads_taxonomies', array(
			'label'     => __( 'Show Categories/Tags on Downloads grid', 'thunderbear' ),
			'section'   => 'thunderbear_edd_options',
			'priority'  => 40,
			'type'      => 'checkbox',
		) );

		/**
		 * EDD button color
		 *
		 * Respect and reflect the EDD button color setting by default and
		 * only change the EDD button color if changes in the customizer.
		 */
		switch ( edd_get_option( 'checkout_color' ) ) {
			case 'white':
				$edd_button_color_hex = '#404040';
				break;
			case 'gray':
				$edd_button_color_hex = '#f1f1f1';
				break;
			case 'blue':
			default:
				$edd_button_color_hex = '#428bca';
				break;
			case 'red':
				$edd_button_color_hex = '#E74C3C';
				break;
			case 'green':
				$edd_button_color_hex = '#2ECC71';
				break;
			case 'yellow':
				$edd_button_color_hex = '#F1C40F';
				break;
			case 'orange':
				$edd_button_color_hex = '#E67E22';
				break;
			case 'dark-gray':
				$edd_button_color_hex = '#3d3d3d';
				break;
		}
		$wp_customize->add_setting( 'thunderbear_edd_button_color', array(
			'default'     => $edd_button_color_hex,
			'type'        => 'option',
			'capability'  => 'edit_theme_options',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'thunderbear_edd_button_color', array(
			'label'        => __( 'EDD Button Color', 'thunderbear' ),
			'section'      => 'thunderbear_edd_options',
			'description'  => __( 'By default, this will match what you set in the EDD Style Settings. Selecting another color here will override the EDD setting. Clear the color field back to default to revert back to the EDD setting.', 'thunderbear' ),
			'priority'     => 40,
		) ) );

		// EDD Downloads page template title
		$wp_customize->add_setting( 'thunderbear_store_front_title', array(
			'default'           => null,
			'sanitize_callback' => 'thunderbear_sanitize_textarea_lite',
		) );
		$wp_customize->add_control( new thunderbear_WP_Customize_Textarea_Control( $wp_customize, 'thunderbear_store_front_title', array(
			'label'         => __( 'EDD Downloads Template Title', 'thunderbear' ),
			'section'       => 'thunderbear_edd_options',
			'description'   => __( 'This optional field allows you to replace the title of your EDD Downloads Page Template. If left blank, the title of the page will show instead. Allowed tags:', 'thunderbear' ) . ' <a>, <span>, <em>, <strong>',
			'priority'      => 50,
		) ) );

		// Empty Cart Title
		$wp_customize->add_setting( 'thunderbear_empty_cart_title', array(
			'default'           => null,
			'sanitize_callback' => 'thunderbear_sanitize_textarea_lite',
		) );
		$wp_customize->add_control( new thunderbear_WP_Customize_Textarea_Control( $wp_customize, 'thunderbear_empty_cart_title', array(
			'label'         => __( 'Empty Cart Title', 'thunderbear' ),
			'section'       => 'thunderbear_edd_options',
			'description'   => __( 'This is the title on the page that displays when the cart is empty. Allowed tags:', 'thunderbear' ) . ' <a>, <span>, <em>, <strong>',
			'priority'      => 60,
		) ) );

		// empty cart text
		$wp_customize->add_setting( 'thunderbear_empty_cart_text', array(
			'default'           => null,
			'sanitize_callback' => 'thunderbear_sanitize_textarea',
		) );
		$wp_customize->add_control( new thunderbear_WP_Customize_Textarea_Control( $wp_customize, 'thunderbear_empty_cart_text', array(
			'label'        => __( 'Empty Cart Text', 'thunderbear' ),
			'section'      => 'thunderbear_edd_options',
			'description'  => __( 'Displays a custom message when the checkout cart is empty. Allowed tags: ', 'thunderbear' ) . ' <img>, <a>, <div>, <span>, <blockquote>, <p>, <em>, <strong>, <form>, <input>, <br>, <s>, <i>, <b>',
			'priority'     => 70,
		) ) );

		// store front item count
		$wp_customize->add_setting( 'thunderbear_empty_cart_downloads_count', array(
			'default'           => 4,
			'sanitize_callback' => 'thunderbear_sanitize_integer'
		) );
		$wp_customize->add_control( new thunderbear_WP_Customize_Text_Control( $wp_customize, 'thunderbear_empty_cart_downloads_count', array(
			'label'        => __( 'Empty Cart Downloads Count', 'quota' ),
			'section'      => 'thunderbear_edd_options',
			'description'  => __( 'Enter the number of downloads you would like to display on the checkout page when the cart is empty. Additional downloads are available through pagination.', 'thunderbear' ),
			'priority'     => 80,
		) ) );
	}


	/** ===============
	 * EDD Frontend Submissions Options
	 */
	// only if FES is activated
	if ( thunderbear_fes_is_activated() && thunderbear_edd_is_activated() ) {
		$wp_customize->add_section( 'thunderbear_fes_options', array(
	    	'title'         => __( 'EDD Frontend Submissions', 'thunderbear' ),
			'description'   => __( 'All other FES options are under Dashboard => EDD FES. If you deactivate EDD or FES, these options will no longer appear.', 'thunderbear' ),
			'priority'      => 51,
		) );

		// FES Dashboard Title
		$wp_customize->add_setting( 'thunderbear_fes_dashboard_title', array(
			'default'           => null,
			'sanitize_callback' => 'thunderbear_sanitize_textarea_lite',
		) );
		$wp_customize->add_control( new thunderbear_WP_Customize_Textarea_Control( $wp_customize, 'thunderbear_fes_dashboard_title', array(
			'label'         => __( 'FES Dashboard Title', 'thunderbear' ),
			'section'       => 'thunderbear_fes_options',
			'description'   => __( 'This optional field allows you to replace the title of your FES Dashboard. If left blank, the title of the page will show instead. Allowed tags:', 'thunderbear' ) . ' <a>, <span>, <em>, <strong>',
			'priority'      => 10,
		) ) );

		// contact form on Vendor pages
		$wp_customize->add_setting( 'thunderbear_vendor_contact_form', array(
			'default'           => 0,
			'sanitize_callback' => 'thunderbear_sanitize_checkbox'
		) );
		$wp_customize->add_control( 'thunderbear_vendor_contact_form', array(
			'label'     => __( 'Show contact form on Vendor template', 'thunderbear' ),
			'section'   => 'thunderbear_fes_options',
			'priority'  => 20,
			'type'      => 'checkbox',
		) );
	}


	/** ===============
	 * Static Front Page
	 */
	// section adjustments
	$wp_customize->get_section( 'static_front_page' )->priority = 60;
}
add_action( 'customize_register', 'thunderbear_customize_register' );


/**
 * Sanitize checkbox options
 */
function thunderbear_sanitize_checkbox( $input ) {
	return 1 == $input ? 1 : 0;
}


/**
 * Sanitize text input
 */
function thunderbear_sanitize_text( $input ) {
	return strip_tags( stripslashes( $input ) );
}


/**
 * Sanitize text input to allow anchors
 */
function thunderbear_sanitize_link_text( $input ) {
	return strip_tags( stripslashes( $input ), '<a>' );
}


/** ===============
 * Sanitize integer input
 */
function thunderbear_sanitize_integer( $input ) {
	return absint( $input );
}


/**
 * Sanitize textarea
 */
function thunderbear_sanitize_textarea( $input ) {
	$allowed = array(
		's'         => array(),
		'br'        => array(),
		'em'        => array(),
		'i'         => array(),
		'strong'    => array(),
		'b'         => array(),
		'a'         => array(
			'href'          => array(),
			'title'         => array(),
			'class'         => array(),
			'id'            => array(),
			'style'         => array(),
			'target'        => array(),
		),
		'form'      => array(
			'id'            => array(),
			'class'         => array(),
			'action'        => array(),
			'method'        => array(),
			'autocomplete'  => array(),
			'style'         => array(),
		),
		'input'     => array(
			'type'          => array(),
			'name'          => array(),
			'class'         => array(),
			'id'            => array(),
			'value'         => array(),
			'placeholder'   => array(),
			'tabindex'      => array(),
			'style'         => array(),
		),
		'img'       => array(
			'src'           => array(),
			'alt'           => array(),
			'class'         => array(),
			'id'            => array(),
			'style'         => array(),
			'height'        => array(),
			'width'         => array(),
		),
		'span'      => array(
			'class'         => array(),
			'id'            => array(),
			'style'         => array(),
		),
		'p'         => array(
			'class'         => array(),
			'id'            => array(),
			'style'         => array(),
		),
		'div'       => array(
			'class'         => array(),
			'id'            => array(),
			'style'         => array(),
		),
		'blockquote' => array(
			'cite'          => array(),
			'class'         => array(),
			'id'            => array(),
			'style'         => array(),
		),
	);
	return wp_kses( $input, $allowed );
}


/**
 * Sanitize textarea lite
 */
function thunderbear_sanitize_textarea_lite( $input ) {
	$allowed = array(
		'em'        => array(),
		'strong'    => array(),
		'a'         => array(
			'href'          => array(),
			'title'         => array(),
			'class'         => array(),
			'id'            => array(),
			'style'         => array(),
			'target'        => array(),
		),
		'span'      => array(
			'class'         => array(),
			'id'            => array(),
			'style'         => array(),
		),
	);
	return wp_kses( $input, $allowed );
}


/**
 * sanitize hex colors
 */
function thunderbear_sanitize_hex_color( $color ) {
	if ( '' === $color ) :
		return '';
	endif;

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) :
		return $color;
	endif;

	return null;
}


/**
 * Add Customizer theme styles to <head>
 */
function thunderbear_customizer_head_styles() {
	$design_color       = get_option( 'thunderbear_design_color' );
	$bg_color           = get_option( 'thunderbear_background_color' );
	$edd_button_color   = get_option( 'thunderbear_edd_button_color' );
	$edd_color_defaults = array( '#404040', '#f1f1f1', '#E74C3C', '#2ECC71', '#F1C40F', '#E67E22', '#3d3d3d' );
	?>

	<style type="text/css">
		<?php if ( 1 == get_theme_mod( 'thunderbear_hide_tagline' ) ) : // if no tagline, reposition the header cart total ?>
			.header-cart {
				top: 26px;
			}
		<?php endif; ?>
		<?php if ( '#f1f1f1' != $bg_color && '' != $bg_color ) : // Is the background color no longer the default? ?>
			body {
				background: <?php echo thunderbear_sanitize_hex_color( $bg_color ); ?>;
			}
		<?php endif; ?>
		<?php if ( '' != $edd_button_color && ! in_array( $edd_button_color, $edd_color_defaults ) ) : ?>
			.edd-submit.button {
				background: <?php echo thunderbear_sanitize_hex_color( $edd_button_color ); ?> !important;
			}
			.edd-submit.button:hover {
				background: #3d3d3d !important; color: #fff;
			}
		<?php endif; ?>
		<?php if ( '#428bca' != $design_color && '' != $design_color ) : // Is the design color no longer the default? ?>
			#masthead,
			input[type="submit"],
			input[type="button"],
			.thunderbear-fes-dashboard-template .fes-form .fes-submit input[type="submit"],
			.thunderbear-fes-dashboard-template .fes-form .edd-submit.button,
			.thunderbear-edd-fes-shortcode .fes-form .fes-submit input[type="submit"],
			.thunderbear-edd-fes-shortcode .fes-form .edd-submit.button,
			.thunderbear-vendor-contact .fes-form .fes-submit input[type="submit"],
			.thunderbear-fes-template .fes-fields .fes-feat-image-upload a.fes-feat-image-btn,
			.thunderbear-edd-fes-shortcode .fes-fields .fes-feat-image-upload a.fes-feat-image-btn,
			.thunderbear-fes-template .fes-fields .fes-avatar-image-upload a.fes-avatar-image-btn,
			.thunderbear-edd-fes-shortcode .fes-fields .fes-avatar-image-upload a.fes-avatar-image-btn,
			button,
			.more-link,
			.by-post-author,
			.main-navigation:not(.toggled) ul li:hover > ul,
			#edd_download_pagination .page-numbers.current,
			.edd_pagination .page-numbers.current,
			div[class*="fes-"] > .page-numbers.current,
			div[id*="edd_commissions_"] .page-numbers.current,
			#edd_download_pagination .page-numbers:hover,
			.edd_pagination .page-numbers:hover,
			div[class*="fes-"] > .page-numbers:hover,
			div[id*="edd_commissions_"] .page-numbers:hover {
				background: <?php echo thunderbear_sanitize_hex_color( $design_color ); ?>;
			}
			a,
			.comment-full:hover > .reply > .comment-reply-link {
				color: <?php echo thunderbear_sanitize_hex_color( $design_color ); ?>;
			}
			h1, h2 {
				border-color: <?php echo thunderbear_sanitize_hex_color( $design_color ); ?>;
			}
			@media all and ( min-width: 860px ) {
				.main-navigation ul li:hover > ul {
					background: <?php echo thunderbear_sanitize_hex_color( $design_color ); ?>;
				}
			}
		<?php endif; ?>
	</style>
	<?php
}
add_action( 'wp_head', 'thunderbear_customizer_head_styles' );


/**
 * Enqueue script for custom customize control.
 */
function thunderbear_custom_customizer_enqueue() {
	wp_enqueue_script( 'thunderbear_custom_customizer', get_template_directory_uri() . '/assets/js/custom-customizer.js', array( 'jquery', 'customize-controls' ), THUNDERBEAR_VERSION, true );
}
add_action( 'customize_controls_enqueue_scripts', 'thunderbear_custom_customizer_enqueue' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function thunderbear_customize_preview_js() {
	wp_enqueue_script( 'thunderbear_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), THUNDERBEAR_VERSION, true );
}
add_action( 'customize_preview_init', 'thunderbear_customize_preview_js' );

/**
 * Add Customizer UI styles to the <head> only on Customizer page
 */
function thunderbear_customizer_styles() { ?>
	<style type="text/css">
		#customize-controls #customize-theme-controls .description { display: block; color: #666;  font-style: italic; margin: 2px 0 15px; }
		#customize-controls #customize-theme-controls .customize-section-description { margin-top: 10px; }
		textarea, input, select,
		.customize-description { font-size: 12px !important; }
		.customize-control-title { font-size: 13px !important; margin: 5px 0 3px !important; }
		.customize-control label { font-size: 12px !important; }
		.customize-control { margin-bottom: 10px; }
		.thunderbear-toggle-wrap { display: inline-block; line-height: 1; margin-left: 2px; }
		.thunderbear-toggle-wrap a { display: block; background: rgba(0, 0, 0, .2); color: #fff; padding: 2px 6px; border-radius: 3px; margin-left: 6px; }
		.thunderbear-toggle-wrap a:hover,
		.thunderbear-toggle-wrap .thunderbear-description-opened { background: #555; color: #fff; }
		.control-description { color: #666; font-style: italic; margin-bottom: 6px; }
		.thunderbear-control-description { display: none; }
		.customize-control-text + .customize-control-checkbox,
		.customize-control-customtext + .customize-control-checkbox,
		.customize-control-image + .customize-control-checkbox { margin-top: 12px; }
		#customize-control-thunderbear_empty_cart_downloads_count input { width: 50px; }
	</style>
<?php }
add_action( 'customize_controls_print_styles', 'thunderbear_customizer_styles' );
