<?php 
function hwy_activate()
{
    // hwy_add_news_post_type();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'hwy_activate');
