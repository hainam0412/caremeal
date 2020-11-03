<?php
//define( 'WP_DEBUG', true );
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
define( 'DB_NAME', '0uXKd8eoEkBaoo' );

/** MySQL database username */
define( 'DB_USER', '0uXKd8eoEkBaoo' );

/** MySQL database password */
define( 'DB_PASSWORD', 'kpY37zAOsTaIlF' );

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
define( 'AUTH_KEY',          '=0?N6o{yX27UZs;-1ecRZV,_T-YluM1=@0X*FgrYPyd%}*#|~p;hj)c! ~=3$W8N' );
define( 'SECURE_AUTH_KEY',   'jGY6#HI~B})]#RY`!8 duLOpMa9bh*uFq9!DnMl6^-ny.XohB0OZA|N@d9j{r01k' );
define( 'LOGGED_IN_KEY',     '~I~YM+{1%!S74@jr)U*)Mi2e`]B==IGa(.PJ2FZ^I~(+x{)3;l%5=,SM.,iEoLDF' );
define( 'NONCE_KEY',         't2=kO/,&i)/jw04BhtQ+SL-8,7vzY>iA82u)KzxQJcR1#wf;EyTi[I$9sp1<u?,)' );
define( 'AUTH_SALT',         'qBtQ2GYktBK>IA9%H@z%VUZ4d9%b/.UJntTnwE2Rlk;,m#m;Z69x57&^9l_;0]C.' );
define( 'SECURE_AUTH_SALT',  '0!>?H4d%(3FSj_4L8UEgdSm0QE,DVq }{+:.} }QdVy(U;yfg B4{p[B!}_r47Rj' );
define( 'LOGGED_IN_SALT',    '$90mpw:#NvJN3acOYR>;~HF# Y;NM]19?#,Jf;nJI]z#efX`!Ncm8:S?TX4w7KCo' );
define( 'NONCE_SALT',        '3l/)5:E-X`{IoaTSP`VAP~YqzP7$PT^o=>,TUQo^Cff&2S=}9G[V!laU1yncfSLk' );
define( 'WP_CACHE_KEY_SALT', '7UJ+G9xmUilDn)*%mUsL/(-!~%P,g]0a>fuLq #%.NyAOyTBX?bUC/[O B =*Wm)' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
