<?php

function register_session(){
    if( !session_id() )
        session_start();
}
add_action('init','register_session');
/*----------------------------------------------------------------------------*/
/*  Активация шорткодов в тексовом виджете
/*----------------------------------------------------------------------------*/

add_filter('widget_text', 'do_shortcode');

/*----------------------------------------------------------------------------*/
/* Селект и чекбоксы произвольные поля
/*----------------------------------------------------------------------------*/
function get_meta_values($key = '', $types = '', $tax = '', $type = 'location', $status = 'publish')
{
    global $wpdb;
    if (empty($key))
        return;
    $r = $wpdb->get_col($wpdb->prepare("
        SELECT pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s'
        AND p.post_status = '%s'
        AND p.post_type = '%s'
        ORDER BY meta_value ASC
    ", $key, $status, $type));
    
    foreach ($r as $re) $trim[] = trim($re);
    $results = array_unique($trim);
    $out     = '';
    $ww      = 0;
    foreach ($results as $result) {
        if (empty($types) || $types == 'select') {
            if($types  ==  'select')  {
                $label = $result; 
            } else {
                $label = get_region_select($result);
            }
            $out .= "<option value= '" . $result . "' >" . $label . '</option>';
        } elseif ($types == 'checkbox') {
            if (!empty($tax)) {
                $label = get_region_select($result);
            } else {
                $label = $result;
            }
            $out .= "<li><input type='checkbox' name='" . $key . "[]'  value= '" . $result . "'><a href='". home_url() . "/selected?".$key."=".$result."' title='" . $label . "'>" . $label . "</a></li>";
        }
        $ww++;
    }
    
    return $out;
}

/*----------------------------------------------------------------------------*/
/*  Поворот даты
/*----------------------------------------------------------------------------*/

function data_convert($date)
{
    $dt       = explode('/', $date);
    $date_new = $dt[2] . '-' . $dt[1] . '-' . $dt[0];
    return $date_new;
}

function data_convert_ical($date)
{
    $dt       = explode('/', $date);
    $date_new = $dt[0] . '-' . $dt[1] . '-' . $dt[2];
    return $date_new;
}

function data_convert_google($date)
{
    $dt       = explode('/', $date);
    $date_new = $dt[2] . $dt[1] . $dt[0];
    return $date_new;
}

/*----------------------------------------------------------------------------*/
/* конвертация даты в UNIX
/*----------------------------------------------------------------------------*/

function data_convert_unix($date)
{
    $dt           = explode('/', $date);
    $date_new     = $dt[2] . '-' . $dt[1] . '-' . $dt[0];
    $date_convert = strtotime($date_new . ' 00:00:00'); // начало UNIX
    return $date_convert;
    
}

/*----------------------------------------------------------------------------*/
/* что идет сейчас
/*----------------------------------------------------------------------------*/

function cr_event_now()
{
    global $post;
    $start_time      = get_post_meta($post->ID, 'event_start_time', 1); // время начала
    $end_time        = get_post_meta($post->ID, 'event_end_time', 1); //время конца
    $start_date      = get_post_meta($post->ID, 'event_start_date', 1); //дата начала
    $end_date        = get_post_meta($post->ID, 'event_end_date', 1); //дата конца
    $start_date_conv = data_convert($start_date); //переворивает дату начала
    $end_date_conv   = data_convert($end_date); //переворивает дату конца
    $start_event     = strtotime($start_date_conv . ' ' . $start_time . ':00'); // начало UNIX
    $end_event       = strtotime($end_date_conv . ' ' . $end_time . ':00'); //конец UNIX
    $time            = time(); //текущее время
    
    if ($end_event < $time) {
        $out .= "<span class='past-event'>Прошло</span>";
    } elseif ($start_event <= $time && $time <= $end_event) {
        $out .= "<span class='now-event'>Проходит</span>";
    } elseif ($start_event > $time) {
        $out .= "<span class='next-event'>Предстоит</span>";
    }
    
    return $out;
}


function event_start_unix(){
    global $post;
    $start_time      = get_post_meta($post->ID, 'event_start_time', 1); // время начала
    $start_date      = get_post_meta($post->ID, 'event_start_date', 1); //дата начала
    $start_date_conv = data_convert($start_date); //переворивает дату начала
    $start_event     = strtotime($start_date_conv . ' ' . $start_time . ':00'); // начало UNIX  
    return $start_event;
}

function event_end_unix(){
    global $post;
    $end_time      = get_post_meta($post->ID, 'event_end_time', 1); // время начала
    $end_date      = get_post_meta($post->ID, 'event_end_date', 1); //дата начала
    $end_date_conv = data_convert($end_date); //переворивает дату начала
    $end_event     = strtotime($end_date_conv . ' ' . $end_time . ':00'); // начало UNIX  
    return $end_event;
}

function this_town(){
    global $post;
    $location_id  = get_post_meta($post->ID, 'location_name', 1);
    $event_town = get_post_meta($location_id, 'location_town', true);
    return  $event_town;
};

function this_region(){
    global $post;
    $location_id  = get_post_meta($post->ID, 'location_name', 1);
    $event_region = get_post_meta($location_id, 'location_region', true);
    return  $event_region;
};


/*----------------------------------------------------------------------------*/
/* Мероприятия на сегодня
/*----------------------------------------------------------------------------*/

if (!function_exists('cr_todays_events')) {
    function cr_todays_events()
    {
        if( $_COOKIE['regions'] ) {
            $region_id = $_COOKIE['regions'];
        } else {
            $ip_array  = get_conwert_ip_too_region();
            $region_id = $ip_array['region_id'];
        }

        global $post;
        $day_start = mktime(0, 0, 0);
        $day_end   = mktime(0, 0, 0, date('n'), date('j') + 1);
        
        strtotime('tomorrow');
        $args = array(
            'post_type' => 'event',
            'post_status' => 'publish',
            'showposts' => -1,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'unix_date_start',
                    'value' => $day_end,
                    'type' => 'NUMERIC',
                    'compare' => '<='
                ),
                array(
                    'key' => 'unix_date_end',
                    'value' => $day_start,
                    'type' => 'NUMERIC',
                    'compare' => '>='
                )
            )
        );
        
        //if (!empty($ip_array['region_id'])) {
            $args['meta_query'][2] = array(
                'key' => 'event_region',
                'value' => $region_id
            );
       // }
        
        $thisevent = new WP_Query($args);
        if ($thisevent->have_posts()): 
            if( is_front_page() || is_home() ) {
            ?>

            <h3 class="widget-header">Анонсы на сегодня</h3>
            <?php }
            echo '<ul class="front-date">';
            while ($thisevent->have_posts()):
                $thisevent->the_post();
                $region_id = get_post_meta($post->ID, 'location_name', 1);
                echo '<li><span>' . get_post_meta($post->ID, 'event_start_date', 1) . '-' . get_post_meta($post->ID, 'event_end_date', 1) . ' / ' . get_post_meta($post->ID, 'event_start_time', 1) . ' - ' . get_post_meta($post->ID, 'event_end_time', 1) . '</span><br><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a><br>' . get_post_meta($region_id, 'location_town', 1) . '   <a href="' . get_permalink($region_id) . '" title="' . get_the_title($region_id) . '">' . get_the_title($region_id) . '</a></il>';
                
                echo '<br>';
            endwhile;
            echo '</ul>';
        else:
            _e('Сегодня Мероприятий нет.');
        endif;
        wp_reset_query();
    }
    
    add_shortcode('cr_todays_events', 'cr_todays_events');
}

