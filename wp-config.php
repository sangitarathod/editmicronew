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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'editmicr_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'ac3r');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '/As-S1<?c*M`!vW} +1%{CKkVRSQ=paqkyn8-ki7h~Y{HUJn#hQ#IHzFiZ4i;ezy');
define('SECURE_AUTH_KEY',  'L[DUq_DiYPJvl$S>U4z;w<tF{ BoZ8pKcN<L-v*5dAWc:X{ZltYD#DG~JgSBQB3X');
define('LOGGED_IN_KEY',    '4{;M?BH+HY8}!)zc.an8a}y.Ps{qgnElH`9aLX603^|w:Hy_OEGK=!2_!|QRM<kn');
define('NONCE_KEY',        'x6R{9u7Gcg=3<qUlo,41?}0f#nb)GXA,a)9P@FhAWGj<H$62eIp0g%P>s]dBs;lX');
define('AUTH_SALT',        ']6sa/N-Wc`K} 0{&gB/Y|9IJ`@Kz{}YD~!4KpkeFUfPYNf.FX3k:)IaUJj6pFtF-');
define('SECURE_AUTH_SALT', '3Ge{0MqxOLfb;R&}UT8dwrLHQv%Oy_9B< =#uk=9c[Z9B b+o*vb{yKk|t6%Vf-N');
define('LOGGED_IN_SALT',   'J~NBS(d)%JoVb&{Ic_16(`=mJu&Cf|;SKG=;I4oHY:v%=7gzGTp7g5c|K9n}L(jX');
define('NONCE_SALT',       'Tg.>p/;jWwOn~G?Ew~~R1vRs>y<{pXL{M&1Gdv$QH|#ky!T(o=}.4(_oU%K ]YPJ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
define('FS_METHOD','direct');
define( 'WP_MEMORY_LIMIT', '512M' );
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
