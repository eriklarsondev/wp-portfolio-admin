<?php
namespace dev;

class DashboardConfig
{
    public function __construct()
    {
        // disable theme/plugin file editor
        define('DISALLOW_FILE_EDIT', true);

        // disable theme/plugin auto updates
        add_filter('auto_update_theme', '__return_false');
        add_filter('auto_update_plugin', '__return_false');
    }
}

new DashboardConfig();
