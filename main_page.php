<?php
/*
Plugin Name: shortcode test
Description: sample plugin for shortcode test practice
Version: 1.0
Author: Raj
*/

register_activation_hook(__FILE__, 'hwy_activate');

require_once dirname(__FILE__) . '/includes/shortcode.php';
require_once dirname(__FILE__) . '/includes/metabox.php';
require_once dirname(__FILE__) . '/includes/queryingpost.php';
require_once dirname(__FILE__) . '/includes/filter_action.php';
require_once dirname(__FILE__) . '/includes/custom_taxonomies.php';


//function to add content to the existing post
function hwy_handle_test_shortcode($atts, $content = '')
{
    $atts = shortcode_atts(array('color' => '#0a0a0a',), $atts);
    ob_start();
?>
    <div class="test">
        <h2><?php echo $content; ?>(<?php echo get_the_ID() ?>)</h2>
        <span style="color:<?php echo $atts['color'] ?>">Testing</span>
    </div>

<?php
    return ob_get_clean();
}

add_shortcode('my-test-shortcode', 'hwy_handle_test_shortcode');

//function to add content at the bottom of the existing content
function hwy_add_content_at_bottom($content)
{
    global $post;
    $post->post_title;
    return $content . '<p>MY CONTENT AT THE BOTTOM</p>';
}

add_filter('the_content', 'hwy_add_content_at_bottom');

//action to exclude uncategorized posts
function hwy_exclude_uncategorized_posts($query)
{
    if ($query->is_home() && $query->is_main_query()) {
        $query->set('cat', '-1');
    }
}

add_action('pre_get_posts', 'hwy_exclude_uncatergorized_posts');

// filter to inject a page advertisement
function hwy_inject_advertisement($posts)
{
    $ad_page = get_page_by_title('Advertisement');
    array_splice($posts, 1, 0, array($ad_page));
    var_dump($ad_page);
    return $posts;
}

add_filter('the_posts', 'hwy_inject_advertisement');

function hwy_add_news_meta_box()
{
    add_meta_box('news_meta_box', 'News Location', 'hwy_render_ops_location_meta_box', 'operation', 'normal');
}

add_action('add_meta_boxes_news', 'hwy_add_news_meta_box');

function hwy_render_ops_location_meta_box($post)
{
}
//adding location content to the post operations only
function hwy_add_news_location_to_content($content)
{
    if (is_singular('operations'))
        $content = '<p class="news-location">Toronta,Cardio</p>' . $content;
    return $content;
}

add_filter('the_content', 'hwy_add_news_location_to_content');
