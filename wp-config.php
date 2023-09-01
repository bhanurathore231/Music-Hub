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
define( 'DB_NAME', 'u688797554_mattGeorge1' );

/** Database username */
define( 'DB_USER', 'u688797554_mattGeorge1' );

/** Database password */
define( 'DB_PASSWORD', 'Abcd@12345' );

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
define( 'AUTH_KEY',         ']`B{-gsiS46+aA[Kb+T$2`X2;1/oGf<k%tgA1=@^jKuA$2(?dN=XxKE<NT0llcp`' );
define( 'SECURE_AUTH_KEY',  '@yIt93dCL*3rC?Zg&Ig!p{|J}f/8b)h`H$Ew3GDJXnuM&4y(Gfr~X6WmC{YR9FR8' );
define( 'LOGGED_IN_KEY',    'CXXD1Jq`|OrHA!YHVA)R$y @4dz5^dSS7ynV5!OnK:d_2qKp#<qd7/S=`999M@E!' );
define( 'NONCE_KEY',        'B40r1[O`[4`]eP^4)vomd8gDP$N>MZ95NcddZRV_ES^N7SnRk=h VMTe&&E3cD](' );
define( 'AUTH_SALT',        's|%r-U>m%|vjy6BL}u${ZxI+[bgf;/:.=]}VxEVT|EqOxAlgJ8_VMi[UlC *GAi0' );
define( 'SECURE_AUTH_SALT', '_wZB t+Gui!`;Lk4S}>u@Ryk]9!^$fCD7Ihi*:Iyss$]OyOpXyWw+2g,j3;GD%Y*' );
define( 'LOGGED_IN_SALT',   'E<L6Gi]EzkJe`d0w5_^dpiSbU_*#$IeI/x-?xmP)9Ke=%AyZLg26ztd.8*tJDrz6' );
define( 'NONCE_SALT',       'S271*v|1mxE?TR/Wo3A,KXBDf#}|/hC2nW-U7#~|h}nURA=+5lGmB|nP#J+n&M.=' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
