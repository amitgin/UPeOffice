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
define('DB_NAME', 'uptron');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '+GgLQ=M.%MYCk*[X{JGT9^{F&R_!YrAF.5Sox9Av}32DUPZ`tjen^n][x%/^|y`F');
define('SECURE_AUTH_KEY',  'nS]rE>pmud;In|cjOf^S2L[lTc{QF7Hxt ]8|VN=3ts8xh@exljRTZeX=8o4B{Jz');
define('LOGGED_IN_KEY',    '9^ 8e7YPOYFW/x$TJ<s(J Q>sUVjnm~}W/wFe?QBahxkBA|HK ?urKQN@a+/p;c0');
define('NONCE_KEY',        ':4<CzU.,iR9(oE$EI9pAw!Bndm}Dh~O&@j{^AbI4[F-qudl0F1pcIE[~<(({H!sI');
define('AUTH_SALT',        '|+pGC&mqRNc,$KTLa_X 6c.}$m Cx(R,=UlK67q7A/Fw!j{h)7{Dt_S]a#596Z:0');
define('SECURE_AUTH_SALT', 'Bj%.A%_-97B]0im9T2yQ6,WfxIX[B}E[Ydq4 -_4bUY?9Hy*f@f`O&TMZkT:U->`');
define('LOGGED_IN_SALT',   'Td38]B|il:J-2+fmb~&/B56+.YN`9;Y&}ngl`*:8e0Eqgv7bKq.U~T/XhEl<&ld;');
define('NONCE_SALT',       '^HN,|t6IwS}#CmVk.>6:OfyY@hh?3H/LQ{5T#ey/[Z*hr; -ipmnrLl5FA7rffy/');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'uptron_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
