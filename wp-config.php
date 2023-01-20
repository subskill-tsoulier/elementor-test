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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'banana-phone-lakers' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         '2.fJ6buQhuI{A7<+P;(L6)m`Q0kB5Akuvhj}6&GZ[/NL<.40:S~> ?{i{wg<PL~f' );
define( 'SECURE_AUTH_KEY',  'tu*~~]x!EGLK2YT]ei[*w6C$ox9[4?yXOUr?YR?4r8t3sa0upMTM7Q*Y^~+a_~5I' );
define( 'LOGGED_IN_KEY',    '.}`6+|FojZ?7j[(=U{;P(/W)4|8b^W}k_Nu&AQgRAKGa@Wi<M=cl$|^XGV+}-*Lf' );
define( 'NONCE_KEY',        ']v28*6^|*8S`ndC~:RyUOnr c=o;YU,z:QrS>Bz$34$5w*xGasFCZ<*Mye/i8WYM' );
define( 'AUTH_SALT',        'np]@CH30JxgQGoFc4X|.Z_Y0sRIk..@>Yw[dYIWx?(<Z)Md2KpSOXB?QcTb+bjB-' );
define( 'SECURE_AUTH_SALT', '.>e}Piy:sXb<k6X<@c&wO9f0j9{x`9V1{#zOgPD$]_2!OA(oy*T+Yy9xcxB@Eyi4' );
define( 'LOGGED_IN_SALT',   'uF]RV<BJd1&)VogPM7f$Jbgs2,%F8D9)7ChH%gemfP&v8Y7q;K{f^T-vk,cOpEb;' );
define( 'NONCE_SALT',       '=%)sW](s+77=tIzH7Hft100FNitt<gt8%WD9r<RwO-rma[sr68oB#Xr^mPHH4zpg' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
