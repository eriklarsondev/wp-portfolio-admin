<?php
namespace dev;

class CustomPostTypeConfig extends Base
{
    public function __construct()
    {
        add_action('init', [$this, 'initCustomPostTypes']);
    }

    public function initCustomPostTypes()
    {
        $this->addPostType(
            'content block',
            (object) [
                'icon' => 'editor aligncenter',
                'features' => 'title, editor',
            ]
        );

        $this->addPostType(
            'experience',
            (object) [
                'collection' => 'experience',
                'icon' => 'businessman',
                'features' => 'title, editor, custom fields',
            ]
        );

        $this->addPostType(
            'project',
            (object) [
                'icon' => 'laptop',
                'features' => 'thumbnail, title, editor, custom fields',
            ]
        );

        $this->addPostType(
            'tech',
            (object) [
                'collection' => 'technologies',
                'icon' => 'editor code',
                'features' => 'title, custom fields',
            ]
        );
    }

    private function addPostType($post_type, $config)
    {
        $key = parent::formatLabel($post_type);

        $args = [
            'can_export' => true,
            'capability_type' => 'post',
            'delete_with_user' => false,
            'description' => isset($config->description) ? $config->description : null,
            'exclude_from_search' => true,
            'has_archive' => false,
            'hierarchical' => false,
            'labels' => $this->getPostLabels(
                $post_type,
                isset($config->collection) ? $config->collection : null
            ),
            'menu_icon' => isset($config->icon)
                ? parent::formatLabel('dashicons-' . $config->icon, '-', false)
                : 'dashicons-admin-plugins',
            'menu_position' => isset($config->order) ? (int) $config->order : null,
            'public' => true,
            'publicly_queryable' => true,
            'query_var' => $key,
            'rest_base' => isset($config->collection)
                ? parent::formatLabel($config->collection, '-', false)
                : parent::formatLabel($post_type . 's', '-', false),
            'rest_namespace' => 'collections',
            'rewrite' => isset($config->collection)
                ? ['slug' => '/collections/' . parent::formatLabel($config->collection, '-', false)]
                : ['slug' => '/collections/' . parent::formatLabel($post_type . 's', '-', false)],
            'show_in_admin_bar' => false,
            'show_in_menu' => true,
            'show_in_nav_menus' => false,
            'show_in_rest' => true,
            'show_ui' => true,
            'supports' => isset($config->features)
                ? $this->getPostFeatures($config->features)
                : $this->getPostFeatures(),
            'taxonomies' =>
                isset($config->categories) && (bool) $config->categories === true
                    ? ['category']
                    : [],
        ];

        register_post_type($key, $args);
    }

    private function removePostType($post_type)
    {
        $key = parent::formatLabel($post_type);
        unregister_post_type($key);
    }

    private function getPostLabels($post_type, $collection = '')
    {
        if (!$collection) {
            $collection = $post_type . 's';
        }
        return ['name' => ucwords($collection), 'singular' => ucwords($post_type)];
    }

    private function getPostFeatures($features = '')
    {
        $supported = [];

        if ($features) {
            $data = explode(',', $features);
            foreach ($data as $feature) {
                array_push($supported, parent::formatLabel($feature, '-', false));
            }
        } else {
            $supported = [
                'title',
                'editor',
                'comments',
                'revisions',
                'trackbacks',
                'author',
                'excerpt',
                'page-attributes',
                'thumbnail',
                'custom-fields',
                'post-formats',
            ];
        }
        return $supported;
    }
}

new CustomPostTypeConfig();