/*----------------------------------------------------------------------------*/
/* Мероприятия на сегодня для вкладок
/*----------------------------------------------------------------------------*/

if (!function_exists('cr_todays_events_tabs')) {
    function cr_todays_events_tabs($pager = null)
    {
        
        if( $_COOKIE['regions'] ) {
            $region_id = $_COOKIE['regions'];
        } else {
            $ip_array  = get_conwert_ip_too_region();
            $region_id = $ip_array['region_id'];
        }
        
        global $post;
        $day_start = mktime(0, 0, 0);
        $day_end   = mktime(0, 0, 0, date('n'), date('j') + 1);
        
        $out = '';
        strtotime('tomorrow');
        $args = array();
        $pager ? $pager = $pager : $pager = 1;
        $args = array(
            'paged' => $pager,
            'post_type' => 'event',
            'post_status' => 'publish',
            'posts_per_page' => 15,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'unix_date_start',
                    'value' => $day_end,
                    'type' => 'NUMERIC',
                    'compare' => '<='
                ),
                array(
                    'key' => 'unix_date_end',
                    'value' => $day_start,
                    'type' => 'NUMERIC',
                    'compare' => '>='
                )
            )
        );
        
        //if (!empty($ip_array['region_id'])) {
            $args['meta_query'][2] = array(
                'key' => 'event_region',
                'value' => $region_id
            );
        //}
        
        global $post;
        $thisevent = new WP_Query($args);
        if ($thisevent->have_posts()):
            $ical_args                   = $args;
            $ical_args['posts_per_page'] = -1;
            $url                         = wp_generate_password(15, false);
            cr_event_ical_fooll($ical_args, $url);
            $out .= '<div class="clear"></div>';
            $out .= '<div class="filtred-anonses">';
            $out .= '<a href="' . home_url('/') . 'wp-content/evens/tmp_filtred/' . $url . '.ics" title="' . __('Скачать iCal (все мероприятия)', 'wp_panda') . '" class="doun-ical-filtred">' . __('Скачать iCal (все мероприятия)', 'wp_panda') . '</a>';
            $out .= '<a href="" class="support-filtred">' . __('Справка', 'wp_panda') . '</a>';
            $out .= '<input type="text" class="link-ical-filtred" value="' . home_url('/') . 'wp-content/evens/tmp_filtred/' . $url . '.ics">';
            $out .= '</div>';
            $out .= '<ul>';
            while ($thisevent->have_posts()):
                $thisevent->the_post();
                $region_id = get_post_meta($post->ID, 'location_name', 1);
                $out .= '<li class="event-out-li">';
                $out .= '<div class="event-out-left-block">';
                $out .= '<span class="event-city-out">' . get_post_meta($region_id, 'location_town', 1) . '</span>';
                $out .= '<span class="event-location-out"><a href="' . get_permalink($region_id) . '" title="' . get_the_title($region_id) . '">' . get_the_title($region_id) . '</a></span>';
                $out .= '<span class="event-date-out">' . get_post_meta($post->ID, 'event_start_date', 1) . '-' . get_post_meta($post->ID, 'event_end_date', 1) . '</span>';
                $out .= '<span class="event-time-out">' . get_post_meta($post->ID, 'event_start_time', 1) . ' - ' . get_post_meta($post->ID, 'event_end_time', 1) . '</span>';
                $out .= '<span class="event-ical-out"><a href="' . home_url('/') . 'wp-content/evens/event-' . $post->ID . '.ics" title="' . __('Скачать iCal мероприятия', 'wp_panda') . '">' . __('Скачать iCal мероприятия', 'wp_panda') . '</a></span>';
                $out .= cr_event_now();
                $out .= '</div>';
                $out .= '<div class="event-out-right-block">';
                $out .= '<h3 class="event-out-anonses-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h3>';
                $string = get_the_content();
                $out .= '<p class="event-out-anonses-text">' . wp_trim_words($string, 20, ' ...') . '</p>';
                $out .= '</div>';
                $out .= '</il>';
            endwhile;
            $out .= '</ul>';
            $out .= '<div class="clear"></div>';
        else:
            $out .= __('Подходящих мероприятий нет.', 'wp_panda');
        endif;
        // пагинация 
        global $wp_rewrite;
        $pages          = '';
        $max            = $thisevent->max_num_pages;
        //if (!$current = get_query_var('paged'))
        //$current = 1;
        $a['base']      = str_replace(999999999, '%#%', get_pagenum_link(999999999));
        $a['total']     = $max;
        $a['current']   = $args['paged'];
        $a['mid_size']  = 1;
        $a['end_size']  = 1;
        $a['prev_text'] = '&laquo;';
        $a['next_text'] = '&raquo;';
        
        if ($max > 1)
            $out .= '<div class="navigation">';
        $out .= $pages . paginate_links($a);
        if ($max > 1)
            $out .= '</div>';
        //общий фильтр
        $out .= '<div class="all-filters">';
        $out .= '<span class="all-filters-button" data-type="filter-all">Все</span>';
        $out .= '<span class="all-filters-button" data-type="filter-past">Прошедшие</span>';
        $out .= '<span class="all-filters-button" data-type="filter-now">Текущие</span>';
        $out .= '<span class="all-filters-button" data-type="filter-after">Будущие</span>';
        $out .= '</div>';
        
        echo $out;
        wp_reset_query();
    }
}

