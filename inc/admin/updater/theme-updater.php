<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package Thunderbear
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'Thunderbear_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new Thunderbear_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://thunderbeardesign.com',
		'item_name' => 'Thunderbear',
		'theme_slug' => 'thunderbear',
		'version' => THUNDERBEAR_VERSION,
		'author' => THUNDERBEAR_AUTHOR,
		'download_id' => '', // Optional, used for generating a license renewal link
		'renew_url' => '' // Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license'             => THUNDERBEAR_NAME . _x( ' License', 'part of the WordPress dashboard Thunderbear menu title', 'thunderbear' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'thunderbear' ),
		'license-key'               => __( 'License Key', 'thunderbear' ),
		'license-action'            => __( 'License Action', 'thunderbear' ),
		'deactivate-license'        => __( 'Deactivate License', 'thunderbear' ),
		'activate-license'          => __( 'Activate License', 'thunderbear' ),
		'status-unknown'            => __( 'License status is unknown.', 'thunderbear' ),
		'renew'                     => __( 'Renew?', 'thunderbear' ),
		'unlimited'                 => __( 'unlimited', 'thunderbear' ),
		'license-key-is-active'     => __( 'License key is active.', 'thunderbear' ),
		'expires%s'                 => __( 'Expires %s.', 'thunderbear' ),
		'lifetime'                  => __( 'Lifetime License.', 'thunderbear' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'thunderbear' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'thunderbear' ),
		'license-key-expired'       => __( 'License key has expired.', 'thunderbear' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'thunderbear' ),
		'license-is-inactive'       => __( 'License is inactive.', 'thunderbear' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'thunderbear' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'thunderbear' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'thunderbear' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'thunderbear' ),
		'update-available'          => __( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'thunderbear' )
	)
);
