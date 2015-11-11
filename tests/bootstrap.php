<?php
// Define path to application directory
define('ROOT_PATH', __DIR__ . "/..");
ini_set('display_errors', true);
date_default_timezone_set('Europe/Prague');

if (file_exists(ROOT_PATH . '/config.php')) {
    require_once ROOT_PATH . '/config.php';
}

require_once 'Test/OAuthApiTestCase.php';
require_once ROOT_PATH . '/vendor/autoload.php';

defined('OAUTH_API_URL')
    || define('OAUTH_API_URL', getenv('OAUTH_API_URL') ? getenv('OAUTH_API_URL') : 'url');

defined('STORAGE_API_TOKEN')
    || define('STORAGE_API_TOKEN', getenv('STORAGE_API_TOKEN') ? getenv('STORAGE_API_TOKEN') : 'your_token');
