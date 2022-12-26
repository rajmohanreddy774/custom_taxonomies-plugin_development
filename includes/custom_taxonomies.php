<?php /**
 * Custom post types
 */
add_action('init', 'create_post_type');
function create_post_type()
{

	register_post_type(
		'operations',
		array(
			'labels' => array(
				'name' => __('Operations'),
				'singular_name' => __('Operation')
			),
			'public' => true,
			'has_archive' => true,
			//'hierarchial' => true,
			'supports' => array(
				'title',
				//'editor',
				'thumbnail',
				//'page-attributes'

			),
			'taxonomies' => array(
				'surgeons', 'assistants'
			),
		)
	);
};
// adding surgeon categories to the operations post
register_taxonomy(
	'surgeons',
	'operations',
	array(
		'labels' => array(
			'name' => __('Surgeons Categories'),
			'singular_name' => __('Surgeon Category')
		),
		'hierarchial' => true,
	)
);

//adding assistants categories to the operations post
register_taxonomy(
	'assistants',
	'operations',
	array(
		'labels' => array(
			'name' => __('Assitants Categories'),
			'singular_name' => __('Assistant Category')
		),
		'hierarchial' => true,
	)
);

//add new 'Ingredients' taxonomy to posts
register_taxonomy(
	'ingrediants',
	'post',
	array(
		'hierarchial' => false,
		'label' => 'Ingredients',
		'query_var' => true,
	)
);

//add new Ingredients to multiple post types

register_taxonomy(
	'ingrediants',
	array('post', 'operations'),
	array(
		'hierarchial' => false,
		'label' => 'Ingredients',
		'query_var' => true,
	)
);
