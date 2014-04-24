<?php
/*
Plugin name: Send no-cache response header from wp-cron.php requests
Description: When WordPress is behind a caching proxy, ensure that the system cron pings to wp-cron.php do not hit the proxy cache but hit WordPress each time.
Plugin URL: http://core.trac.wordpress.org/ticket/25072
Author: X-Team
Author URI: http://x-team.com/
Version: 1.0
*/

if ( defined( 'DOING_CRON' ) && DOING_CRON ) {
	add_filter( 'nocache_headers', function ( $headers ) {
		$headers['Surrogate-Control'] = 'no-store';
		return $headers;
	});
	nocache_headers();
}