/*----------------------------------------------------------------------------*/
/*  ajax  для дефолтной пагинации
/*----------------------------------------------------------------------------*/
function cr_event_default_action_callback()
{
    cr_todays_events_tabs($_POST['data_page']);
}
add_action('wp_ajax_cr_event_default_action', 'cr_event_default_action_callback');
add_action('wp_ajax_nopriv_cr_event_default_action', 'cr_event_default_action_callback');
/*----------------------------------------------------------------------------*/
/*  ajax  для вкладок
/*----------------------------------------------------------------------------*/

function cr_event_tabs_action_callback()
{
    check_ajax_referer('cr-event-tabs-special-string', 'security');
    if (!empty($_POST['data_event']))
        $data_event = $_POST['data_event'];
    if (!empty($_POST['region_id']))
        $region_id = $_POST['region_id'];
    if (!empty($_POST['theme_id']))
        $theme_id = $_POST['theme_id'];
    if (!empty($_POST['day_start']))
        $day_start = data_convert_unix($_POST['day_start']);
    if (!empty($_POST['day_end']))
        $day_end = data_convert_unix($_POST['day_end']);
    if (!empty($_POST['town']))
        $town = $_POST['town'];
    if (!empty($_POST['data_type_event']))
        $data_type_event = $_POST['data_type_event'];
    
    global $post;
    
    if (!empty($data_event) && $data_event === 'today') {
        $day_start = mktime(0, 0, 0);
        $day_end   = mktime(0, 0, 0, date('n'), date('j') + 1);
    } elseif (!empty($data_event) && $data_event === 'tomorrow') {
        $day_start = mktime(0, 0, 0, date('n'), date('j') + 1);
        $day_end   = mktime(0, 0, 0, date('n'), date('j') + 2);
    } elseif (!empty($data_event) && $data_event === 'all-anonses') {
        $day_start = mktime(0, 0, 0);
    }
    
    
    $args = array(
        'post_type' => 'event',
        'posts_per_page' => 15,
        'post_status' => 'publish',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'unix_date_end',
                'value' => $day_start,
                'type' => 'NUMERIC',
                'compare' => '>='
            )
        )
    );
    
    //для пагинации
    $_POST['data_page'] ? $args['paged'] = $_POST['data_page'] : $args['paged'] = '1';
    
    if (!empty($day_end)) {
        $args['meta_query'][] = array(
            'key' => 'unix_date_start',
            'value' => $day_end,
            'type' => 'NUMERIC',
            'compare' => '<='
        );
    }
    
    if (!empty($region_id)) {
        $args['meta_query'][] = array(
            'key' => 'event_region',
            'value' => $region_id
        );
    }
    
    if (!empty($town)) {
        $args['meta_query'][] = array(
            'key' => 'event_town',
            'value' => $town
        );
    }
    
    if (!empty($data_type_event) && $data_type_event !== 'all') {
        $args['tax_query'][0] = array(
            'taxonomy' => 'event-categories',
            'field' => 'slug'
        );
        

        if ($data_type_event !== "other") {
            $args['tax_query'][0]['terms'] = array(
                $data_type_event
            );
        }
        
        if ($data_type_event == "other") {
            $args['tax_query'][0]['operator'] = 'NOT IN';
            $args['tax_query'][0]['terms']    = array(
                'event',
                'developments',
                'visits',
                'concerts',
                'exhibitions'
            );
        }
        
    }

    if(!empty($theme_id) ) {
        $args['tax_query']['relation'] = 'AND';
        $args['tax_query'][1] = array(
            'taxonomy' => 'event-tag',
            'field' => 'id',
            'terms' => $theme_id,
        );
    }


    
    $out = '';
    $out .= '<div class="clear"></div>';
    global $post;
    $thisevent = new WP_Query($args);
    if ($thisevent->have_posts()):
        $ical_args                   = $args;
        $ical_args['posts_per_page'] = -1;
        $url                         = wp_generate_password(15, false);
        cr_event_ical_fooll($ical_args, $url);
        $out .= '<div class="filtred-anonses">';
        $out .= '<a href="' . home_url('/') . 'wp-content/evens/tmp_filtred/' . $url . '.ics" title="' . __('Скачать iCal (все мероприятия)', 'wp_panda') . '" class="doun-ical-filtred">' . __('Скачать iCal (все мероприятия)', 'wp_panda') . '</a>';
        $out .= '<a href="" class="support-filtred">' . __('Справка', 'wp_panda') . '</a>';
        $out .= '<input type="text" class="link-ical-filtred" value="' . home_url('/') . 'wp-content/evens/tmp_filtred/' . $url . '.ics">';
        $out .= '</div>';
        $out .= '<ul>';
        while ($thisevent->have_posts()):
            $thisevent->the_post();
            $region_id = get_post_meta($post->ID, 'location_name', 1);
            $out .= '<li class="event-out-li">';
            $out .= '<div class="event-out-left-block">';
            $out .= '<span class="event-city-out">' . get_post_meta($region_id, 'location_town', 1) . '</span>';
            $out .= '<span class="event-location-out"><a href="' . get_permalink($region_id) . '" title="' . get_the_title($region_id) . '">' . get_the_title($region_id) . '</a></span>';
            $out .= '<span class="event-date-out">' . get_post_meta($post->ID, 'event_start_date', 1) . '-' . get_post_meta($post->ID, 'event_end_date', 1) . '</span>';
            $out .= '<span class="event-time-out">' . get_post_meta($post->ID, 'event_start_time', 1) . ' - ' . get_post_meta($post->ID, 'event_end_time', 1) . '</span>';
            $out .= '<span class="event-ical-out"><a href="' . home_url('/') . 'wp-content/evens/event-' . $post->ID . '.ics" title="' . __('Скачать iCal мероприятия', 'wp_panda') . '">' . __('Скачать iCal мероприятия', 'wp_panda') . '</a></span>';
            $out .= cr_event_now();
            $out .= '</div>';
            $out .= '<div class="event-out-right-block">';
            $out .= '<h3 class="event-out-anonses-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h3>';
            $string = get_the_content();
            $out .= '<p class="event-out-anonses-text">' . wp_trim_words($string, 20, ' ...') . '</p>';
            $out .= '</div>';
            $out .= '</il>';
        endwhile;
        $out .= '</ul>';
        $out .= '<div class="clear"></div>';
    else:
        $out .= __('Подходящих мероприятий нет.', 'wp_panda');
    endif;
    
    // пагинация 
    global $wp_rewrite;
    $pages = '';
    $max   = $thisevent->max_num_pages;
    
    $a['base']      = str_replace(999999999, '%#%', get_pagenum_link(999999999));
    $a['total']     = $max;
    $a['current']   = $args['paged'];
    $a['mid_size']  = 1;
    $a['end_size']  = 1;
    $a['prev_text'] = '&laquo;';
    $a['next_text'] = '&raquo;';
    
    if ($max > 1)
        $out .= '<div class="navigation">';
    $out .= $pages . paginate_links($a);
    if ($max > 1)
        $out .= '</div>';
    //общий фильтр
    $out .= '<div class="all-filters">';
    $out .= '<span class="all-filters-button" data-type="filter-all">Все</span>';
    $out .= '<span class="all-filters-button" data-type="filter-past">Прошедшие</span>';
    $out .= '<span class="all-filters-button" data-type="filter-now">Текущие</span>';
    $out .= '<span class="all-filters-button" data-type="filter-after">Будущие</span>';
    $out .= '</div>';
    
    echo $out;
    //print_r($args);
    wp_reset_query();
    die();
}
add_action('wp_ajax_cr_event_tabs_action', 'cr_event_tabs_action_callback');
add_action('wp_ajax_nopriv_cr_event_tabs_action', 'cr_event_tabs_action_callback');

