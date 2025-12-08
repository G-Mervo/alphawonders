<?php

namespace Config;

/**
 * This file contains any constants that might be needed throughout the application.
 * 
 * For CI3 compatibility, we define some constants that might be used in views.
 */

// Base URL helper (if not using CI4's base_url() helper)
if (!defined('BASEPATH')) {
    define('BASEPATH', realpath(__DIR__ . '/../../') . DIRECTORY_SEPARATOR);
}

// Application paths
if (!defined('APPPATH')) {
    define('APPPATH', realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR);
}

// View path
if (!defined('VIEWPATH')) {
    define('VIEWPATH', APPPATH . 'Views' . DIRECTORY_SEPARATOR);
}

// Assets path
if (!defined('ASSETSPATH')) {
    define('ASSETSPATH', realpath(__DIR__ . '/../../assets') . DIRECTORY_SEPARATOR);
}


