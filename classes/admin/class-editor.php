<?php
namespace dev;

class EditorConfig extends Base
{
    private static $disabled_wysiwyg = [];

    public function __construct()
    {
        // disable gutenberg editor
        add_filter('use_block_editor_for_post', '__return_false');

        add_filter('user_can_richedit', [$this, 'disableVisualEditor']);
    }

    public function disableVisualEditor($enabled)
    {
        global $post;

        if (in_array($post->post_type, $this->getDisabledEditorList())) {
            return false;
        }
        return $enabled;
    }

    private function getDisabledEditorList()
    {
        $blacklist = [];

        foreach (self::$disabled_wysiwyg as $post_type) {
            array_push($blacklist, parent::formatLabel($post_type));
        }
        return $blacklist;
    }
}

new EditorConfig();
