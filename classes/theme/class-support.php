<?php
namespace dev;

class ThemeSupportConfig extends Base
{
    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'initThemeSupport']);
    }

    public function initThemeSupport()
    {
        $this->addThemeSupport('post thumbnails');
        $this->addThemeSupport('title tag');

        $this->removeThemeSupport('widgets block editor');
    }

    private function addThemeSupport($feature)
    {
        $key = parent::formatLabel($feature, '-', false);
        add_theme_support($key);
    }

    private function removeThemeSupport($feature)
    {
        $key = parent::formatLabel($feature, '-', false);
        remove_theme_support($key);
    }
}

new ThemeSupportConfig();
