<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'najumalmiad' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '~0gr0#:H]tdFUg:4ym5v4*WWr]XJ!aPd.`eq*Jw^k`W2k&QyFp0z`1{vS{,PHS<T' );
define( 'SECURE_AUTH_KEY',  'lZVM@A3g3>+6X9W$m?hk)rHu-,@/&+9U1~~N_%(thMGvUajXV2k+l}8KATww48Rc' );
define( 'LOGGED_IN_KEY',    '}0^xg[5GSjwE<^U48Q8;,<dSRLz;v7YkN$JK1hkn$,XLhHbp,.]Gz{cc-b&>JNF?' );
define( 'NONCE_KEY',        '.}H6M7E:Dt#PmM :19Q/dmI}OC(}+]+d#`4w!}wT=-gX($mKT,_b~N#HKFr%(w.-' );
define( 'AUTH_SALT',        ':Ki1T BkNC#66GCa68$txerf6xPk~1dai)S>,GjM.@>h@oI&XB2X:#{EvB<xN.]#' );
define( 'SECURE_AUTH_SALT', 'CswQ!Docs?xets/-0-rS-p.<?>fr*qlaB8XhXHbKw5}T6g~&D{ QOl~J*&vwfW-B' );
define( 'LOGGED_IN_SALT',   'h[@>FG4Z*2TBvv!:Y,/gS)vd{eOHqjyohC8k_m%@Q$fj_`#-.59Vv_EuC!P_m|RY' );
define( 'NONCE_SALT',       'vK3,$MwtFlat&*SRhxnCW*0Sf]B7ox0EEajk:-P<J4&{<)B<(]&X#Ba@AJ$o$[d+' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'nm_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

/* Add any custom values between this line and the "stop editing" line. */

define( 'FS_METHOD', 'direct' );
define('WP_MEMORY_LIMIT', '256M');
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

