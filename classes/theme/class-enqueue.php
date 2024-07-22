<?php
namespace dev;

class FileEnqueueConfig extends Base
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'initThemeStylesheets']);
        add_action('wp_footer', [$this, 'initThemeStylesheetsDeferred']);
        add_action('wp_enqueue_scripts', [$this, 'initThemeJavascripts']);
    }

    public function initThemeStylesheets()
    {
        $dir = dirname(get_template_directory_uri()) . '/dist';

        $this->removeStylesheet('wp emoji styles', false);
        $this->removeStylesheet('wp block library', false);
        $this->removeStylesheet('classic theme styles', false);
        $this->removeStylesheet('global styles', false);
    }

    public function initThemeStylesheetsDeferred()
    {
        $dir = dirname(get_template_directory_uri()) . '/dist';

        $this->addStylesheet(
            'fontawesome',
            $dir . '/vendor/@fortawesome/fontawesome-free/css/all.min.css',
            [],
            '6.6.0'
        );

        $this->addStylesheet('theme styles', $dir . '/css/main.css');
    }

    public function initThemeJavascripts()
    {
        $dir = dirname(get_template_directory_uri()) . '/dist';
    }

    private function addStylesheet($name, $path, $deps = [], $vers = '0.1.0')
    {
        $key = parent::formatLabel($name, '-');

        if (count($deps)) {
            for ($i = 0; $i < count($deps); $i++) {
                $deps[$i] = parent::formatLabel($deps[$i], '-');
            }
        }

        wp_register_style($key, $path, $deps, $vers);
        wp_enqueue_style($key);
    }

    private function addJavascript($name, $path, $deps = [], $vers = '0.1.0')
    {
        $key = parent::formatLabel($name, '-');

        if (count($deps)) {
            for ($i = 0; $i < count($deps); $i++) {
                $deps[$i] = parent::formatLabel($deps[$i], '-');
            }
        }

        wp_register_script($key, $path, $deps, $vers, true);
        wp_enqueue_script($key);
    }

    private function removeStylesheet($name, $prefix = true)
    {
        $key = parent::formatLabel($name, '-', $prefix);
        wp_deregister_style($key);
        wp_dequeue_style($key);
    }

    private function removeJavascript($name, $prefix = true)
    {
        $key = parent::formatLabel($name, '-', $prefix);
        wp_deregister_script($key);
        wp_dequeue_script($key);
    }
}

new FileEnqueueConfig();
