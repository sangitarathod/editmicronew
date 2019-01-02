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
define('DB_NAME', 'editmicrosystem_db');

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
define('AUTH_KEY',         ' `IO`|`}Mh^)$^a.6w|Y}$M`%}mT2R(Z~m+pn6o=d/,(k9Hg%L@h8f&0*b71oL:2');
define('SECURE_AUTH_KEY',  's49/&N^XHY3&%#13pha>BeFGKLAam+HD^nUc3vEM`>zXz?yku{563n}[I0?w@Ngd');
define('LOGGED_IN_KEY',    '5zt|~IS~(K`Ho},3yAQ&G4#}:f#xt(I`H{O.z}@L(.?3Y#XC^Fag)4MS_mXr%.@,');
define('NONCE_KEY',        'kKqFOZXhxM;59;RHo0J~9K!]k_N`$*X>`z#$U_s.n^CNo9PFG7u)@r^?ooFt%q+u');
define('AUTH_SALT',        'Y{GrtywK?Ui|(p`H#r6)pq>9T(g;D9/U,ZqR1nFS?hRlUP~D!mO0?Y|uqcz%):{r');
define('SECURE_AUTH_SALT', 'r(`&/{!}/O%#}G_GL<4 v$:N{)Xm8aa[v^jEmjZNjAnU:GaZgW$-C3+wg/tE /sd');
define('LOGGED_IN_SALT',   'S>(jfPDoO:)If/a 8HW6*`5N=/eXF15jL-ytl|kRg{]DOJ4B0y}XH5u1^LK%h&`v');
define('NONCE_SALT',       ';8m4lX}4 eMt!KHX<B?Jc&(Qx=j;:<(+pPv~=o30Rb_f}d#mKj(Wl@:|-^pTw>1d');

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
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
