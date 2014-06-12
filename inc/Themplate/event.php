<?php get_header(); ?>

<?php //$pagelink = get_permalink(); 
	//$pagetitle = get_the_title();
?>

<div class="wrapper-left">
	<div class="column-wide-1">
		<?php get_sidebar('single-column-wide-1'); ?>
	</div> 
	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="post-content">
		<strong>
			<?php
				if(function_exists('bcn_display'))
				{
					bcn_display();
				}
			?>
		</strong><!--/p-->
		<div class="clear top-30"></div>
		<div class="cr-event-thumb">	
			<?php if( has_post_thumbnail() )
				{ 
					the_post_thumbnail( array( 330, 240, 'bfi_thumb' => true, 'crop'=>true ) );
				}
				else
				{
					echo '<img src="' . IMAGES . '/no_image.jpg" alt="' . the_title() . '">';
				} ?>
		</div>
		<div class="sociallinks">
			<a title="Добавить в Twitter" class="ang_tw"  href="http://twitter.com/intent/tweet?text=<?php the_title(); ?>: <?php the_permalink(); ?>" target="_blank" rel="nofollow"><span class='cr-event-icon icon-twitter-bird'></span></a>
			<a title="Поделиться в Facebook" class="ang_fb"  href="http://facebook.com/sharer.php?url=<?php the_permalink(); ?>" target="_blank"  rel="nofollow"><span class='cr-event-icon icon-facebook-rect'></span></a>
			<a title="Поделиться в Google +" class="ang_gp" href="http://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" rel="nofollow"><span class='cr-event-icon  icon-googleplus-rect'></span></a>
			<a title="Поделиться ВКонтакте" class="ang_vk" href="http://vkontakte.ru/share.php?url=<?php the_permalink(); ?>" target="_blank" rel="nofollow"><span class='cr-event-icon icon-vkontakte-rect'></span></a>
			<a title="Опубликовать в LiveJournal" class="ang_lj" href="http://www.livejournal.com/update.bml?event=<?php the_permalink(); ?>&subject=<?php the_title(); ?>" target="_blank" rel="nofollow"><span class='cr-event-icon-lj icon-LiveJournal'></span></a>
			<a title="Опубликовать в Одноклассниках" class="ang_lj" href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?php the_permalink(); ?>&subject=<?php the_title(); ?>" target="_blank" rel="nofollow"><span class='cr-event-icon icon-odnoklassniki-rect'></span></a> 
		</p>
	</div>
	
	<h2><?php the_title(); ?></h2>
	<strong><?php _e( 'Добавить в календарь', 'wp_panda' );?></strong>
	<div class="ical-location">
		<a href="<?php echo home_url('/');?>wp-content/evens/event-<?php echo $post->ID; ?>.ics" title="<?php _e('Скачать iCal мероприятия','wp_panda' ); ?>" class="doun-ical-location"><?php _e('Скачать iCall мероприятия','wp_panda'); ?></a>
		<a href="" class="support"><?php _e('Справка','wp_panda'); ?></a>
		<input type="text" class="link-ical-location" value='<?php echo home_url('/');?>wp-content/evens/event-<?php echo $post->ID; ?>.ics'>

	</div>
	<div class="gu-ya-link">
		<a href="https://calendar.yandex.ru/event-add?view_type=month" title="Я.Календарь">Я.Календарь </a>
	<?php $text = get_the_title();
	$start_data = get_post_meta($post->ID,'event_start_date',1);
		$end_data = get_post_meta($post->ID,'event_end_date',1);
		$start_time = get_post_meta($post->ID,'event_start_time',1);
		$end_time = get_post_meta($post->ID,'event_end_time',1);

			$text = str_replace(' ', '+', $text);
			$start_g = data_convert_google($start_data);
			$end_g = data_convert_google($end_data);
			$start_t_g = str_replace(':', '', $start_time);
			$end_t_g = str_replace(':', '', $end_time);

			if( $no_location !=='on' ) { ?>

		<?php  $region_id = get_post_meta( $post->ID , 'location_name',1);
			$city = get_post_meta( $region_id, 'location_town',1);
			$address = get_post_meta( $region_id , 'location_address',1); 
		$name = get_post_meta( $region_id , 'location_region',1); 
		$region = get_the_title($region_id)	. ' ' . get_region_select($name) . ' '. $city . ' ' . $address;
		$region = str_replace(' ', '+', $region);
		}
		else
		{
		$region ='Мероприятие не привязано к иестоположению!';
		}

				echo '<a class="g-link" target="_blank" href="https://www.google.com/calendar/render?action=TEMPLATE&text='. $text . '&dates=' . $start_g . 'T' . $start_t_g . '00Z/' . $end_g  . 'T' . $end_t_g .'00Z&location=' . $region . '&sf=true&output=xml">G.Календарь</a>'; ?>
	</div>
	<strong>
	<?php _e('Дата / Время','wp_panda') ?></strong>
	
	<?php 
		if( !empty( $start_data ) ) echo  __('c','wp_panda') . ' ' . $start_data . ' ';
		if( !empty( $end_data ) ) echo  __('по','wp_panda') . ' ' . $end_data . ' ';
		if( !empty( $start_time ) ) echo  __('c','wp_panda') . ' ' . $start_time . ' ';
		if( !empty( $end_time ) ) echo  __('до','wp_panda') . ' ' . $end_time;
	?>
	<?php $no_location = get_post_meta( $post->ID , 'no_location',1); 
		if( $no_location !=='on' ) { ?>
		<strong><?php _e('Местоположение','wp_panda') ?></strong>
		<?php  $region_id = get_post_meta( $post->ID , 'location_name',1);
			$city = get_post_meta( $region_id, 'location_town',1);
			$address = get_post_meta( $region_id , 'location_address',1); 
		$name = get_post_meta( $region_id , 'location_region',1); ?>
		<a href="<?php echo get_permalink( $region_id )?>" title='<?php echo get_the_title($region_id) ?>'><?php echo get_the_title($region_id) ?></a>
		<div class="address">(
			<?php echo get_region_select($name); ?>
			<?php echo $city; ?>
			<?php echo $address; ?>
			<?php wp_enqueue_script( 'gmap3' ); ?>
		)</div>
		<script type="text/javascript">	
			(function($) {
				$(document).ready(function(){
					$(".gmap3") .gmap3({
						marker: { 
							address: $('.address').html(),
							data:"Poitiers : great city !"
						},
						map: {
							options: {
								zoom: 14,
							}
						},
					});
				});
			})(jQuery);
		</script>
		<div class="clear"></div>
		<div class="map-out">
			<div id="maps" class="gmap3"></div>
		</div>
		<?php the_content(); ?>
		<?php } else { ?>
		<h2><?php _e('Это мероприятие не имеет физиеского места расположения','wp_panda') ?></h2>
	<?php } ?>
	<?php the_content(); ?>
	<?php comments_template(); ?>
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
</div>
<!--/div-->
</div><!-- .wrapper-left -->

<div class="wrapper-right">
	<div class="column-3">
		<?php get_sidebar('single-column-3'); ?>	
	</div><!-- .column-3 -->
</div><!-- .wrapper-right -->
<?php get_footer(); ?>