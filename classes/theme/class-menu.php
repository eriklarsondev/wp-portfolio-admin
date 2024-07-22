<?php
namespace dev;

class MenuLocationConfig extends Base
{
    public function __construct()
    {
        add_action('init', [$this, 'initMenuLocations']);
    }

    public function initMenuLocations()
    {
        $this->addMenuLocation('header menu');
        $this->addMenuLocation('homepage hero');
        $this->addMenuLocation('social media bar');
    }

    private function addMenuLocation($menu_name)
    {
        $key = parent::formatLabel($menu_name);
        register_nav_menu($key, __(ucwords($menu_name), $key));
    }

    private function removeMenuLocation($menu_name)
    {
        $key = parent::formatLabel($menu_name);
        unregister_nav_menu($key);
    }
}

new MenuLocationConfig();
