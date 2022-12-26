<?php
function hwy_add_venue_disclainer()
{
?>
    <div class="disclaimer">
        Note: this venue is subject to change.
    </div>
<?php
}
add_action('tribe_events_single_meta_venue_section_end', 'hwy_add_venue_disclaimer');
?>
<?php
//add_action using class
class HWY_Plugin
{
    function __construct()
    {
        add_action('hwy_template_end', array($this, 'hwy_add_additional_content'));
    }
    function hwy_add_additional_content()
    {
        echo 'additional content using add action';
    }
}
$my_plugin = new HWY_Plugin();
add_action('hwy_template_end', array($my_plugin, 'hwy_add_additional_content')) ?>
<div id="template">
    <?php do_action('hwy_template_start'); ?>
    <h2>Heading</h2>
    <p>Content</p>
    <?php do_action('hwy_template_end'); ?>
</div>
<?php
// adding filter to manuplate the array
function hwy_change_my_array($value)
{
    $value['fourth'] = 4;
    return $value;
}
add_filter('hwy_my_array', 'hwy_change_my_array');
function hwy_change_my_array_again($value)
{
    $value['five'] = 5;
    return $value;
}
add_filter('hwy_my_array', 'hwy_change_my_array_again', 5);
$my_array = apply_filters('hwy_my_array', array('first' => 1, 'second' => 2, 'third' => 3));
var_dump($my_array);
die();
?>