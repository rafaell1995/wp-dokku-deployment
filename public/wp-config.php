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

// Verifica se WP_CLI está definido e ajusta o caminho do autoloader conforme necessário
if (defined('WP_CLI')) {
    // Configurações específicas para WP-CLI
    // Define HTTP_HOST para evitar erros quando acessado via WP-CLI
    $_SERVER['HTTP_HOST'] = 'default.local';
}

require_once (__DIR__ . '/../vendor/autoload.php');

// Environments to R2
define("S3_UPLOADS_ENDPOINT", getenv("S3_UPLOADS_ENDPOINT"));
define("S3_UPLOADS_BUCKET", getenv("S3_UPLOADS_BUCKET"));
define("S3_UPLOADS_BUCKET_URL", getenv("S3_UPLOADS_BUCKET_URL"));
define("S3_UPLOADS_REGION", getenv("S3_UPLOADS_REGION"));
define("S3_UPLOADS_KEY", getenv("S3_UPLOADS_KEY"));
define("S3_UPLOADS_SECRET", getenv("S3_UPLOADS_SECRET"));

$s3UploadsDisableReplaceUploadUrl = getenv("S3_UPLOADS_DISABLE_REPLACE_UPLOAD_URL");

if ($s3UploadsDisableReplaceUploadUrl !== false) {
    define("S3_UPLOADS_DISABLE_REPLACE_UPLOAD_URL", $s3UploadsDisableReplaceUploadUrl);
}

define("S3_UPLOADS_OBJECT_ACL", getenv("S3_UPLOADS_OBJECT_ACL"));
define("S3_UPLOADS_HTTP_CACHE_CONTROL", getenv("S3_UPLOADS_HTTP_CACHE_CONTROL"));
define("S3_UPLOADS_AUTOENABLE", getenv("S3_UPLOADS_AUTOENABLE"));

$s3UploadsUseLocal = getenv("S3_UPLOADS_USE_LOCAL");

if ($s3UploadsUseLocal !== false) {
    define("S3_UPLOADS_USE_LOCAL", $s3UploadsUseLocal);
}

// You'll need a DATABASE_URL env variable set.
$database = parse_url(getenv('DATABASE_URL'));

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', substr($database['path'], 1));

/** MySQL database username */
define('DB_USER', $database['user']);

/** MySQL database password */
define('DB_PASSWORD', $database['pass']);

/** MySQL hostname */
define('DB_HOST', $database['host']);

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
define('AUTH_KEY', getenv('WP_AUTH_KEY'));
define('SECURE_AUTH_KEY', getenv('WP_SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY', getenv('WP_LOGGED_IN_KEY'));
define('NONCE_KEY', getenv('WP_NONCE_KEY'));
define('AUTH_SALT', getenv('WP_AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('WP_SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT', getenv('WP_LOGGED_IN_SALT'));
define('NONCE_SALT', getenv('WP_NONCE_SALT'));


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
define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', false);
define('WP_DEBUG_LOG', '/tmp/wp-errors.log');

/**
 * This will block users being able to use the plugin and theme installation/update functionality from the WordPress admin area. 
 * Setting this constant also disables the Plugin and Theme File editor 
 * (i.e. you don’t need to set DISALLOW_FILE_MODS and DISALLOW_FILE_EDIT, as on its own DISALLOW_FILE_MODS will have the same effect).
 *
 * @link See https://developer.wordpress.org/apis/wp-config-php/#disable-plugin-and-theme-update-and-installation
 */
define('DISALLOW_FILE_MODS', true);

// If we're behind a proxy server and using HTTPS, we need to alert Wordpress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}
$protocol = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';

$siteurl = getenv('WP_SITEURL');
if (empty($siteurl)) {
    $siteurl = $protocol . '://' . $_SERVER['HTTP_HOST'];
}

// Update wp-content path.
// https://codex.wordpress.org/Editing_wp-config.php#Moving_wp-content_folder
define('WP_CONTENT_DIR', realpath(__DIR__ . '/wp-content'));
define('WP_CONTENT_URL', $siteurl . '/wp-content');

// Force site url based in a env var in production while keep the host name as site url in development

define('WP_HOME', $siteurl);
define('WP_SITEURL', $siteurl);


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

// Disable concatenation of scripts.
// define('CONCATENATE_SCRIPTS', false);

// Increase PHP memory limit due to WPML requirements.
define('WP_MEMORY_LIMIT', '128M');

set_time_limit(300);

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
