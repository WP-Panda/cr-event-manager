<?php
/**
 * Plugin Name: CR_Evemts
 * Plugin URI: 
 * Description: Менеджер мероприятий
 * Version: 0.5.0
 * Author: Maksim (WP_Panda) Popov
 * Author URI: yoowordpress@yandex.ru
 * License: GPL2
 */

/**
 * Defining constants for later use
 */
 
 register_activation_hook( __FILE__, 'cr_event_activate' );
	register_deactivation_hook( __FILE__, 'cr_event_deactivate' );
	
	// действия при активации
	function cr_event_activate() {
		$dir_1 = $_SERVER['DOCUMENT_ROOT'] .'/wp-content/evens/';
		if (file_exists($dir_1)) mkdir($dir_1);
		$dir_2 = $_SERVER['DOCUMENT_ROOT'] .'/wp-content/evens/tmp_events/';
		if (file_exists($dir_2)) mkdir($dir_2);
	}
	
define( 'ROOT', plugins_url( '', __FILE__ ) );
define( 'DIRR', plugin_dir_path( __FILE__ ) . '/inc/' );
define( 'IMAGES', ROOT . '/img/' );
define( 'STYLES', ROOT . '/css/' );
define( 'SCRIPTS', ROOT . '/js/' );
define( 'TEMPLATE', plugin_dir_path( __FILE__ ) . '/inc/Themplate/' );

require_once 'taxonomies.php';
require_once 'inc/Custom-Metaboxes/example-functions.php';
require_once 'inc/maps-box.php';
require_once 'inc/BFI_Thumb.php';
require_once 'inc/functions.php';
require_once 'inc/anonses_filter.php';
require_once 'inc/icalclass.php';
//require_once 'Google/Client.php';
//21require_once 'google-api-php-client/src/Google_Client.php';
//require_once 'google-api-php-client/src/contrib/Google_CalendarService.php';
//require_once 'google-api-php-client/src/contrib/Google_CalendarService.php';

/**
 * Enqueueing scripts and styles in the admin
 * @param  int $hook Current page hook
 */
function uep_admin_script_style( $hook ) {
	global $post_type;
		wp_enqueue_script( 'upcoming-events', SCRIPTS . 'script.js', array( 'jquery', 'jquery-ui-datepicker' ), '1.0',	true );
		wp_enqueue_style( 'jquery-ui-calendar', STYLES . 'jquery-ui-1.10.4.custom.min.css', false, '1.10.4', 'all' );
		wp_register_script( 'google-maps', 'http://maps.googleapis.com/maps/api/js?sensor=false', array(), '1.0.0', true);
		wp_register_script( 'gmap3', SCRIPTS . 'gmap3.min.js', array( 'jquery' , 'google-maps' ), '6.0',	true );
}

add_action( 'admin_enqueue_scripts', 'uep_admin_script_style' );


function cr_backend_style() {
	wp_enqueue_style( 'cr-events-backend-style', STYLES . 'cr-events-backend-style.css', false, '1.0.0', 'all' );
}

add_action( 'admin_enqueue_scripts', 'cr_backend_style' );

function cr_frontend_style() {
	wp_register_script( 'google-maps', 'http://maps.googleapis.com/maps/api/js?sensor=false', array(), '1.0.0', true);
	wp_register_script( 'gmap3', SCRIPTS . 'gmap3.min.js', array( 'jquery' , 'google-maps' ), '6.0',	true );
	wp_register_script('cr-event-ajax', SCRIPTS . 'ajax.js', array(), '1.0.0', true);
	wp_enqueue_style( 'cr-events-frontend-style', STYLES . 'cr-events-frontend-style.css', false, '1.0.0', 'all' );
	wp_enqueue_script('cr-event-ajax');
		wp_localize_script('cr-event-ajax','EventAjax', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'security' => wp_create_nonce( 'cr-event-tabs-special-string' ),
	  ));
	}

add_action( 'wp_enqueue_scripts', 'cr_frontend_style' );

class options_page {
	function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}
	function admin_menu () {
		add_options_page( 'Cr Event','Cr Event','manage_options','cr_event_options', array( $this, 'settings_page' ) );
	}
	function  settings_page () { ?>
		<div class="wrap"><div id="icon-tools" class="icon32"></div>
		<?php cr_event_ical_fooll();?>
		<h2>Работа с файлами Календаря</h2>
		<p>Зайдя на эту страницу Вы уже обновили основной файл календаря для всех событий.</p>
		<button id='refresh'><?php _e('Обновить iCall файлы для Локаций','wp_panda'); ?></button><br>
		<button id='refresh-event'><?php _e('Обновить iCall файлы для Событий','wp_panda'); ?></button><br>
		<button id='delete'><?php _e('Удалить временные iCall файлы сформированные фильтрами, время когда вайл считается не действительным 3-е суток','wp_panda'); ?></button>
		<div id="respons"></div>
		<div class="loader"></div>
		</div>
	<?php }
}
new options_page;
/* admin ajax refresh ical event*/

