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
define('DB_NAME', 'matt_cassella');

/** MySQL database username */
define('DB_USER', getenv("MYSQL_USER"));

/** MySQL database password */
define('DB_PASSWORD', getenv("MYSQL_PASS"));

/** MySQL hostname */
define('DB_HOST', getenv("MYSQL_HOST"));

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/* * #@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
 define('AUTH_KEY', 'vP~Vvb}+Z4!63cIQn>w~x5rDn{8/72dt{f/T^[c=P;Z9~=--N6+cMHV/vr*l[Q#I');
 define('SECURE_AUTH_KEY', 'N|2|-3)^50+UQ,W7Dg3p<*1{f!f8(e.KQ`EU#=/i1r%dp1Yt0#>`JkjZ$lf6M$9/');
 define('LOGGED_IN_KEY', 'en0rGs):w-]p6~yw0>Llyi8tRS#Egd=Z-pyK }{[c*@SM6B/y2bteM(PW+]3`=n?');
 define('NONCE_KEY', 's=M*yX-*!HCme;];4~$N*O~(^Biv)xbC-A|*0|##VF8%L6hZ0AKp|@?:0_ATb{w0');
 define('AUTH_SALT', 'BFn5D~:S+>:i*f!LJbk$04.pJS^amnh:+-~]%/Z@ZL@9=)WlRrOVqw=(NpJFD:FS');
 define('SECURE_AUTH_SALT', 'o`.3IN,up[,MP[dIM+OA#[k=<~U~Ha/pbi^n%^EH6}U;OPP]-2i)BcE<QSYxFECu');
 define('LOGGED_IN_SALT', '-lksq}+Ba+{azdK}$Rqel>~e:k+}1nRRdP1xax/|IoqWz+oO|S,{[<TJ%0p7^w20');
 define('NONCE_SALT', 'l:/DO<f+mbgJM(+z} DMF4)MOCqwNak[!P|uh$L:1Bk@VU^+:Xo-Cv] %Z2K,)>=');

/* * #@- */

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/* SECURITY */
define('WP_AUTO_UPDATE_CORE', false);

if (getenv("ENV") !== "local") {
    define('DISALLOW_FILE_MODS', true);
}

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

if (extension_loaded('newrelic')) {
    newrelic_set_appname("Matt Cassella - " . getenv("ENVIRONMENT"));
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
