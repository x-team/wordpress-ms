<?php
if ( ! class_exists( 'WP_Config_Array' ) ) {
	require_once __DIR__ . '/../docroot/wp-content/mu-plugins/class-wp-config-array.php';
}

return call_user_func(function () {

	$env_array = array();
	$default_config_path = __DIR__ . '/default.env.php';
	if ( file_exists( $default_config_path ) ) {
		$env_array = require( $default_config_path );
	}
	$env = new WP_Config_Array( $env_array );

	$env->extend( array(
		'DB_NAME'     => 'wordpress_ms',
		'DB_USER'     => 'wp',
		'DB_PASSWORD' => 'wp',

		'WP_CACHE' => false,
		'batcache' => array(),

		'WP_DEBUG'          => true,
		'SCRIPT_DEBUG'      => true,
		'JETPACK_DEV_DEBUG' => true,

		'CONCATENATE_SCRIPTS' => false,
		'COMPRESS_SCRIPTS'    => false,
		'COMPRESS_CSS'        => false,
		'SAVEQUERIES'         => true,
		'DISABLE_WP_CRON'     => false, // use traditional wp-cron; we can really slam our system if all sites get pinged every minute

		'FORCE_SSL_LOGIN' => false,
		'FORCE_SSL_ADMIN' => false,

		'DISALLOW_FILE_MODS' => false, // allowed only in local env
	) );

	$overrides_config_path = __DIR__ . '/' . str_replace('.env.php', '-overrides.env.php', basename( __FILE__ ));
	if ( file_exists( $overrides_config_path ) ) {
		$env->extend( require( $overrides_config_path ) );
	}

	return $env;
});
