<?php
namespace dev;

class RequiredPluginConfig extends Base
{
    public function __construct()
    {
        add_action('admin_init', [$this, 'initRequiredPlugins']);
    }

    public function initRequiredPlugins()
    {
        $this->isPluginActive('advanced custom fields', 'acf');
        $this->isPluginActive('ACF to REST API');
    }

    private function isPluginActive($plugin_name, $class_name = '')
    {
        if ($class_name) {
            if (!class_exists($class_name)) {
                $this->renderAdminNotice($plugin_name);
                return false;
            }
            return true;
        } else {
            $plugins = [];

            $installed = get_plugins();
            foreach ($installed as $plugin) {
                array_push($plugins, strtolower($plugin['Name']));
            }

            if (!in_array(parent::formatLabel($plugin_name, ' ', false), $plugins)) {
                $this->renderAdminNotice($plugin_name);
                return false;
            }
            return true;
        }
    }

    private function renderAdminNotice($plugin_name)
    {
        add_action('admin_notices', function () use ($plugin_name) {
            $url = $this->getSearchQuery($plugin_name); ?>
            <div class="notice notice-error">
                <p>
                    <strong><?php echo ucwords($plugin_name); ?></strong> was not found.
                    Click <a href="<?php echo $url; ?>">here</a> to install or activate this plugin.
                </p>
            </div>
            <?php
        });
    }

    private function getSearchQuery($plugin_name)
    {
        $query = parent::formatLabel($plugin_name, '%20', false);

        $url = admin_url('plugin-install.php') . '?s=' . $query;
        $url .= '&tab=search&type=term';

        return $url;
    }
}

new RequiredPluginConfig();
