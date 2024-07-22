<?php
namespace dev;

class ExcerptConfig
{
    public function __construct()
    {
        add_filter('excerpt_length', [$this, 'initExcerptLength']);
        add_filter('excerpt_more', [$this, 'initExcerptLink']);
    }

    public function initExcerptLength($length)
    {
        return 30;
    }

    public function initExcerptLink($more)
    {
        global $post;

        return '...';
    }
}

new ExcerptConfig();
