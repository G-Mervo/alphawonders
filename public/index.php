<?php

/**
 * This file is part of the CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

// Path constants
define('ROOTPATH', realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR);
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
define('SYSTEMPATH', realpath(ROOTPATH . 'vendor/codeigniter4/framework/system') . DIRECTORY_SEPARATOR);
define('APPPATH', realpath(ROOTPATH . 'app') . DIRECTORY_SEPARATOR);
define('WRITEPATH', realpath(ROOTPATH . 'writable') . DIRECTORY_SEPARATOR);
define('SYSDIR', basename(SYSTEMPATH));

// Ensure the current directory is pointing to the front controller's directory
chdir(__DIR__);

// Load our paths config file
// This is the line that might need to be changed, depending on your structure.
$pathsConfig = ROOTPATH . 'app/Config/Paths.php';
if (!file_exists($pathsConfig)) {
    $pathsConfig = ROOTPATH . 'vendor/codeigniter4/framework/app/Config/Paths.php';
}
require realpath($pathsConfig);

$paths = new Config\Paths();

// Location of the framework bootstrap file.
require rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';

// Load environment settings from .env file into $_ENV
$app = new CodeIgniter\CodeIgniter($config);
$app->initialize();
$context = is_cli() ? 'php-cli' : 'web';
$app->setContext($context);

/*
 *---------------------------------------------------------------
 * DEVELOPMENT: Disable Caching
 *---------------------------------------------------------------
 * Uncomment the following lines during development to prevent
 * browser and server caching from hiding your changes.
 */
if (defined('ENVIRONMENT') && ENVIRONMENT === 'development') {
    header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
    header('Pragma: no-cache');
    header('Expires: 0');
}

/*
 *---------------------------------------------------------------
 * LAUNCH THE APPLICATION
 *---------------------------------------------------------------
 * Now that everything is setup, it's time to actually fire
 * up the engines and make this app do its thing.
 */
$app->run();