// The JavaScript
function ajax_refresh_ical_javascript() {
  //Set Your Nonce
  $ajax_nonce = wp_create_nonce( "ical-special-string" );
?>

<script>
jQuery(document).ready(function($) {
 	$('button#refresh').click(function() {
  $('.loader').show();
  var data = {
    action: 'ajax_refresh_ical',
    security: '<?php echo $ajax_nonce; ?>',
  };
 
  // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
  $.post(ajaxurl, data, function(response) {
   	 $('.loader').hide();
   	 $('#respons').html(response);
  	});
  });

 $('button#refresh-event').click(function() {
  $('.loader').show();
  var data = {
    action: 'ajax_refresh_ical_event',
    security: '<?php echo $ajax_nonce; ?>',
  };
 
  // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
  $.post(ajaxurl, data, function(response) {
   	 $('.loader').hide();
   	 $('#respons').html(response);
  	});
  });

 $('button#delete').click(function() {
  $('.loader').show();
  var data = {
    action: 'ajax_clear_old_files',
    security: '<?php echo $ajax_nonce; ?>',
  };
 
  // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
  $.post(ajaxurl, data, function(response) {
   	 $('.loader').hide();
   	 $('#respons').html(response);
  	});
  });

});
</script>

<?php
}
add_action( 'admin_footer', 'ajax_refresh_ical_javascript' );
 
// The function that handles the AJAX request
function ajax_refresh_ical_callback() {
  check_ajax_referer( 'ical-special-string', 'security' );

  $args = array(
        'post_type' => 'location',
        'post_status'=>'publish',
        'showposts' => -1,               
        );

	$query = new WP_Query($args);?>

	<?php if ($query-> have_posts() ) : ?>
	<ul>
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
	<li><?php _e('Обновлен файл для локации - ','wp_panda');  the_title(); ?></li>
	<?php cr_event_ical_in_location(); ?>
	<?php endwhile;?>
	<ul>
	<?php endif;

  die(); // this is required to return a proper result
}
add_action( 'wp_ajax_ajax_refresh_ical', 'ajax_refresh_ical_callback' );

/* admin ajax refresh ical location*/

// The function that handles the AJAX request
function ajax_refresh_ical_event_callback() {
  check_ajax_referer( 'ical-special-string', 'security' );

  $args = array(
        'post_type' => 'event',
        'post_status'=>'publish',
        'showposts' => -1, 
        'orderby' =>'id', 
        'order'=>'DESC'               
        );

	$query = new WP_Query($args);?>

	<?php if ($query-> have_posts() ) : $n=1; ?>
	<ul>
	<?php while ( $query->have_posts() ) : $query->the_post();$n++ ?>
	<li><?php _e('Обновлен файл cобытия - ','wp_panda');  the_title(); ?></li>
	<?php cr_save_events_in_posts_save(); 
  $start = event_start_unix();
  $end = event_end_unix();
  $town = this_town();
  $region = this_region();
  $id = get_the_id();
            update_post_meta($id, 'unix_date_start', $start);
            update_post_meta($id, 'unix_date_end', $end);
            update_post_meta($id, 'event_region', $region);
            update_post_meta($id, 'event_town', $town);
            echo $town .'      '. $id. '      '.  $region;

	 endwhile;?>
	<ul>
		<?php echo  $n; ?>
	<?php endif;

  die(); // this is required to return a proper result
}
add_action( 'wp_ajax_ajax_refresh_ical_event', 'ajax_refresh_ical_event_callback' );




function ajax_clear_old_files_callback()
{
	check_ajax_referer( 'ical-special-string', 'security' );
    
   $expire_time = 259200; // Время через которое файл считается устаревшим (в сек.)
  //$expire_time = 2400; // Время через которое файл считается устаревшим (в сек.)
    
    $dir = $_SERVER['DOCUMENT_ROOT'] ."/wp-content/evens/tmp_filtred/";
    // проверяем, что $dir - каталог
    if (is_dir($dir)) {
        // открываем каталог
        if ($dh = opendir($dir)) {
            // читаем и выводим все элементы
            // от первого до последнего
            while (($file = readdir($dh)) !== false) {
                
                // текущее время
                $time_sec  = time();
                // время изменения файла
                $time_file = filemtime($dir . $file);
                // тепрь узнаем сколько прошло времени (в секундах)
                $time      = $time_sec - $time_file;
                
                $unlink = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/evens/tmp_filtred/' . $file;
                
                if (is_file($unlink)) {
                    if ($time > $expire_time) {
                        
                        if (unlink($unlink)) {
                            
                            echo 'Файл ' . $file . ' удален<br>';
                            
                        } else {
                            
                            echo 'Ошибка при удалении файла' . $file .'<br>';
                            
                        }
                    }
                    
                }
            }
            // закрываем каталог
            closedir($dh);
        }
    }
    
}

add_action( 'wp_ajax_ajax_clear_old_files', 'ajax_clear_old_files_callback' );


/**
 * Gets a number of posts and displays them as options
 * @param  array $query_args Optional. Overrides defaults.
 * @return array             An array of options that matches the CMB options array
 */
function cmb_get_post_options( $query_args ) {

    $args = wp_parse_args( $query_args, array(
        'post_type' => 'location',
        'numberposts' => -1,
    ) );

    $posts = get_posts( $args );

    $post_options = array();
    if ( $posts ) {
        foreach ( $posts as $post ) {
                   $post_options[] = array(
                       'name' => $post->post_title,
                       'value' => $post->ID
                   );
        }
    }

    return $post_options;
}