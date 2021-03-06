<?php

return array(
	'DB_HOST' => '127.0.0.1',

	/** Database Charset to use in creating database tables. */
	'DB_CHARSET' => 'utf8',

	/** The Database Collate type. Don't change this if in doubt. */
	'DB_COLLATE' => '',

	'WP_CACHE_KEY_SALT' => empty( $_SERVER['HTTP_HOST'] ) ? 'local.wordpress-ms.dev' : $_SERVER['HTTP_HOST'],
	'memcached_servers' => array(
		'127.0.0.1:11211',
	),

	'batcache' => array(
		'unique' => call_user_func(function(){
			$unique = array();
			$basic_auth = array();
			if ( ! empty($_SERVER['PHP_AUTH_USER']) ) {
				$basic_auth[] = $_SERVER['PHP_AUTH_USER'];
			}
			if ( ! empty( $_SERVER['PHP_AUTH_PW'] ) ) {
				$basic_auth[] = $_SERVER['PHP_AUTH_PW'];
			}
			if ( ! empty( $basic_auth ) ) {
				$unique['basic_auth'] = md5( join( ':', $basic_auth ) );
			}
			return $unique;
		}),
		'status_header' => false, // eliminates PHP Notice generated by Batcache about this property not being defined
		'query' => array(), // supplied with the query string vars, but if we don't supply it here there will be a PHP notice about an undefined object property
	),

	/**#@+
	 * Authentication Unique Keys and Salts.
	 *
	 * Change these to different unique phrases!
	 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
	 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
	 *
	 * @since 2.6.0
	 */
	'AUTH_KEY'         => ']I}jIz1;|`p-aQeM5K|txjQ/s=C]19gCt0+(ucdE jhrB^*Qo[>jlBW|;[#V`A]y',
	'SECURE_AUTH_KEY'  => 'I{--&2<.5R2%bW2y(j9ba%Os]3}w8Ley??c/$yN|IX[#]|m;FSKA[F5PR F-Z%/>',
	'LOGGED_IN_KEY'    => ';%t@BnF0fNr51dK`):laLk7b7gl?+r^Ec@P$e|;PAp gzi>fkhFk{/fC60@SM#Z0',
	'NONCE_KEY'        => '12F|9,SfcqiTa35w(E{&AwF/a~ii n}p4lq0@=|mrki+:p8e7!6W0p[LTzI)R,,-',
	'AUTH_SALT'        => 'W+Zgsf<Czb8x )[E6n>!9zMxyS+z>Ric`?-(:o3YBY-7d{-#Ucym;>-C,%[^/-fG',
	'SECURE_AUTH_SALT' => 'f@H];dv3ndffaj]Ef-5pV--44oT-+ TN|(:3a:^&g X?A%5=s+Vi1a0,/[kU^%z&',
	'LOGGED_IN_SALT'   => 'Ur-`[hO}kH<m6g}_z-n0WYmq|2:{J#8RU,f{}lgcIA C gxF7w4cP5xx)QTi4a;y',
	'NONCE_SALT'       => 'ekSj#*r{wSrPvcE|-HMjeUVDd7f!_iisfX5[8|6{-&.OOyDn`yid_D?MC 0kH{]Q',

	/**
	 * WordPress Localized Language, defaults to English.
	 *
	 * Change this to localize WordPress.  A corresponding MO file for the chosen
	 * language must be installed to wp-content/languages. For example, install
	 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
	 * language support.
	 */
	//'WPLANG' => 'en_US',

	/**
	 * For developers: WordPress debugging mode.
	 *
	 * Change this to true to enable the display of notices during development.
	 * It is strongly recommended that plugin and theme developers use WP_DEBUG
	 * in their development environments.
	 */
	'WP_DEBUG' => false,

	/**
	 * WordPress Database Table prefix.
	 *
	 * You can have multiple installations in one database if you give each a unique
	 * prefix. Only numbers, letters, and underscores please!
	 * Note: This is not the default "wp_" for security reasons.
	 */
	'table_prefix' => 'wp_',

	'DISALLOW_FILE_MODS' => true, // everything must be version-controlled
);
