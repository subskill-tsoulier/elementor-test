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
define( 'DB_NAME', 'rgpd_x_dev' );

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
define( 'AUTH_KEY',         'quc&V%i]j3TT_nlaF<;rQp0]/lah}hF5+g^8<I2(N1s~-%%RM6NN N|dk{v.cR|O' );
define( 'SECURE_AUTH_KEY',  'Qc+BHO9y6QB320q!k`b-*?n7e&tb<r!IME|Qe<LXX6!i&V531gC(=XU-akoF&B9>' );
define( 'LOGGED_IN_KEY',    'JZ:BF|giw:%N1w;.NRD4<}X*NVD2P:z&1<GCVAh;]4@vefLJ`^G[%x1.|cU^v,5t' );
define( 'NONCE_KEY',        '7miH[sVzM>v3Z :=Fl<@1P<OT4JHXEQPU4a`q0YJofN1XY$*[&<r/T]]`FsdyUQ*' );
define( 'AUTH_SALT',        's~)&7QzMu.Q_cBf$=L]!0zz~eL9qd Ttd{cD>!XKEKV]JfDB5s.y&bS?JslGw4F|' );
define( 'SECURE_AUTH_SALT', 'BvD/mt]{C_D)v[FYjTd0W23dohG: 1f;Q^WF&d&84<TNnE[Dz,uh; 0l=s&_JhEp' );
define( 'LOGGED_IN_SALT',   '}4iBO7naG7j G!27r5UVy7a>m|0TMAZhRWB&]|dI=}T_M0@sNO%=IJOJT&WIdaew' );
define( 'NONCE_SALT',       'B?Fx6l@yf48WN:ujA6q-YusKZ9sV2uOEdm,)J{mwAOM~v0w>8)wzKzZRJt8R/%kL' );

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