// ajax для фильтра

/*----------------------------------------------------------------------------*/
/*  ajax  для расширенного фильтра  внонсов
/*----------------------------------------------------------------------------*/

function cr_event_filter_action_callback()
{
    
    check_ajax_referer('cr-event-tabs-special-string', 'security');
    
    // первоночальный массив, работает всегда
    $args = array(
        'post_type' => 'event',
        'post_status' => 'publish',
        'posts_per_page' => 15
    );
    
    
    if (!empty($_POST))
        $str = $_POST['data_form'];
    
    parse_str($str, $out);
    
     $towns  = $out['location_town'];
    //для пагинации
    
    $_POST['data_page'] ? $args['paged'] = $_POST['data_page'] : $args['paged'] = '1';

    
    // запрос для поиска по ключевым словам     
    if (!empty($out['cr-ev-keywords'])) {
        $keywords  = $out['cr-ev-keywords'];
        $args['s'] = $keywords;
    }
    
    //поиск по таксономиям
    if (!empty($out['cr-ev-categories']) && !empty($out['cr-ev-tag']))
        $args['tax_query']['relation'] = 'AND';

     //запрос для тем мероприятий
    if (!empty($out['cr-ev-tag'])) {
        $tag = $out['cr-ev-tag'];
        foreach ($tag as $key) {
            $tags[] = $key;
        }
        $args['tax_query']['tag'] = array(
            'taxonomy' => 'event-tag',
            'field' => 'id',
            'terms' => $tags
        );
    }

    // запрос для видов мероприятий
    if (!empty($out['cr-ev-categories'])) {
        $categories = $out['cr-ev-categories'];
        foreach ($categories as $key) {
            $tax[] = $key;
        }
        $args['tax_query']['cat'] = array(
            'taxonomy' => 'event-categories',
            'field' => 'id',
            'terms' => $tax
        );
    }
    
   
    
    // запрос для региона мероапиятий
    if (!empty($out['location_region'])) {
        $region = $out['location_region'];
        foreach ($region as $key) {
            if (!empty($key))
                $val[] = $key;
        }
        $args['meta_query']['reg'] = array(
            'key' => 'event_region',
            'value' => $val
        );
    }
    
    // запрос для города мероапиятий
    if (!empty($out['location_town'])) {
        $town = $out['location_town'];
        foreach ($town as $key) {
            if (!empty($key))
                $town_ev[] = $key;
        }
        
        $args['meta_query']['town'] = array(
            'key' => 'event_town',
            'value' => $town_ev
        );
    }
    
    //поиск по дате
    
    if (!empty($out['cr-ev-date'])) {
        $date = $out['cr-ev-date'];
        
        if ($date === 'all')
            $day_start = mktime(0, 0, 0);
        
        if ($date === 'today') {
            $day_start = mktime(0, 0, 0);
            $day_end   = mktime(0, 0, 0, date('n'), date('j') + 1);
        }
        
        if ($date === 'tomorrow') {
            $day_start = mktime(0, 0, 0, date('n'), date('j') + 1);
            $day_end   = mktime(0, 0, 0, date('n'), date('j') + 2);
        }
        
        if ($date === 'past')
            $day_end = mktime(0, 0, 0);
        
        if (($date === 'in-date') && (!empty($out['from-event-in'])))
            $day_start = data_convert_unix($out['from-event-in']);
        if (($date === 'in-date') && (!empty($out['to-event-in'])))
            $day_end = data_convert_unix($out['to-event-in']);
        
        if (!empty($day_start)) {
           // echo '<h1>' . $day_start . '</h1>';
            $args['meta_query']['start'] = array(
                'key' => 'unix_date_end',
                'value' => $day_start,
                'type' => 'NUMERIC',
                'compare' => '>='
            );
        }
        
        if (!empty($day_end) && $date !== 'past') {
           // echo '<h1>' . $day_end . '</h1>';
            $args['meta_query']['end'] = array(
                'key' => 'unix_date_start',
                'value' => $day_end,
                'type' => 'NUMERIC',
                'compare' => '<='
            );
        } elseif (!empty($day_end) && $date === 'past') {
           // echo '<h1>' . $day_end . '</h1>';
            $args['meta_query']['end'] = array(
                'key' => 'unix_date_end',
                'value' => $day_end,
                'type' => 'NUMERIC',
                'compare' => '<='
            );
        }
    }
    
    $service_meta_array = array();
    //поиск по произвольным полям
    if (!empty($out['location_region']))
        $service_meta_array[] = 'yes';
    if (!empty($out['location_town']))
        $service_meta_array[] = 'yes';
    if (!empty($day_end))
        $service_meta_array[] = 'yes';
    if (!empty($day_start))
        $service_meta_array[] = 'yes';
    
    if (count($service_meta_array) > 1)
        $args['meta_query']['relation'] = 'AND';
    
    $out = '';
    $out .= '<div class="clear"></div>';
    global $post;
    $thisevent = new WP_Query($args);
    if ($thisevent->have_posts()):
        $ical_args                   = $args;
        $ical_args['posts_per_page'] = -1;
        $url                         = wp_generate_password(15, false);
        cr_event_ical_fooll($ical_args, $url);
        $out .= '<div class="filtred-anonses">';
        $out .= '<a href="' . home_url('/') . 'wp-content/evens/tmp_filtred/' . $url . '.ics" title="' . __('Скачать iCal (все мероприятия)', 'wp_panda') . '" class="doun-ical-filtred">' . __('Скачать iCal (все мероприятия)', 'wp_panda') . '</a>';
        $out .= '<a href="" class="support-filtred">' . __('Справка', 'wp_panda') . '</a>';
        $out .= '<input type="text" class="link-ical-filtred" value="' . home_url('/') . 'wp-content/evens/tmp_filtred/' . $url . '.ics">';
        $out .= '</div>';
        $out .= '<ul>';
        while ($thisevent->have_posts()):
            $thisevent->the_post();
            $region_id = get_post_meta($post->ID, 'location_name', 1);
            $out .= '<li class="event-out-li">';
            $out .= '<div class="event-out-left-block">';
            $out .= '<span class="event-city-out">' . this_town() . '</span>';
            $out .= '<span class="event-location-out"><a href="' . get_permalink($region_id) . '" title="' . get_the_title($region_id) . '">' . get_the_title($region_id) . '</a></span>';
            $out .= '<span class="event-date-out">' . get_post_meta($post->ID, 'event_start_date', 1) . '-' . get_post_meta($post->ID, 'event_end_date', 1) . '</span>';
            $out .= '<span class="event-time-out">' . get_post_meta($post->ID, 'event_start_time', 1) . ' - ' . get_post_meta($post->ID, 'event_end_time', 1) . '</span>';
            $out .= '<span class="event-ical-out"><a href="' . home_url('/') . 'wp-content/evens/event-' . $post->ID . '.ics" title="' . __('Скачать iCal мероприятия', 'wp_panda') . '">' . __('Скачать iCal мероприятия', 'wp_panda') . '</a></span>';
            $out .= cr_event_now();
            $out .= '</div>';
            $out .= '<div class="event-out-right-block">';
            $out .= '<h3 class="event-out-anonses-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h3>';
            $string = get_the_content();
            $out .= '<p class="event-out-anonses-text">' . wp_trim_words($string, 20, ' ...') . '</p>';
            $out .= '</div>';
            $out .= '</il>';

        endwhile;
        $out .= '</ul>';
        $out .= '<div class="clear"></div>';
    else:
        $out .= __('Подходящих мероприятий нет.', 'wp_panda');
    endif;
    
    $out.=$n;
    // пагинация 
    global $wp_rewrite;
    $pages          = '';
    $max            = $thisevent->max_num_pages;
    //if (!$current = get_query_var('paged'))
    //$current = 1;
    $a['base']      = str_replace(999999999, '%#%', get_pagenum_link(999999999));
    $a['total']     = $max;
    $a['current']   = $args['paged'];
    $a['mid_size']  = 1;
    $a['end_size']  = 1;
    $a['prev_text'] = '&laquo;';
    $a['next_text'] = '&raquo;';
    
    if ($max > 1)
        $out .= '<div class="navigation">';
    $out .= $pages . paginate_links($a);
    if ($max > 1)
        $out .= '</div>';
    //общий фильтр
    $out .= '<div class="all-filters">';
    $out .= '<span class="all-filters-button" data-type="filter-all">Все</span>';
    $out .= '<span class="all-filters-button" data-type="filter-past">Прошедшие</span>';
    $out .= '<span class="all-filters-button" data-type="filter-now">Текущие</span>';
    $out .= '<span class="all-filters-button" data-type="filter-after">Будущие</span>';
    $out .= '</div>';
    
    echo $out;
   // print_r($args);
    wp_reset_query();
    die();
}


