<?php
// A big bunch of core constants.
define('BASE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('VENDOR_PATH', BASE_PATH . 'vendor' . DIRECTORY_SEPARATOR);
define('STORAGE_PATH', BASE_PATH . 'tests/storage' . DIRECTORY_SEPARATOR);
define('DOCROOT', BASE_PATH . 'tests' . DIRECTORY_SEPARATOR);
define('WEBROOT', BASE_PATH . 'tests/web' . DIRECTORY_SEPARATOR);

if (!defined('PHPUNIT')) {
    define('PHPUNIT', true);
}

if (!defined('BOOTSTRAP_ONLY')) {
    define('BOOTSTRAP_ONLY', true);
}

ini_set('display_errors', '1');

require VENDOR_PATH . '/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(BASE_PATH)->safeLoad();

require VENDOR_PATH . '/sproutcms/cms/src/bootstrap.php';
