<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['test_metabox'] = array(
		'id'         => 'test_metabox',
		'title'      => __( 'Test Metabox', 'cmb' ),
		'pages'      => array( 'location', ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name'    => __( 'Регион', 'wp_panda' ),
				'desc'    => __( 'В данном поле необходимо Выбрать регион (обязательно) ', 'wp_panda' ),
				'id'      => 'location_region',
				'type'    => 'select',
				'options' => array (
					'' => __('','wp_panda'),
					'1' =>__('Республика Адыгея','wp_panda'),
					'3' =>__('Республика Алтай','wp_panda'),
					'4' =>__('Алтайский край','wp_panda'),
					'5' =>__('Амурская область','wp_panda'),		
					'6' =>__('Архангельская область','wp_panda'),		
					'7' =>__('Астраханская область','wp_panda'),	
					'8' =>__('Республика Башкортостан ','wp_panda'),			
					'9' =>__('Белгородская область','wp_panda'),
					'10' =>__('Брянская область','wp_panda'),
					'11' =>__('Республика Бурятия','wp_panda'),			
					'13' =>__('Челябинская область','wp_panda'),		
					'14' =>__('Забайкальский край','wp_panda'),	
					'15' =>__('Чукотский автономный округ','wp_panda'),			
					'16' =>__('Чувашская Республика','wp_panda'),			
					'17' =>__('Республика Дагестан','wp_panda'),	
					'19' =>__('Республика Ингушетия','wp_panda'),		
					'20' =>__('Иркутская область','wp_panda'),			
					'21' =>__('Ивановская область','wp_panda'),		
					'22' =>__('Республика Кабардино-Балкария','wp_panda'),	
					'23' =>__('Калининградская область','wp_panda'),	
					'24' =>__('Республика Калмыкия','wp_panda'),	
					'25' =>__('Калужская область','wp_panda'),	
					'26' =>__('Камчатский край','wp_panda'),		
					'27' =>__('Республика Карачаево-Черкессия','wp_panda'),		
					'28' =>__('Республика Карелия','wp_panda'),	
					'29' =>__('Кемеровская область','wp_panda'),		
					'30' =>__('Хабаровский край','wp_panda'),
					'31' =>__('Республика Хакасия','wp_panda'),		
					'32' =>__('Ханты-Мансийский автономный округ','wp_panda'),			
					'33' =>__('Кировская область','wp_panda'),		
					'34' =>__('Республика Коми','wp_panda'),			
					'35' =>__('Пермский край','wp_panda'),		
					'36' =>__('Камчатский край','wp_panda'),			
					'37' =>__('Костромская область','wp_panda'),		
					'38' =>__('Краснодарский край','wp_panda'),		
					'39' =>__('Красноярский край','wp_panda'),			
					'40' =>__('Курганская область','wp_panda'),			
					'41' =>__('Курская область','wp_panda'),		
					'42' =>__('Санкт-Петербург','wp_panda'),				
					'43' =>__('Липецкая область','wp_panda'),			
					'44' =>__('Магаданская область','wp_panda'),		
					'45' =>__('Республика Марий Эл','wp_panda'),		
					'46' =>__('Республика Мордовия','wp_panda'),		
					'47' =>__('Московская область','wp_panda'),
					'48' =>__('Москва','wp_panda'),
					'49' =>__('Мурманская область','wp_panda'),			
					'50' =>__('Ненецкий автономный округ','wp_panda'),			
					'51' =>__('Нижегородская область','wp_panda'),		
					'52' =>__('Новгородская область','wp_panda'),	
					'53' =>__('Новосибирская область','wp_panda'),		
					'54' =>__('Омская область','wp_panda'),
					'55' =>__('Оренбургская область','wp_panda'),		
					'56' =>__('Орловская область','wp_panda'),	
					'57' =>__('Пензенская область','wp_panda'),		
					'58' =>__('Пермский край','wp_panda'),	
					'59' =>__('Приморский край','wp_panda'),			
					'60' =>__('Псковская область','wp_panda'),			
					'61' =>__('Ростовская область','wp_panda'),		
					'62' =>__('Рязанская область','wp_panda'),
					'63' =>__('Республика Саха','wp_panda'),	
					'64' =>__('Сахалинская область','wp_panda'),			
					'65' =>__('Самарская область','wp_panda'),			
					'66' =>__('Ленинградская область','wp_panda'),				
					'67' =>__('Саратовская область','wp_panda'),		
					'68' =>__('Республика Северная Осетия-Алания ','wp_panda'),			
					'69' =>__('Смоленская область','wp_panda'),		
					'70' =>__('Ставропольский край','wp_panda'),			
					'71' =>__('Свердловская область','wp_panda'),
					'72' =>__('Тамбовская область','wp_panda'),
					'73' =>__('Республика Татарстан','wp_panda'),		
					'74' =>__('Красноярский край','wp_panda'),		
					'75' =>__('Томская область','wp_panda'),		
					'76' =>__('Тульская область','wp_panda'),		
					'77' =>__('Тверская область','wp_panda'),		
					'78' =>__('Тюменская область','wp_panda'),			
					'79' =>__('Республика Тыва','wp_panda'),	
					'80' =>__('Республика Удмуртия','wp_panda'),		
					'81' =>__('Ульяновская область','wp_panda'),			
					'82' =>__('Иркутская область','wp_panda'),			
					'83' =>__('Владимирская область','wp_panda'),	
					'84' =>__('Волгоградская область','wp_panda'),
					'85' =>__('Вологодская область','wp_panda'),		
					'86' =>__('Воронежская область','wp_panda'),	
					'87' =>__('Ямало-Ненецкий автономный округ','wp_panda'),		
					'88' =>__('Ярославская область','wp_panda'),		
					'89' =>__('Еврейская автономная область','wp_panda'),			
					'90' =>__('Пермский край','wp_panda'),			
					'91' =>__('Красноярский край','wp_panda'),		
					'92' =>__('Красноярский край','wp_panda'),			
					'93' =>__('Забайкальский край','wp_panda'),			
					'CI' =>__('Республика  Чечня','wp_panda'),
				),
			),
			
			array(
				'name' => __( 'Город', 'wp_panda' ),
				'desc' => __( 'В данное поле необходимо Ввести Город (обязательно)', 'wp_panda'),
				'id'   => 'location_town',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			
			array(
				'name' => __( 'Индекс', 'wp_panda' ),
				'desc' => __( 'В данное поле необходимо Ввести Почтовый Индекс', 'wp_panda'),
				'id'   => 'location_postcode',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			
			array(
				'name' => __( 'Адрес', 'wp_panda'),
				'desc' => __( 'В данное поле необходимо Ввести Адрес', 'wp_panda'),
				'id'   => 'location_address',
				'type' => 'textarea_small',
			),
		),
	);
	
	$meta_boxes['event_side'] = array(
		'id'         => 'event_side',
		'title'      => __( 'Дата и время Мероприятия', 'wp_panda' ),
		'pages'      => array( 'event', ), // Post type
		'context'    => 'side',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'Дата начала', 'wp_panda' ),
				'desc' => __( 'Введите дану начала мероприятия', 'wp_panda' ),
				'id'   => 'event_start_date',
				'type' => 'text_date',
			),
			
			array(
				'name' => __( 'Дата окончания', 'wp_panda' ),
				'desc' => __( 'Введите дату окончания мероприятия', 'wp_panda' ),
				'id'   => 'event_end_date',
				'type' => 'text_date',
			),
			
			array(
				'name' => __( 'Время Начала', 'wp_panda' ),
				'desc' => __( 'Введите время начала мероприятия', 'wp_panda' ),
				'id'   => 'event_start_time',
				'type' => 'text_time',
			),

			array(
				'name' => __( 'Время Окончания', 'wp_panda' ),
				'desc' => __( 'Введите время окончания мероприятия', 'wp_panda' ),
				'id'   => 'event_end_time',
				'type' => 'text_time',
			),
			
			array(
				'name' => 'Весь День',
				'desc' => 'Отметте если это мероприятие проходит весь день',
				'id' => 'event_all_day',
				'type' => 'checkbox'
			),
			
		)
	);
	
	$meta_boxes['event_normal'] = array(
		'id'         => 'event_normal',
		'title'      => __( 'Место проведения Мероприятия', 'wp_panda' ),
		'pages'      => array( 'event', ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'Это мероприятие не имеет физического местоположения', 'wp_panda' ),
				'desc' => __( 'Отметить если Мероприятие не привязано к определенному месту', 'wp_panda' ),
				'id'   => 'no_location',
				'type' => 'checkbox',
			),
			
			 array(
                'name'    => 'Выбор Места',
                'desc'    => __('Выбрать место проведения мероприятия из выпадающего списка, если место в списке отсутствует <a target="_blank" href="' . get_home_url() .  '/wp-admin/post-new.php?post_type=location">добавьте его','wp_panda'),
                'id'      => 'location_name',
                'type'    => 'select',
                'options' => cmb_get_post_options( array( 'post_type' => 'location', 'numberposts' => -1) ),
            ),
		)
	);
		
	/**
	 * Metabox to be displayed on a single page ID
	 */
	/*$meta_boxes['about_page_metabox'] = array(
		'id'         => 'about_page_metabox',
		'title'      => __( 'About Page Metabox', 'cmb' ),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields'     => array(
			array(
				'name' => __( 'Test Text', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . '_about_test_text',
				'type' => 'text',
			),
		)
	);

	/**
	 * Repeatable Field Groups
	 */
	/*$meta_boxes['field_group'] = array(
		'id'         => 'field_group',
		'title'      => __( 'Repeating Field Group', 'cmb' ),
		'pages'      => array( 'page', ),
		'fields'     => array(
			array(
				'id'          => $prefix . 'repeat_group',
				'type'        => 'group',
				'description' => __( 'Generates reusable form entries', 'cmb' ),
				'options'     => array(
					'group_title'   => __( 'Entry {#}', 'cmb' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Entry', 'cmb' ),
					'remove_button' => __( 'Remove Entry', 'cmb' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(
					array(
						'name' => 'Entry Title',
						'id'   => 'title',
						'type' => 'text',
						// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
					),
					array(
						'name' => 'Description',
						'description' => 'Write a short description for this entry',
						'id'   => 'description',
						'type' => 'textarea_small',
					),
					array(
						'name' => 'Entry Image',
						'id'   => 'image',
						'type' => 'file',
					),
					array(
						'name' => 'Image Caption',
						'id'   => 'image_caption',
						'type' => 'text',
					),
				),
			),
		),
	);

	/**
	 * Metabox for the user profile screen
	 */
	/*$meta_boxes['user_edit'] = array(
		'id'         => 'user_edit',
		'title'      => __( 'User Profile Metabox', 'cmb' ),
		'pages'      => array( 'user' ), // Tells CMB to use user_meta vs post_meta
		'show_names' => true,
		'cmb_styles' => false, // Show cmb bundled styles.. not needed on user profile page
		'fields'     => array(
			array(
				'name'     => __( 'Extra Info', 'cmb' ),
				'desc'     => __( 'field description (optional)', 'cmb' ),
				'id'       => $prefix . 'exta_info',
				'type'     => 'title',
				'on_front' => false,
			),
			array(
				'name'    => __( 'Avatar', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'avatar',
				'type'    => 'file',
				'save_id' => true,
			),
			array(
				'name' => __( 'Facebook URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'facebookurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Twitter URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'twitterurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Google+ URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'googleplusurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Linkedin URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'linkedinurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'User Field', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'user_text_field',
				'type' => 'text',
			),
		)
	);

	/**
	 * Metabox for an options page. Will not be added automatically, but needs to be called with
	 * the `cmb_metabox_form` helper function. See wiki for more info.
	 */
	/*$meta_boxes['options_page'] = array(
		'id'      => 'options_page',
		'title'   => __( 'Theme Options Metabox', 'cmb' ),
		'show_on' => array( 'key' => 'options-page', 'value' => array( $prefix . 'theme_options', ), ),
		'fields'  => array(
			array(
				'name'    => __( 'Site Background Color', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'bg_color',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
		)
	); */

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}