add_action('wp_ajax_cr_event_filter_action', 'cr_event_filter_action_callback');
add_action('wp_ajax_nopriv_cr_event_filter_action', 'cr_event_filter_action_callback');

/*----------------------------------------------------------------------------*/
/*  ajax  для расширенного фильтра  внонсов
/*----------------------------------------------------------------------------*/

function cr_event_ide_filter_action_callback()
{
    
    check_ajax_referer('cr-event-tabs-special-string', 'security');
    
    // первоночальный массив, работает всегда
    $args = array(
        'post_type' => 'event',
        'post_status' => 'publish',
        'posts_per_page' => 15
    );
    
    
    if (!empty($_POST))
        $data_filters = $_POST['data_filters'];
    
    //для пагинации
    
    $_POST['data_page'] ? $args['paged'] = $_POST['data_page'] : $args['paged'] = '1';
    
    //поиск по дате
    
    if (!empty($data_filters)) {
        
        if ($data_filters === 'filter-now') {
            $day_start = mktime(0, 0, 0);
            $day_end   = mktime(0, 0, 0, date('n'), date('j') + 1);
        }
        
        if ($data_filters === 'filter-after') {
            $day_start = mktime(0, 0, 0, date('n'), date('j') + 1);
        }
        
        if ($data_filters === 'filter-past')
            $day_end = mktime(0, 0, 0);
        
        
        if (!empty($day_start)) {
            $args['meta_query']['start'] = array(
                'key' => 'unix_date_end',
                'value' => $day_start,
                'type' => 'NUMERIC',
                'compare' => '>='
            );
        }
        
        if (!empty($day_end) && $data_filters !== 'filter-past') {
           // echo '<h1>' . $day_end . '</h1>';
            $args['meta_query']['end'] = array(
                'key' => 'unix_date_start',
                'value' => $day_end,
                'type' => 'NUMERIC',
                'compare' => '<='
            );
        } elseif (!empty($day_end) && $data_filters === 'filter-past') {
          //  echo '<h1>' . $day_end . '</h1>';
            $args['meta_query']['end'] = array(
                'key' => 'unix_date_end',
                'value' => $day_end,
                'type' => 'NUMERIC',
                'compare' => '<='
            );
        }
    }
    
    $service_meta_array = array();
    //поиск по произвольным полям
    if (!empty($day_end))
        $service_meta_array[] = 'yes';
    if (!empty($day_start))
        $service_meta_array[] = 'yes';
    
    if (count($service_meta_array) > 1)
        $args['meta_query']['relation'] = 'AND';
    
    $out = '';
    $out .= '<div class="clear"></div>';
    global $post;
    $thisevent = new WP_Query($args);
    if ($thisevent->have_posts()):
        $ical_args                   = $args;
        $ical_args['posts_per_page'] = -1;
        $url                         = wp_generate_password(15, false);
        cr_event_ical_fooll($ical_args, $url);
        $out .= '<div class="filtred-anonses">';
        $out .= '<a href="' . home_url('/') . 'wp-content/evens/tmp_filtred/' . $url . '.ics" title="' . __('Скачать iCal (все мероприятия)', 'wp_panda') . '" class="doun-ical-filtred">' . __('Скачать iCal (все мероприятия)', 'wp_panda') . '</a>';
        $out .= '<a href="" class="support-filtred">' . __('Справка', 'wp_panda') . '</a>';
        $out .= '<input type="text" class="link-ical-filtred" value="' . home_url('/') . 'wp-content/evens/tmp_filtred/' . $url . '.ics">';
        $out .= '</div>';
        $out .= '<ul>';
        while ($thisevent->have_posts()):
            $thisevent->the_post();
            $region_id = get_post_meta($post->ID, 'location_name', 1);
            $out .= '<li class="event-out-li">';
            $out .= '<div class="event-out-left-block">';
            $out .= '<span class="event-city-out">' . get_post_meta($region_id, 'location_town', 1) . '</span>';
            $out .= '<span class="event-location-out"><a href="' . get_permalink($region_id) . '" title="' . get_the_title($region_id) . '">' . get_the_title($region_id) . '</a></span>';
            $out .= '<span class="event-date-out">' . get_post_meta($post->ID, 'event_start_date', 1) . '-' . get_post_meta($post->ID, 'event_end_date', 1) . '</span>';
            $out .= '<span class="event-time-out">' . get_post_meta($post->ID, 'event_start_time', 1) . ' - ' . get_post_meta($post->ID, 'event_end_time', 1) . '</span>';
            $out .= '<span class="event-ical-out"><a href="' . home_url('/') . 'wp-content/evens/event-' . $post->ID . '.ics" title="' . __('Скачать iCal мероприятия', 'wp_panda') . '">' . __('Скачать iCal мероприятия', 'wp_panda') . '</a></span>';
            $out .= cr_event_now();
            $out .= '</div>';
            $out .= '<div class="event-out-right-block">';
            $out .= '<h3 class="event-out-anonses-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h3>';
            $string = get_the_content();
            $out .= '<p class="event-out-anonses-text">' . wp_trim_words($string, 20, ' ...') . '</p>';
            $out .= '</div>';
            $out .= '</il>';
        endwhile;
        $out .= '</ul>';
        $out .= '<div class="clear"></div>';
    else:
        $out .= __('Подходящих мероприятий нет.', 'wp_panda');
    endif;
    
    
    // пагинация 
    global $wp_rewrite;
    $pages          = '';
    $max            = $thisevent->max_num_pages;
    //if (!$current = get_query_var('paged'))
    //$current = 1;
    $a['base']      = str_replace(999999999, '%#%', get_pagenum_link(999999999));
    $a['total']     = $max;
    $a['current']   = $args['paged'];
    $a['mid_size']  = 1;
    $a['end_size']  = 1;
    $a['prev_text'] = '&laquo;';
    $a['next_text'] = '&raquo;';
    
    if ($max > 1)
        $out .= '<div class="navigation">';
    $out .= $pages . paginate_links($a);
    if ($max > 1)
        $out .= '</div>';
    //общий фильтр
    $out .= '<div class="all-filters">';
    $out .= '<span class="all-filters-button" data-type="filter-all">Все</span>';
    $out .= '<span class="all-filters-button" data-type="filter-past">Прошедшие</span>';
    $out .= '<span class="all-filters-button" data-type="filter-now">Текущие</span>';
    $out .= '<span class="all-filters-button" data-type="filter-after">Будущие</span>';
    $out .= '</div>';
    
    echo $out;
    wp_reset_query();
    die();
}


