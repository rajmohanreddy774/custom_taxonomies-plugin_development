<?php
//function querying posts
function add_location_to_content($content)
{
    if (is_singular()) {
        $args = array(
            'numberposts' => 2
        );
        $latest_posts = get_posts($args);
        ob_start();
?>
        <ul class="latest-posts">
            <?php foreach ($latest_posts as $post); ?>
            <?php setup_postdata($post); ?>
            <li><a href="<?php echo get_the_permalink(); ?>"><?php echo the_title();  ?></li>
        </ul>
<?php
        $content .= ob_get_clean();
        wp_reset_postdata();
    }
    return $content;
}


add_filter('the_content', 'add_location_to_content');
