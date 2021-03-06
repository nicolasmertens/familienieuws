<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'temp_familienieuws');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'Ikzag2berenbroodjessmeren!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'K|:|%Uhr/t|N|!EUOXH)S2+juRGZ.Al#z7aaNs1-.|{C>*] $Ih*q+oyj}X.l..H');
define('SECURE_AUTH_KEY',  'F[*gg>YDc)o|]`et>PTw):`wZnKQ0(9vC+0~y@&9wd%Pw9Yu8ZXn@v^B-^<+C3x8');
define('LOGGED_IN_KEY',    'Z(X!3I5;|=j7ZvX-c~r2g;hMe}53Z#BP?s+`?(>h+y.toR-|_Ovt2+0PtX>2D!L5');
define('NONCE_KEY',        'VLT0 Pgtfk[C0}n|mXqfIf*6j&.+?<#1Js0g?=K3IRc+#k3q&ui9`KS%1V`-FPn_');
define('AUTH_SALT',        '7T;L6P}b`cC?do)|)WMO)d-H>ch(+-9yZ:#7mTu0KKA0IY1w_VZns +Ppv.x]8r~');
define('SECURE_AUTH_SALT', 'kZ|brH=K-y|g&= H16)tKzESP=|-i@I@FUT6zT/AToe#zcWRhLtJkBq@.PzzAe<d');
define('LOGGED_IN_SALT',   ')k$C]KT8aXsvef]?4$F[;b4&S~o-](Wb[Q/nD{wx{mj[zQ,q* =ySN.1czT:Uav<');
define('NONCE_SALT',       'f]]it/v$`bKnb]QyU=;R+%dbcL3)?%A E~9h+z~]mQ))n!/K&:3e/L%RH{t&LX<^');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