add_action('wp_ajax_cr_event_ide_filter_action', 'cr_event_ide_filter_action_callback');
add_action('wp_ajax_nopriv_cr_event_ide_filter_action', 'cr_event_ide_filter_action_callback');

/* создаем event calendarи для ical*/

function cr_save_events_in_posts_save()
{
    global $post;
    
    $start_time      = get_post_meta($post->ID, 'event_start_time', 1); // время начала
    $end_time        = get_post_meta($post->ID, 'event_end_time', 1); //время конца
    $start_date      = get_post_meta($post->ID, 'event_start_date', 1); //дата начала
    $end_date        = get_post_meta($post->ID, 'event_end_date', 1); //дата конца
    $start_date_conv = data_convert_ical($start_date); //переворивает дату начала
    $end_date_conv   = data_convert_ical($end_date); //переворивает дату конца
    $start_event     = strtotime($start_date_conv . ' ' . $start_time . ':00'); // начало UNIX
    $end_event       = strtotime($end_date_conv . ' ' . $end_time . ':00'); //конец UNIX
    
    
    //namespace iCalendarCreator;
    $event_name        = $post->post_title;
    $string            = $post->post_content;
    $event_description = $trimmed = wp_trim_words($string, 15, '...');
    $organizer         = 'Jourdom';
    $organizer_email   = get_bloginfo('admin_email');
    $event_time_zone   = 'America/Chicago';
    date_default_timezone_set($event_time_zone);
    $event_start = $start_event;
    $event_end   = $end_event;
    $region_id   = get_post_meta($post->ID, 'location_name', 1);
    $venue       = array(
        'venue_name' => get_the_title($region_id),
        'venue_address' => get_post_meta($region_id, 'location_address', 1),
        'venue_address_two' => get_post_meta($region_id, 'location_town', 1),
        'venue_city' => get_post_meta($region_id, 'location_region', 1),
        'venue_state' => 'Российская Федерация',
        'venue_postal_code' => get_post_meta($region_id, 'location_postcode', 1)
    );
    
    $icalendar = new iCalendarFile($event_name);
    
    $icalendar->set_event_description($event_description);
    $icalendar->set_organizer($organizer);
    $icalendar->set_organizer_email($organizer_email);
    $icalendar->set_event_start($event_start);
    $icalendar->set_event_end($event_end);
    $icalendar->set_time_zone($event_time_zone);
    
    $icalendar->set_venue($venue);
    
    $ical = $icalendar->create_ics_data_too_file(); // Creates the iCalendar file.
    
    //$ical = $icalendar->html_ics_file();
    //$ical = $export->toICal($events);
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/wp-content/evens/event-' . $post->ID . '.ics', $ical);
}

