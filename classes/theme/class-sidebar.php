<?php
namespace dev;

class SidebarLocationConfig extends Base
{
    public function __construct()
    {
        add_action('init', [$this, 'initSidebarLocations']);
    }

    public function initSidebarLocations()
    {
        $this->addSidebarLocation('sidebar left');
        $this->addSidebarLocation('sidebar right');
    }

    private function addSidebarLocation($sidebar_name, $description = '')
    {
        $key = parent::formatLabel($sidebar_name);

        $args = [
            'name' => ucwords($sidebar_name),
            'id' => $key,
            'description' => $description,
        ];

        register_sidebar($args);
    }

    private function removeSidebarLocation($sidebar_name)
    {
        $key = parent::formatLabel($sidebar_name);
        unregister_sidebar($key);
    }
}

new SidebarLocationConfig();
