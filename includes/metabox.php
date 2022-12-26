<?php
//creating custom metabox 
add_action("admin_init", "custom_metabox");

function custom_metabox()
{
    add_meta_box("custom_metabox_01", "Custom Metabox", "custom_metabox_field", "post", "normal", "low");
}
// function to input the metadata
function custom_metabox_field()
{
    global $post;
    $data = get_post_custom($post->ID);
    $val = isset($data['custom_input']) ? esc_attr($data['custom_input'][0]) : 'no value';
    echo '<input type="text" name="custom_input" id="custom_input" value="' . $val . '"/>';
}

add_action("save_post", "save_details");

//function to update metadata
function save_details()
{
    global $post;
    if (define('DOING_AUTOSAVE', "") && DOING_AUTOSAVE) {
        return $post->ID;
    }
    update_post_meta($post->ID, "custom_input", $_POST["custom_input"]);
}