//add_action('save_post_event', 'cr_save_events_in_posts_save'); -отключено

/* ical для места*/

function cr_event_ical_in_location()
{
    global $post;
    
    $file_ID = $post->ID;

    $organizer = Jourdom . ru;
    
    
    $out = '';
    $out .= "BEGIN:VCALENDAR\n";
    $out .= "PRODID:-//" . $organizer . "//NONSGML " . $organizer . "//EN\n";
    $out .= "VERSION:2.0\n";
    $out .= "CALSCALE:GREGORIAN\n";
    $out .= "METHOD:PUBLISH\n";
    
    $region     = get_post_meta($post->ID, 'location_region', 1);
    $city       = get_post_meta($post->ID, 'location_town', 1);
    $address    = get_post_meta($post->ID, 'location_address', 1);
    $region_new = get_region_select($region);
    $location   = $address . ', ' . $city . ', ' . $region;
    
    $args = array(
        'post_type' => 'event',
        'showposts' => -1,
        'meta_query' => array(
            array(
                'key' => 'location_name',
                'value' => $post->ID
            )
        )
    );
    
    $thisevent = new WP_Query($args);
    if ($thisevent->have_posts()):
        while ($thisevent->have_posts()):
            $thisevent->the_post();
            
            $start_time      = get_post_meta($post->ID, 'event_start_time', 1); // время начала
            $end_time        = get_post_meta($post->ID, 'event_end_time', 1); //время конца
            $start_date      = get_post_meta($post->ID, 'event_start_date', 1); //дата начала
            $end_date        = get_post_meta($post->ID, 'event_end_date', 1); //дата конца
            $start_date_conv = data_convert($start_date); //переворивает дату начала
            $end_date_conv   = data_convert($end_date); //переворивает дату конца
            $start_event     = strtotime($start_date_conv . ' ' . $start_time . ':00'); // начало UNIX
            $end_event       = strtotime($end_date_conv . ' ' . $end_time . ':00'); //конец UNIX
            
            $start = date('Ymd', $start_event) . 'T' . date('His', $start_event) . 'Z';
            /** @var string $end Formatted end date and time. Converted to Zulu time. */
            $end   = date('Ymd', $end_event) . 'T' . date('His', $end_event) . 'Z';
            
            /** @var string $location Venue information combined into one string. */
            
            $out .= "BEGIN:VEVENT\n";
            $out .= "DTSTART:{$start}\n";
            $out .= "DTEND:{$end}\n";
            $out .= "DTSTAMP:" . date('Ymd') . 'T' . date('His') . "\n";
            $out .= "UID:" . date('Ymd') . 'T' . date('His') . "-" . rand() . $organizer . "\n"; // Required by Outlook.
            $string = get_the_content($post->ID);
            $out .= "DESCRIPTION:" . wp_trim_words($string, 15, '...') . "\n";
            $out .= "ORGANIZER:CN=" . $organizer . ":MAILTO:" . get_bloginfo('admin_email') . "\n";
            $out .= "LOCATION:" . $location . "\n";
            $out .= "SUMMARY:" . get_the_title($post->ID) . "\n";
            $out .= "END:VEVENT\n";
        endwhile;
    endif;
    wp_reset_query();
    
    $out .= "END:VCALENDAR\n";
    
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/wp-content/evens/location-' . $file_ID . '.ics', $out);
}

