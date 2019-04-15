<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '5vBCwvXKU77zwmGuuZO/PYdjJFHlGLsvVs/5O7bK5foSszogVugr1SuLFG2ziNnUAry3y3SQmWbGGtlNk/rZTg==');
define('SECURE_AUTH_KEY',  'j5XYNb2vzInwr0DTX3XxCtaWdqN3MR4JDtVIFZ2KwKNa+ttSkzFgagBbJqhYfKqgL9mC+X/ukimsYGYI3kCdRQ==');
define('LOGGED_IN_KEY',    'IknaPBxrnzTVOxGDz72Sccstpd3Mx76YOUtm0mc3xE/mQqfstKZHdpbkNiG8TXoTAzaogiZry0xQaPxOxVBwUA==');
define('NONCE_KEY',        '/2zjIHxFoll+UBxPhtl3xZFQLIHuj9696dfZjH1EmisuM3N8w4IoYpC9r6HD2hk69NJiCtxbqInD4gQqqMKZTQ==');
define('AUTH_SALT',        'GcomPcwmn/yremp9Bqz41JVsE6tpwE9E6dK5PsMcsYcoPa3a53yFKiPxcZlwXrKybMZpvwUYKwCyDeMILXhZgA==');
define('SECURE_AUTH_SALT', 'c6JqVVP9/GCTErJxjGYdEdpXlHuKK9/yV/OK/X36oQHL/97AbrEwyVfgriQ75H5d1TPsa3uykqf0y/bmVRBO6A==');
define('LOGGED_IN_SALT',   'K99gvL+/tS8Tcr6HdeE1gCruTpqD9fpFISkxIGbZVTpt9V1YJMBwBf2wDXHCRVoiox5RtnFIOXt58V34iE+dRg==');
define('NONCE_SALT',       'KuFdDIUQgyFwEpSFDtJZTZ2mZkszLeHOw3nlR85FbQdq4rSEHKrE0xNZ2BjvQed8NVv3Qh8NO0P3L1R5q6n4lg==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
