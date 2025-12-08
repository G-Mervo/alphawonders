<?php

namespace Config;

use CodeIgniter\Config\ViewConfig as BaseViewConfig;

class View extends BaseViewConfig
{
    /**
     * --------------------------------------------------------------------------
     * View Decorators
     * --------------------------------------------------------------------------
     *
     * This option allows you to set view decorators that will be applied
     * to all views. This is useful for things like adding a header/footer
     * to all views.
     *
     * @var array<string, string>
     */
    public array $decorators = [];

    /**
     * --------------------------------------------------------------------------
     * Filters
     * --------------------------------------------------------------------------
     *
     * Filters allow you to process content before it's rendered.
     *
     * @var array<string, string>
     */
    public array $filters = [];

    /**
     * --------------------------------------------------------------------------
     * Plugins
     * --------------------------------------------------------------------------
     *
     * Plugins allow you to extend the functionality of the parser.
     *
     * @var array<string, callable>
     */
    public array $plugins = [];
}