/* Icall полный */
function cr_event_ical_fooll($args = null, $url = null)
{
    global $post;
    
    $organizer = Jourdom . ru;
    
    
    $out = '';
    $out .= "BEGIN:VCALENDAR\n";
    $out .= "PRODID:-//" . $organizer . "//NONSGML " . $organizer . "//EN\n";
    $out .= "VERSION:2.0\n";
    $out .= "CALSCALE:GREGORIAN\n";
    $out .= "METHOD:PUBLISH\n";
    if (empty($args)) {
        $args = array(
            'post_type' => 'event',
            'showposts' => -1
        );
    }
    $thisevent = new WP_Query($args);
    if ($thisevent->have_posts()):
        while ($thisevent->have_posts()):
            $thisevent->the_post();
            
            if ($no_location !== 'on') {
                $region_id     = get_post_meta($post->ID, 'location_name', 1);
                $city          = get_post_meta($region_id, 'location_town', 1);
                $address       = get_post_meta($region_id, 'location_address', 1);
                $region        = get_post_meta($region_id, 'location_region', 1);
                $location_name = get_the_title($region_id);
                
                
                $location = $location_name . ', ' . $address . ', ' . $city . ', ' . $region;
            }
            
            $start_time      = get_post_meta($post->ID, 'event_start_time', 1); // время начала
            $end_time        = get_post_meta($post->ID, 'event_end_time', 1); //время конца
            $start_date      = get_post_meta($post->ID, 'event_start_date', 1); //дата начала
            $end_date        = get_post_meta($post->ID, 'event_end_date', 1); //дата конца
            $start_date_conv = data_convert($start_date); //переворивает дату начала
            $end_date_conv   = data_convert($end_date); //переворивает дату конца
            $start_event     = strtotime($start_date_conv . ' ' . $start_time . ':00'); // начало UNIX
            $end_event       = strtotime($end_date_conv . ' ' . $end_time . ':00'); //конец UNIX
            
            $start = date('Ymd', $start_event) . 'T' . date('His', $start_event) . 'Z';
            /** @var string $end Formatted end date and time. Converted to Zulu time. */
            $end   = date('Ymd', $end_event) . 'T' . date('His', $end_event) . 'Z';
            
            /** @var string $location Venue information combined into one string. */
            
            $out .= "BEGIN:VEVENT\n";
            $out .= "DTSTART:{$start}\n";
            $out .= "DTEND:{$end}\n";
            $out .= "DTSTAMP:" . date('Ymd') . 'T' . date('His') . "\n";
            $out .= "UID:" . date('Ymd') . 'T' . date('His') . "-" . rand() . $organizer . "\n"; // Required by Outlook.
            $string = get_the_content($post->ID);
            $out .= "DESCRIPTION:" . wp_trim_words($string, 15, '...') . "\n";
            $out .= "ORGANIZER:CN=" . $organizer . ":MAILTO:" . get_bloginfo('admin_email') . "\n";
            $out .= "LOCATION:" . $location . "\n";
            $out .= "SUMMARY:" . get_the_title($post->ID) . "\n";
            $out .= "END:VEVENT\n";
        endwhile;
    endif;
    wp_reset_query();
    
    $out .= "END:VCALENDAR\n";
    if (empty($url)) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/wp-content/evens/tmp_events/all-events.ics', $out);
    } else {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/wp-content/evens/tmp_filtred/' . $url . '.ics', $out);
    }
} 

function cr_event_checkbox_action_callback()
{
    check_ajax_referer('cr-event-tabs-special-string', 'security');
    if (!empty($_POST['data_ids'])){
            $data_ids = $_POST['data_ids'];
        $n=0;
        $returns = "";
        foreach ($data_ids as $key) {
            if( $n == 0 ) {
                $returns .=  "AND pm.meta_value = '" . $key ."'" ;
            } else {
                $returns .="OR pm.meta_value = '" . $key . "'";
            }
        $n++;
        }
    }


    global $wpdb;
    $r = $wpdb->get_col("
        SELECT pm.post_id
        FROM jd_postmeta pm
        LEFT JOIN jd_posts p ON p.ID = pm.post_id
        WHERE pm.meta_key = 'location_region'
        AND p.post_status = 'publish'
        AND p.post_type = 'location'
        " . $returns . "
        ORDER BY meta_value ASC
    ");

    foreach ($r as $key) {
        $arrayw[] = trim( get_post_meta( $key, 'location_town', true ) );
    }

    $results = array_unique($arrayw);
    $results = array_filter($results); 
    $out ="";
    foreach ($results as $result) {
         $out .= "<li><input type='checkbox' name='location_town[]'  value= '" . $result . "'><a href='". home_url() . "/selected?".$result."=".$result."' title='" . $result . "'>" . $result . "</a></li>";
    }
    echo $out;
    die();
}
add_action('wp_ajax_cr_event_checkbox_action', 'cr_event_checkbox_action_callback');
add_action('wp_ajax_nopriv_cr_event_checkbox_action', 'cr_event_checkbox_action_callback');

?>