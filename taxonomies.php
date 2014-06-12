<?php 
	// Register Custom Post Type
function cr_events_manager() {
	
	//Мероприятия
	$labels = array(
		'name'                => _x( 'Мероприятия', 'Post Type General Name', 'wp_panda' ),
		'singular_name'       => _x( 'Мероприятие', 'Post Type Singular Name', 'wp_panda' ),
		'menu_name'           => __( 'Мероприятия', 'wp_panda' ),
		'parent_item_colon'   => __( 'Родительское Мероприятие', 'wp_panda' ),
		'all_items'           => __( 'Все Мероприятия', 'wp_panda' ),
		'view_item'           => __( 'Просмотреть Мероприятие', 'wp_panda' ),
		'add_new_item'        => __( 'Добавить новое Мероприятие', 'wp_panda' ),
		'add_new'             => __( 'Добавить новое', 'wp_panda' ),
		'edit_item'           => __( 'Редактировать Мероприятие', 'wp_panda' ),
		'update_item'         => __( 'Обновить Мероприятие', 'wp_panda' ),
		'search_items'        => __( 'Найти Мероприятие', 'wp_panda' ),
		'not_found'           => __( 'Мероприятие не найдено', 'wp_panda' ),
		'not_found_in_trash'  => __( 'Не найдено ни одного Мероприятия в корзине', 'wp_panda' ),
	);
	
	$args = array(
		'label'               => __( 'event', 'wp_panda' ),
		'description'         => __( 'Список предстоящих Мероприятий', 'wp_panda' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail','comments','custom-fields' ),
		'taxonomies'          => array( 'event-categories' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => IMAGES.'/pand.svg',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'event', $args );
	
	//Места
	
	$labels = array(
		'name'                => _x( 'Места', 'Post Type General Name', 'wp_panda' ),
		'singular_name'       => _x( 'Место', 'Post Type Singular Name', 'wp_panda' ),
		'menu_name'           => __( 'Места', 'wp_panda' ),
		'parent_item_colon'   => __( 'Родительское Место', 'wp_panda' ),
		'all_items'           => __( 'Все Места', 'wp_panda' ),
		'view_item'           => __( 'Просмотреть Место', 'wp_panda' ),
		'add_new_item'        => __( 'Добавить новое Место', 'wp_panda' ),
		'add_new'             => __( 'Добавить новое', 'wp_panda' ),
		'edit_item'           => __( 'Редактировать Место', 'wp_panda' ),
		'update_item'         => __( 'Обновить Место', 'wp_panda' ),
		'search_items'        => __( 'Найти Место', 'wp_panda' ),
		'not_found'           => __( 'Место не найдено', 'wp_panda' ),
		'not_found_in_trash'  => __( 'Не найдено ни одного Места в корзине', 'wp_panda' ),
	);
	$args = array(
		'label'               => __( 'location', 'wp_panda' ),
		'description'         => __( 'Список Мест', 'wp_panda' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail','custom-fields' ),
		//'taxonomies'          => array( 'event-categories' ),
		//'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        =>false,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		//'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'location', $args );

}

// Hook into the 'init' action
add_action( 'init', 'cr_events_manager', 0 );


// Категории Мероприятий
function event_categories() {

	$labels = array(
		'name'                       => _x( 'Категория Мероприятий', 'Taxonomy General Name', 'wp_panda' ),
		'singular_name'              => _x( 'Категории Мероприятий', 'Taxonomy Singular Name', 'wp_panda' ),
		'menu_name'                  => __( 'Категории мероприятий', 'wp_panda' ),
		'all_items'                  => __( 'Категории мероприятий', 'wp_panda' ),
		'parent_item'                => __( 'Родительская категория мероприятий', 'wp_panda' ),
		'parent_item_colon'          => __( 'Родительская категория мероприятий:', 'wp_panda' ),
		'new_item_name'              => __( 'Новая Категория Мероприятий', 'wp_panda' ),
		'add_new_item'               => __( 'Добавить Категорию Мероприятий', 'wp_panda' ),
		'edit_item'                  => __( 'Редактировать Категорию Мероприятий', 'wp_panda' ),
		'update_item'                => __( 'Обновить Категорию Мероприятий', 'wp_panda' ),
		'separate_items_with_commas' => __( 'Разделяйте отдельные категории запятыми', 'wp_panda' ),
		'search_items'               => __( 'Найти Категорию Мероприятий', 'wp_panda' ),
		'add_or_remove_items'        => __( 'Добавить или удалить Добавить Категорию Мероприятий', 'wp_panda' ),
		'choose_from_most_used'      => __( 'Выберете Популярные Категории Мероприятий', 'wp_panda' ),
		'not_found'                  => __( 'Не найдено', 'wp_panda' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'event-categories', array( 'event'/*, 'location'*/ ), $args );

// Hook into the 'init' action
	$labels = array(
		'name'                       => _x( 'Темы Мероприятий', 'Taxonomy General Name', 'wp_panda' ),
		'singular_name'              => _x( 'Тема Мероприятия', 'Taxonomy Singular Name', 'wp_panda' ),
		'menu_name'                  => __( 'Темы мероприятий', 'wp_panda' ),
		'all_items'                  => __( 'Темы мероприятий', 'wp_panda' ),
		'new_item_name'              => __( 'Новая Тема Мероприятия', 'wp_panda' ),
		'add_new_item'               => __( 'Добавить Тему Мероприятия', 'wp_panda' ),
		'edit_item'                  => __( 'Редактировать Тему Мероприятия', 'wp_panda' ),
		'update_item'                => __( 'Обновить Тему Мероприятия', 'wp_panda' ),
		'separate_items_with_commas' => __( 'Разделяйте отдельные темы запятыми', 'wp_panda' ),
		'search_items'               => __( 'Найти Тему Мероприятия', 'wp_panda' ),
		'add_or_remove_items'        => __( 'Добавить или удалить  Тему Мероприятия', 'wp_panda' ),
		'choose_from_most_used'      => __( 'Выберете Популярные Темы Мероприятий', 'wp_panda' ),
		'not_found'                  => __( 'Не найдено', 'wp_panda' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	


register_taxonomy( 'event-tag', array( 'event'/*, 'location'*/ ), $args );

}

add_action('init','event_categories',0);


add_action( 'admin_menu', 'сr_add_submenu_pages' );


function сr_add_submenu_pages() {
	add_submenu_page('edit.php?post_type=event',__('Места','wp_panda'), __('Места','wp_panda'), 'manage_options','edit.php?post_type=location');
}

/////////////////////
function creat_categories() {
		$catsarr = array(
			array(
				'cat_name' => 'Пресс-мероприятия',
				'category_nicename' => 'event',
			),
			array(
				'cat_name' => 'Cобытия',
				'category_nicename' => 'developments',
			),
			array(
				'cat_name' => 'Выставки',
				'category_nicename' => 'exhibitions',
			),
			array(
				'cat_name' => 'Концерты ',
				'category_nicename' => 'concerts',
			),
			array(
				'cat_name' => 'Визиты',
				'category_nicename' => 'visits',
			)
		);
		
		foreach( $catsarr as $key) {
			$slug_exists = (bool) get_terms( get_taxonomies(), array( 'slug' => $key['category_nicename'] ) );
			if (!$slug_exists)  wp_insert_term( $key['cat_name'], 'event-categories', array( 'slug'=>sanitize_title( $key['category_nicename'] ) ));
		}
}


add_action('init','creat_categories',0);
/*----------------------------------------------------------------------------*/
/*Include custom template
/*----------------------------------------------------------------------------*/

add_filter( 'template_include','include_region_template_function', 1 );

function include_region_template_function( $template_path ){

	if ( is_single() && get_post_type() == 'location' )
	{
		if ( ! locate_template('single-locaton.php', false) )
		{
			$template_path = TEMPLATE . 'locaton.php';
		}
	}
	
	if ( is_single() && get_post_type() == 'event' )
	{
		if ( ! locate_template('single-event.php', false) )
		{
			$template_path = TEMPLATE . 'event.php';
		}
	}
	
	/*elseif ( is_tax('region') )
	{
		if ( ! locate_template('taxonomy-region.php', false) )
		{
			$template_path = CR_ORGANIZATION_CATALOG_DIR . 'templates/taxonomy-region.php';
		}
	}
	elseif ( is_post_type_archive( 'organization' ) )
	{
		if ( ! locate_template('archive-organization.php', false) ) {
			$template_path = CR_ORGANIZATION_CATALOG_DIR . 'templates/archive-organization.php';
		}
	}
	elseif ( is_tag() )
	{
		//if ( ! locate_template('archive-organization.php', false) ) {
		$template_path = CR_ORGANIZATION_CATALOG_DIR . 'templates/tag.php';
		//}
	}
	elseif( is_search() )
	{
		$template_path = CR_ORGANIZATION_CATALOG_DIR . 'templates/search.php';
	}*/

	return $template_path;

}