<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'mixjunki_wo3635');

/** MySQL database username */
define('DB_USER', 'mixjunki_wo3635');

/** MySQL database password */
define('DB_PASSWORD', 'MiJXShRXM7qm');

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
define('AUTH_KEY', 'OFVVvNVZvPXtFNq;BbKpY_hgoqsSzw*C>oU|kSsGQ?TBWifr*xK]^vdDt}^kl?xdDU@Kc>GX+CrIkIL[n?mY[@pNs(>*ySMcn%<KrQ/TRY=;I<@%W@VB(IJMvwfHDD^y');
define('SECURE_AUTH_KEY', 'WR%[F(/p?]&pjMz]ZzQxG&j[+EyRw@IOE}-<(b|AC}JV(rx{>xK)hf<&e%l-YI}?AmCCBn;S(YNQNo[zpG(xy}|(-Aq|a_oYaNBj-;Je+ZH/DJ|gFKCiy]]BD?CK+elO');
define('LOGGED_IN_KEY', 'dJqBUg%YQH$hES=s]r])dj?qWzs$ZqHr&H^?!JL<^rO(ixCLX<vNGv?&-qYKTtgM>b{vV)rz_<zgzB[DCub>l@R!JoX{ptJZB_xdQWDPJuRDMECqbkdwDfYAsb=HN^[|');
define('NONCE_KEY', '=SRUy}x+>A[/VUv%CVucgU]SMm=tJ%P;vO^n|wv[UURkSHpadNC_S()Otld?N]_[lRH>m}-^v/Mw$DQzoV/x;<>IKc/n*DxV}iNC$ZXw}^qASwDB$hzCcHfQh-USswar');
define('AUTH_SALT', 'od^Q}gS{Q@XjPYNV^O>?bqo%jSpNP$NVTYRCg}nihZ|[lEOV/RWT<-|dKF{oOGCQWYRsG>x[xWkKaF-[V=dqiFM|*ContiQ}O?!&_!S^!z<@=N-Ty[)pK%yj/dK?ib@>');
define('SECURE_AUTH_SALT', 'Oy<wlCndNSmqIYbPfnz$ke!KzkF?G+rltaZD{l=I?N_qme*O}CZwamIO=_%RcWvmeP*ssgOeFrD*wa/m>Sb|o|UX%mFfiCd/q-ZEofSssfeE$D+{$dIdCiLU)PlT(Siy');
define('LOGGED_IN_SALT', 'F*llqG+Vuoh?*H/n%]nu?{-XSpMg*@EB>jMAGS{_CNdYLAaD(/v[^]cpeKsO($Oga&|on%mRNCbR--dh[&u!gW!&A-%[RT!ImYegvY;]bQKE>!W]kJb<-R{jP>PvdOWZ');
define('NONCE_SALT', 'GO;=cJHToxSlISPA[O^){^G$ZU>cE[oR]h=Gbr/+%l{G{l>lchiL*amrD)lyRtrNcS<nC*I=Y{{PY}rdQAF=H&^Z)mblySGF=XVeWNJMIXJ|uor_C[/p[pXBkI_QoqL&');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_oouh_';

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

/**
 * Include tweaks requested by hosting providers.  You can safely
 * remove either the file or comment out the lines below to get
 * to a vanilla state.
 */
if (file_exists(ABSPATH . 'hosting_provider_filters.php')) {
	include('hosting_provider_filters.php');
}

define ( 'WP_CONTENT_FOLDERNAME', 'media' );
define ( 'WP_CONTENT_DIR', ABSPATH . WP_CONTENT_FOLDERNAME );
define ( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define ( 'WP_CONTENT_URL', WP_SITEURL . WP_CONTENT_FOLDERNAME );