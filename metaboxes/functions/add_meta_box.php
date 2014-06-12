<?php
	
	function wds_get_ID_by_page_name($page_name)
	{
        global $wpdb;  
		$page_name = strip_tags($page_name);
		$page_name = addslashes($page_name);
		$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title ='".$page_name."'");
         return $page_name_id;
	}

	function get_region_select($x) {
	$out='';
		switch($x) {
			case 'text':
			case '1':
				$out = 'Республика Адыгея';
			break;
			case '3':
				$out = 'Республика Алтай';
			break;
			case '4':
				$out = 'Алтайский край';
			break;
			case '5':
				$out = 'Амурская область';
			break;
			case '6':
				$out = 'Архангельская область';
			break;
			case '7':
				$out = 'Астраханская область';
			break;
			case '8':
				$out = 'Республика Башкортостан';
			break;
			case '9':
				$out = 'Белгородская область';
			break;
			case '10':
				$out = 'Брянская область';
			break;
			case '11':
				$out = 'Республика Бурятия';
			break;
			case '13':
				$out = 'Челябинская область';
			break;
			case '14':
				$out = 'Забайкальский край';
			break;
			case '15':
				$out = 'Чукотский автономный округ';
			break;
			case '16':
				$out = 'Чувашская Республика';
			break;
			case '17':
				$out = 'Республика Дагестан';
			break;
			case '19':
				$out = 'Республика Ингушетия';
			break;
			case '20':
				$out = 'Иркутская область';
			break;
			case '21':
				$out = 'Ивановская область';
			break;
			case '22':
				$out = 'Республика Кабардино-Балкария';
			break;
			case '23':
				$out = 'Калининградская область';
			break;
			case '24':
				$out = 'Республика Калмыкия';
			break;
			case '25':
				$out = 'Калужская область';
			break;
			case '26':
				$out = 'Камчатский край';
			break;
			case '27':
				$out = 'Республика Карачаево-Черкессия';
			break;
			case '28':
				$out = 'Республика Карелия';
			break;
			case '29':
				$out = 'Кемеровская область';
			break;
			case '30':
				$out = 'Хабаровский край';
			break;
			case '31':
				$out = 'Республика Хакасия';
			break;
			case '32':
				$out = 'Ханты-Мансийский автономный округ';
			break;
			case '33':
				$out = 'Кировская область';
			break;
			case '34':
				$out = 'Республика Коми';
			break;
			case '35':
				$out = 'Пермский край';
			break;
			case '36':
				$out = 'Камчатский край';
			break;
			case '37':
				$out = 'Костромская область';
			break;
			case '38':
				$out = 'Краснодарский край';
			break;
			case '39':
				$out = 'Красноярский край';
			break;
			case '40':
				$out = 'Курганская область';
			break;
			case '41':
				$out = 'Курская область';
			break;
			case '42':
				$out = 'Ленинградская область';
			break;
			case '43':
				$out = 'Липецкая область';
			break;
			case '44':
				$out = 'Магаданская область';
			break;
			case '45':
				$out = 'Республика Марий Эл';
			break;
			case '46':
				$out = 'Республика Мордовия';
			break;
			case '47':
				$out = 'Московская область';
			break;
			case '48':
				$out = 'Московская область';
			break;
			case '49':
				$out = 'Мурманская область';
			break;
			case '50':
				$out = 'Ненецкий автономный округ';
			break;
			case '51':
				$out = 'Нижегородская область';
			break;
			case '52':
				$out = 'Новгородская область';
			break;
			case '53':
				$out = 'Новосибирская область';
			break;
			case '54':
				$out = 'Омская область';
			break;
			case '55':
				$out = 'Оренбургская область';
			break;
			case '56':
				$out = 'Орловская область';
			break;
			case '57':
				$out = 'Пензенская область';
			break;
			case '58':
				$out = 'Пермский край';
			break;
			case '59':
				$out = 'Приморский край';
			break;
			case '60':
				$out = 'Псковская область';
			break;
			case '61':
				$out = 'Ростовская область';
			break;
			case '62':
				$out = 'Рязанская область';
			break;
			case '63':
				$out = 'Республика Саха';
			break;
			case '64':
				$out = 'Сахалинская область';
			break;
			case '65':
				$out = 'Самарская область';
			break;
			case '66':
				$out = 'Ленинградская область';
			break;
			case '67':
				$out = 'Саратовская область';
			break;
			case '68':
				$out = 'Республика Северная Осетия-Алания';
			break;
			case '69':
				$out = 'Смоленская область';
			break;
			case '70':
				$out = 'Ставропольский край';
			break;
			case '71':
				$out = 'Свердловская область';
			break;
			case '72':
				$out = 'Тамбовская область';
			break;
			case '73':
				$out = 'Республика Татарстан';
			break;
			case '74':
				$out = 'Красноярский край';
			break;
			case '75':
				$out = 'Томская область';
			break;
			case '76':
				$out = 'Тульская область';
			break;
			case '77':
				$out = 'Тверская область';
			break;
			case '78':
				$out = 'Тюменская область';
			break;
			case '79':
				$out = 'Республика Тыва';
			break;
			case '80':
				$out = 'Республика Удмуртия';
			break;
			case '81':
				$out = 'Ульяновская область';
			break;
			case '82':
				$out = 'Иркутская область';
			break;
			case '83':
				$out = 'Владимирская область';
			break;
			case '84':
				$out = 'Волгоградская область';
			break;
			case '85':
				$out = 'Вологодская область';
			break;
			case '86':
				$out = 'Воронежская область';
			break;
			case '87':
				$out = 'Ямало-Ненецкий автономный округ';
			break;
			case '88':
				$out = 'Ярославская область';
			break;
			case '89':
				$out = 'Еврейская автономная область';
			break;
			case '90':
				$out = 'Пермский край';
			break;
			case '91':
				$out = 'Красноярский край';
			break;
			case '92':
				$out = 'Красноярский край';
			break;
			case '93':
				$out = 'Забайкальский край';
			break;
			case 'CI':
				$out = 'Республика  Чечня';
			break;
		}	
		return $out;
	}	
	
	// Add the Meta Box
	function add_custom_meta_box() 
	{
		add_meta_box( 'custom_meta_box','Custom Meta Box', 'show_custom_meta_box', 'location', 'normal','high');
	}
	add_action('add_meta_boxes', 'add_custom_meta_box');
	
	global $post;
	$type_post = get_post_type( $post->ID );
	if( $type_post = 'location') {
		$prefix = 'cr_event_';
		
		$custom_meta_fields = array(
		
			array(
				'label'	=> __('ttt','wp_panda'),
				'desc'	=>__('ttt','wp_panda'),
				'id' => $prefix . 'gmap',
				'type'	=> 'gmap'
			),
			
			array(
			'label'	=> __('Выбор региона','wp_panda'),
			'desc'	=>__('Данное поле предназначено для выбора региона предстоящего мероприятия','wp_panda'),
			'id'	=> $prefix . 'region',
			'type'	=> 'select',
			'options' => array (
				'none' => array('label'=>'Выберете Регион','value'=>'none'),
				'1' =>array('label'=>'Республика Адыгея','value'=>'1'),				
				'3' =>array('label'=>'Республика Алтай','value'=>'3'),				
				'4' =>array('label'=>'Алтайский край','value'=>'4'),				
				'5' =>array('label'=>'Амурская область','value'=>'5'),				
				'6' =>array('label'=>'Архангельская область','value'=>'6'),				
				'7' =>array('label'=>'Астраханская область','value'=>'7'),				
				'8' =>array('label'=>'Республика Башкортостан ','value'=>'8'),				
				'9' =>array('label'=>'Белгородская область','value'=>'9'),				
				'10' =>array('label'=>'Брянская область','value'=>'10'),				
				'11' =>array('label'=>'Республика Бурятия','value'=>'11'),				
				'13' =>array('label'=>'Челябинская область','value'=>'13'),				
				'14' =>array('label'=>'Забайкальский край','value'=>'14'),				
				'15' =>array('label'=>'Чукотский автономный округ','value'=>'15'),				
				'16' =>array('label'=>'Чувашская Республика','value'=>'16'),				
				'17' =>array('label'=>'Республика Дагестан','value'=>'17'),				
				'19' =>array('label'=>'Республика Ингушетия','value'=>'19'),				
				'20' =>array('label'=>'Иркутская область','value'=>'20'),				
				'21' =>array('label'=>'Ивановская область','value'=>'21'),				
				'22' =>array('label'=>'Республика Кабардино-Балкария','value'=>'22'),				
				'23' =>array('label'=>'Калининградская область','value'=>'23'),				
				'24' =>array('label'=>'Республика Калмыкия','value'=>'24'),				
				'25' =>array('label'=>'Калужская область','value'=>'25'),				
				'26' =>array('label'=>'Камчатский край','value'=>'26'),				
				'27' =>array('label'=>'Республика Карачаево-Черкессия','value'=>'27'),				
				'28' =>array('label'=>'Республика Карелия','value'=>'28'),				
				'29' =>array('label'=>'Кемеровская область','value'=>'29'),				
				'30' =>array('label'=>'Хабаровский край','value'=>'30'),				
				'31' =>array('label'=>'Республика Хакасия','value'=>'31'),				
				'32' =>array('label'=>'Ханты-Мансийский автономный округ','value'=>'32'),				
				'33' =>array('label'=>'Кировская область','value'=>'33'),				
				'34' =>array('label'=>'Республика Коми','value'=>'34'),				
				'35' =>array('label'=>'Пермский край','value'=>'35'),				
				'36' =>array('label'=>'Камчатский край','value'=>'36'),				
				'37' =>array('label'=>'Костромская область','value'=>'37'),				
				'38' =>array('label'=>'Краснодарский край','value'=>'38'),				
				'39' =>array('label'=>'Красноярский край','value'=>'39'),				
				'40' =>array('label'=>'Курганская область','value'=>'40'),				
				'41' =>array('label'=>'Курская область','value'=>'41'),				
				'42' =>array('label'=>'Ленинградская область','value'=>'42'),				
				'43' =>array('label'=>'Липецкая область','value'=>'43'),				
				'44' =>array('label'=>'Магаданская область','value'=>'44'),				
				'45' =>array('label'=>'Республика Марий Эл','value'=>'45'),				
				'46' =>array('label'=>'Республика Мордовия','value'=>'46'),				
				'47' =>array('label'=>'Московская область','value'=>'47'),				
				'48' =>array('label'=>'Московская область','value'=>'48'),				
				'49' =>array('label'=>'Мурманская область','value'=>'49'),				
				'50' =>array('label'=>'Ненецкий автономный округ','value'=>'50'),				
				'51' =>array('label'=>'Нижегородская область','value'=>'51'),				
				'52' =>array('label'=>'Новгородская область','value'=>'52'),				
				'53' =>array('label'=>'Новосибирская область','value'=>'53'),				
				'54' =>array('label'=>'Омская область','value'=>'54'),				
				'55' =>array('label'=>'Оренбургская область','value'=>'55'),				
				'56' =>array('label'=>'Орловская область','value'=>'56'),				
				'57' =>array('label'=>'Пензенская область','value'=>'57'),				
				'58' =>array('label'=>'Пермский край','value'=>'58'),				
				'59' =>array('label'=>'Приморский край','value'=>'59'),				
				'60' =>array('label'=>'Псковская область','value'=>'60'),				
				'61' =>array('label'=>'Ростовская область','value'=>'61'),				
				'62' =>array('label'=>'Рязанская область','value'=>'62'),				
				'63' =>array('label'=>'Республика Саха','value'=>'63'),				
				'64' =>array('label'=>'Сахалинская область','value'=>'64'),				
				'65' =>array('label'=>'Самарская область','value'=>'65'),				
				'66' =>array('label'=>'Ленинградская область','value'=>'66'),				
				'67' =>array('label'=>'Саратовская область','value'=>'67'),				
				'68' =>array('label'=>'Республика Северная Осетия-Алания ','value'=>'68'),				
				'69' =>array('label'=>'Смоленская область','value'=>'69'),				
				'70' =>array('label'=>'Ставропольский край','value'=>'70'),				
				'71' =>array('label'=>'Свердловская область','value'=>'71'),				
				'72' =>array('label'=>'Тамбовская область','value'=>'72'),				
				'73' =>array('label'=>'Республика Татарстан','value'=>'73'),				
				'74' =>array('label'=>'Красноярский край','value'=>'74'),				
				'75' =>array('label'=>'Томская область','value'=>'75'),				
				'76' =>array('label'=>'Тульская область','value'=>'76'),				
				'77' =>array('label'=>'Тверская область','value'=>'77'),				
				'78' =>array('label'=>'Тюменская область','value'=>'78'),				
				'79' =>array('label'=>'Республика Тыва','value'=>'79'),				
				'80' =>array('label'=>'Республика Удмуртия','value'=>'80'),				
				'81' =>array('label'=>'Ульяновская область','value'=>'81'),				
				'82' =>array('label'=>'Иркутская область','value'=>'82'),				
				'83' =>array('label'=>'Владимирская область','value'=>'83'),				
				'84' =>array('label'=>'Волгоградская область','value'=>'84'),				
				'85' =>array('label'=>'Вологодская область','value'=>'85'),				
				'86' =>array('label'=>'Воронежская область','value'=>'86'),				
				'87' =>array('label'=>'Ямало-Ненецкий автономный округ','value'=>'87'),				
				'88' =>array('label'=>'Ярославская область','value'=>'88'),				
				'89' =>array('label'=>'Еврейская автономная область','value'=>'89'),				
				'90' =>array('label'=>'Пермский край','value'=>'90'),				
				'91' =>array('label'=>'Красноярский край','value'=>'91'),				
				'92' =>array('label'=>'Красноярский край','value'=>'92'),				
				'93' =>array('label'=>'Забайкальский край','value'=>'93'),				
				'CI' =>array('label'=>'Республика  Чечня','value'=>'CI')
				)
			),
			
			array(
				'label'	=> __('Город / населенный пункт:','wp_panda'),
				'desc'	=> __('В данное поле введите название города или населенного пункта в котором пройдет предстоящее мероприятие','wp_panda'),
				'id'	=> $prefix.'city',
				'type'	=> 'text'
			),
			
			array(
				'label'	=> __('Почтовый индекс:','wp_panda'),
				'desc'	=> __('В данное поле введите почтовый индекс, места проведения мероприятия ( поле не обязательно для заполнения )','wp_panda'),
				'id'	=> $prefix.'post_code',
				'type'	=> 'text'
			),
			
			array(
				'label'	=> 'Адрес',
				'desc'	=> __('В данное поле введите адрес места проведения мероприятия, без региона и города (поле не обязательно к заполнению).','wp_panda'),
				'id'	=> $prefix.'adres',
				'type'	=> 'textarea'
			),
		);
	
	}
	
	function add_custom_meta_box2() 
	{
		add_meta_box( 'custom_meta_box', 'Custom Meta Box', 'show_custom_meta_box', 'event', 'normal', 'high');
	}
	add_action('add_meta_boxes', 'add_custom_meta_box2');
	
	$type_post = get_post_type( $post->ID );
	if( $type_post  = 'event' )  {
	
		$prefix = 'cr_event_';
		$custom_meta_fields = array(

			array(
				'label'	=> 'Post List',
				'desc'	=> 'A description for the field.',
				'id'	=>  $prefix.'post_id',
				'type'	=> 'post_list_map',
				'post_type' => array('location')
			),
		);
	}
	
	add_action('admin_head','add_custom_scripts');

	if(is_admin()) {
		function register_metabox_js() 
		{
			wp_enqueue_script('jquery-ui-datepicker');
			wp_enqueue_script('jquery-ui-slider');
			wp_enqueue_script('custom-js', ROOT.'/metaboxes/js/custom-js.js');
			wp_enqueue_style('jquery-ui-custom', ROOT.'/metaboxes/css/jquery-ui-custom.css');
		}
		add_action('init','register_metabox_js');
	}
	
	function add_custom_scripts() 
	{
		
		global $custom_meta_fields, $post;
		
		$output = '<script type="text/javascript">
			jQuery(function() {';
		
		foreach ($custom_meta_fields as $field) {
			if($field['type'] == 'date')
				$output .= 'jQuery(".datepicker").datepicker();';
			if ($field['type'] == 'slider') {
				$value = get_post_meta($post->ID, $field['id'], true);
				if ($value == '') $value = $field['min'];
				$output .= '
				jQuery( "#'.$field['id'].'-slider" ).slider({
				value: '.$value.',
				min: '.$field['min'].',
				max: '.$field['max'].',
				step: '.$field['step'].',
				slide: function( event, ui ) {
				jQuery( "#'.$field['id'].'" ).val( ui.value );
				}
				});';
			}
		}
		$output .= '});
		</script>';	
		echo $output;
	}
	
	// The Callback
	function show_custom_meta_box() {
		global $custom_meta_fields, $post;
		// Use nonce for verification
		echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
		
		// Begin the field table and loop
		echo '<table class="form-table">';
		foreach ($custom_meta_fields as $field) {
			// get value of this field if it exists for this post
			$meta = get_post_meta($post->ID, $field['id'], true);
			// begin a table row with
			echo '<tr>
			<th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
			<td>';
			switch($field['type']) {
				// text
				case 'text':
				echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
				<br /><span class="description">'.$field['desc'].'</span>';
				break;
				// textarea
				case 'textarea':
				echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
				<br /><span class="description">'.$field['desc'].'</span>';
				break;
				// select
				case 'select':
				echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
				}
				echo '</select><br /><span class="description">'.$field['desc'].'</span>';
				break;
				// radio
				case 'radio':
				foreach ( $field['options'] as $option ) {
					echo '<input type="radio" name="'.$field['id'].'" id="'.$option['value'].'" value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' />
					<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
				}
				echo '<span class="description">'.$field['desc'].'</span>';
				break;
				// tax_select
				case 'tax_select':
				echo '<select name="'.$field['id'].'" id="'.$field['id'].'">
				<option value="">Select One</option>'; // Select One
				$terms = get_terms($field['id'], 'get=all');
				$selected = wp_get_object_terms($post->ID, $field['id']);
				foreach ($terms as $term) {
					if (!empty($selected) && !strcmp($term->slug, $selected[0]->slug)) 
					echo '<option value="'.$term->slug.'" selected="selected">'.$term->name.'</option>'; 
					else
					echo '<option value="'.$term->slug.'">'.$term->name.'</option>'; 
				}
				$taxonomy = get_taxonomy($field['id']);
				echo '</select><br /><span class="description"><a href="'.get_bloginfo('home').'/wp-admin/edit-tags.php?taxonomy='.$field['id'].'">Manage '.$taxonomy->label.'</a></span>';
				break;
				// post_list
				case 'post_list':
				$items = get_posts( array (
				'post_type'	=> $field['post_type'],
				'posts_per_page' => -1
				));
				echo '<select name="'.$field['id'].'" id="'.$field['id'].'">
				<option value="">Select One</option>'; // Select One
				foreach($items as $item) {
					if(!empty( $item->post_title )) {
						echo '<option value="'.$item->ID.'"',$meta == $item->ID ? ' selected="selected"' : '','>'/*.$item->post_type.': '*/.$item->post_title.'</option>';
					}
				} // end foreach
				echo '</select><br /><span class="description">'.$field['desc'].'</span>';
				break;
				
				
				
				
				// post_list
				case 'post_list_map':
				$items = get_posts( array (
				'post_type'	=> $field['post_type'],
				'posts_per_page' => -1
				));
				echo '<select name="'.$field['id'].'" id="'.$field['id'].'">
				<option value="">Select One</option>'; // Select One
				foreach($items as $item) {
					if(!empty( $item->post_title )) {
						echo '<option value="'.$item->ID.'"',$meta == $item->ID ? ' selected="selected"' : '','>'/*.$item->post_type.': '*/.$item->post_title.'</option>';
					}
				} // end foreach
				echo '</select>';
				//<br /><span class="description">'.$field['desc'].'</span>';
				
				$location_id = $meta;
				echo '<div id="maps-' . $location_id . '" class="gmap3"></div>';
				
				wp_enqueue_script( 'gmap3' );
				$output = '<script type="text/javascript">
					(function($) {
						$(document).ready(function(){
							$("#maps-' . $location_id . '") .gmap3({';
							$x =  get_post_meta( $location_id, 'cr_event_region', 1 );
							$region = get_region_select($x);
								if( !empty ( $region ) ) {			
									$output .= 'marker: {
									address: "' . $region  . ', ' . get_post_meta( $location_id, 'cr_event_city',1 ) . ', ' . get_post_meta( $location_id, 'cr_event_adres', 1 ) .'",

									},'; 
								} 
								$output .= 'map: {
									options: {
									zoom: 14,
									}
								},
							});
						});
					})(jQuery);
				</script>';
				echo $output;
				break;
				
				
				// date
				case 'date':
				echo '<input type="text" class="datepicker" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
				<br /><span class="description">'.$field['desc'].'</span>';
				break;
				// slider
				case 'slider':
				$value = $meta != '' ? $meta : '0';
				echo '<div id="'.$field['id'].'-slider"></div>
				<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$value.'" size="5" />
				<br /><span class="description">'.$field['desc'].'</span>';
				break;
				// image
				case 'image':
				$image = get_template_directory_uri().'/images/image.png';	
				echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
				if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium');	$image = $image[0]; }				
				echo	'<input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
				<img src="'.$image.'" class="custom_preview_image" alt="" /><br />
				<input class="custom_upload_image_button button" type="button" value="Choose Image" />
				<small>&nbsp;<a href="#" class="custom_clear_image_button">Remove Image</a></small>
				<br clear="all" /><span class="description">'.$field['desc'].'</span>';
				break;
				// repeatable
				case 'repeatable':
				echo '<a class="repeatable-add button" href="#">+</a>
				<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
				$i = 0;
				if ($meta) {
					foreach($meta as $row) {
						echo '<li><span class="sort hndle">|||</span>
						<input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="'.$row.'" size="30" />
						<a class="repeatable-remove button" href="#">-</a></li>';
						$i++;
					}
					} else {
					echo '<li><span class="sort hndle">|||</span>
					<input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="" size="30" />
					<a class="repeatable-remove button" href="#">-</a></li>';
				}
				echo '</ul>
				<span class="description">'.$field['desc'].'</span>';
				break;
				
				case 'gmap':
				echo '<input type="hidden" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />';
				wp_enqueue_script( 'gmap3' );
				$output = '<script type="text/javascript">
					(function($) {
						$(document).ready(function(){
							$("#maps-' . $post->ID . '") .gmap3({';
							$x =  get_post_meta( $post->ID, 'cr_event_region', 1 );
							$region = get_region_select($x);
								if( !empty ( $region ) ) {			
									$output .= 'marker: {
									address: "' . $region  . ', ' . get_post_meta( $post->ID, 'cr_event_city',1 ) . ', ' . get_post_meta( $post->ID, 'cr_event_adres', 1 ) .'",

									},'; 
								} 
								$output .= 'map: {
									options: {
									zoom: 14,
									}
								},
							});
						});
					})(jQuery);
				</script>';
				echo $output;
				echo $region;
				echo'<div id="maps-' . $post->ID . '" name="' . $field['id'] . '" class="gmap3"></div>sssssssss';
				break;
				
			} //end switch
			echo '</td></tr>';
		} // end foreach
		echo '</table>'; // end table
	}
	
	function remove_taxonomy_boxes() {
		remove_meta_box('categorydiv', 'post', 'side');
	}
	add_action( 'admin_menu' , 'remove_taxonomy_boxes' );
	

	function save_custom_meta($post_id) {
		global $custom_meta_fields;
		

		if ( !isset( $_POST['custom_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['custom_meta_box_nonce'], basename(__FILE__) ) ) 
		return $post_id;

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;

		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id))
			return $post_id;
			} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		
		foreach ($custom_meta_fields as $field) {
			if($field['type'] == 'tax_select') continue;
			$old = get_post_meta($post_id, $field['id'], true);
			$new = $_POST[$field['id']];
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
				} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
		
		if( !empty( $_POST['category'] ) ) {
			$post = get_post($post_id);
			$category = $_POST['category'];
			wp_set_object_terms( $post_id, $category, 'category' );
		}
	}
	add_action('save_post', 'save_custom_meta');
	
?>