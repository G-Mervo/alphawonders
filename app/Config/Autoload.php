<?php

namespace Config;

use CodeIgniter\Config\AutoloadConfig;

/**
 * Autoloader Configuration
 *
 * This file defines the namespaces and class maps so the Autoloader
 * can find the files as needed.
 *
 * NOTE: If you use an identical key in $psr4 or $classmap, then
 * the values in this file will overwrite the framework's values.
 */
class Autoload extends AutoloadConfig
{
    /**
     * --------------------------------------------------------------------------
     * Namespace to PSR-4 Mappings
     * --------------------------------------------------------------------------
     * This is an array of namespaces and their PSR-4 mappings.
     *
     * @var array<string, array<int, string>|string>
     */
    public $psr4 = [
        APP_NAMESPACE => APPPATH, // For custom app namespace
        'Config'      => APPPATH . 'Config',
    ];

    /**
     * --------------------------------------------------------------------------
     * Class Map
     * --------------------------------------------------------------------------
     * The class map provides a map of class names and their exact
     * location on the drive. Classes loaded in this manner will have
     * slightly faster performance because they will not have to be
     * searched for within one or more directories as they would if they
     * were being autoloaded through a namespace.
     *
     * Prototype:
     *   $classmap = [
     *       'MyClass'   => APPPATH . 'Libraries/MyClass.php'
     *   ];
     *
     * @var array<string, string>
     */
    public $classmap = [];

    /**
     * --------------------------------------------------------------------------
     * Files
     * --------------------------------------------------------------------------
     * The files array provides a list of paths to __non-class__ files
     * that will be autoloaded. This can be useful for bootstrap operations
     * or for loading functions.
     *
     * Prototype:
     *   $files = [
     *       '/path/to/my/file.php',
     *   ];
     *
     * @var array<int, string>
     */
    public $files = [];

    /**
     * --------------------------------------------------------------------------
     * Helpers
     * --------------------------------------------------------------------------
     * Prototype:
     *   $helpers = [
     *       'form',
     *   ];
     *
     * @var array<int, string>
     */
    public $helpers = ['url', 'form', 'html'];
}


