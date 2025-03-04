<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'portfolio' );

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
define( 'AUTH_KEY',         'JTXIU6&HFmK{@J5C2$,j@8Usfed)-eX9.B*f8@WlYo_XJi-A|;aAZWeJjU<m*!Y%' );
define( 'SECURE_AUTH_KEY',  '<fKw/Q9=+A]rKm%xA-4l0p /!Jsd+GR)bT-q,r|Xb1Pc7=*^8ebQEkhFZL V%&th' );
define( 'LOGGED_IN_KEY',    '2aj8mXle%)7T`ztg37CDA&oAry C#RF)k7tU/3e5C?Y4]ty4U].!8]|3grO0-[&T' );
define( 'NONCE_KEY',        '=mkw(ym)n=Fh uiZb~5:ZM8LO~q.s2SIqg]yv+/~QZ^GDq%4-q[4Eg{wtrfc0:~q' );
define( 'AUTH_SALT',        '@-i3>w04T&OP0@u_#(^AP;[G]JA<BM`*W/Eun=Qja$P1kG%Gv<*aLs.N[1,r*D>k' );
define( 'SECURE_AUTH_SALT', '[We[]|y1/p.)#cOoPy;]=C<(4?=kx#=hAU!A04W]fm+(JWQZ;(f|`QgJBx:!0[yL' );
define( 'LOGGED_IN_SALT',   'CG^kE;_XX:{&gR4D&$jne/Ys0d`IP!tz&7/ac5(xX/CZ-#Hx.w^%%T)%b?[n{2FH' );
define( 'NONCE_SALT',       'xKy{MS)2=&bm8=#Rok% IpQv&{zQItCpVEz#Hr2;3Ht.*DdUjZ:O5-PClPGGeVA]' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
