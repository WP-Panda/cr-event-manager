<?php get_header(); ?>

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
		<div class="clear"></div>
		<div class="cr-event-thumb">
			<?php if( has_post_thumbnail() )
				{ 
					the_post_thumbnail( array( 330, 240, 'bfi_thumb' => true, 'crop'=>true ) );
				}
				else
				{
					echo '<img src="' . IMAGES . '/no_image.jpg" alt="' . get_the_title() . '">';
				} ?>
		</div>

		<div class="sociallinks">
			<a title="Добавить в Twitter" class="ang_tw"  href="http://twitter.com/intent/tweet?text=<?php the_title(); ?>: <?php the_permalink(); ?>" target="_blank" rel="nofollow">
				<span class='cr-event-icon icon-twitter-bird'></span>
			</a>
			<a title="Поделиться в Facebook" class="ang_fb"  href="http://facebook.com/sharer.php?url=<?php the_permalink(); ?>" target="_blank"  rel="nofollow">
				<span class='cr-event-icon icon-facebook-rect'></span>
			</a>
			<a title="Поделиться в Google +" class="ang_gp" href="http://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" rel="nofollow">
				<span class='cr-event-icon  icon-googleplus-rect'></span>
			</a>
			<a title="Поделиться ВКонтакте" class="ang_vk" href="http://vkontakte.ru/share.php?url=<?php the_permalink(); ?>" target="_blank" rel="nofollow">
				<span class='cr-event-icon icon-vkontakte-rect'></span>
			</a>
			<a title="Опубликовать в LiveJournal" class="ang_lj" href="http://www.livejournal.com/update.bml?event=<?php the_permalink(); ?>&subject=<?php the_title(); ?>" target="_blank" rel="nofollow">
				<span class='cr-event-icon-lj icon-LiveJournal'></span>
			</a>
			<a title="Опубликовать в Одноклассниках" class="ang_lj" href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?php the_permalink(); ?>&subject=<?php the_title(); ?>" target="_blank" rel="nofollow">
				<span class='cr-event-icon icon-odnoklassniki-rect'></span>
			</a> 
		</div>

		<h2><?php the_title(); ?></h2>
		
		<?php  $region = get_post_meta( $post->ID , 'location_region',1);
			$city = get_post_meta( $post->ID, 'location_town',1);
		$address = get_post_meta( $post->ID , 'location_address',1); ?>
		<strong><?php _e('Адрес:','wp_panda')?></strong>
		<div class="address">
			<span class='for-map'>
			<?php echo get_region_select($region); ?>

			<?php echo $city; ?>
			<?php echo $address; ?>
		</span>
			<div class="ical-location">
				<a href="<?php echo home_url('/');?>wp-content/evens/location-<?php echo $post->ID; ?>.ics" title="<?php _e('Скачать iCal мероприятия','wp_panda' ); ?>" class="doun-ical-location"><?php _e('Скачать iCall по месту','wp_panda'); ?></a>
				<a href="" class="support"><?php _e('Справка','wp_panda'); ?></a>
				<input type="text" class="link-ical-location" value='<?php echo home_url('/');?>wp-content/evens/location-<?php echo $post->ID; ?>.ics'>
			</div>
			<?php 
			wp_enqueue_script( 'gmap3' ); ?>

		</div>

		<script type="text/javascript">
			
			(function($) {
				$(document).ready(function(){
					$(".gmap3") .gmap3({
						marker: { 
							address: $('.for-map').html(),
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
			<div id="maps" class="gmap3 font-maps"></div>
		</div>
		<?php the_content(); ?>

		<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

		<?php endif; ?>

		<?php  
			$args = array(
				'post_type' => 'event',
				'showposts' => -1,
				'meta_query' => array(
					array(
						'key' => 'location_name',
						'value' => $post->ID,
					),
				),
			); 
			


			$thisevent  = new WP_Query($args);
			if( $thisevent->have_posts() ) : while ( $thisevent->have_posts() ) : $thisevent->the_post();
			$start_time = get_post_meta($post->ID,'event_start_time',1); // время начала
			$end_time = get_post_meta($post->ID,'event_end_time',1);  //время конца
			$start_date =  get_post_meta($post->ID,'event_start_date',1); //дата начала
			$end_date = get_post_meta($post->ID,'event_end_date',1); //дата конца
			$start_date_conv = data_convert( $start_date ); //переворивает дату начала
			$end_date_conv = data_convert( $end_date ); //переворивает дату конца
			$start_event = strtotime( $start_date_conv  . ' ' . $start_time .':00');  // начало UNIX
			$end_event = strtotime( $end_date_conv . ' ' . $end_time . ':00'); //конец UNIX
			$time = time(); //текущее время
			
			if( $end_event < $time ) { //формируем 3 массива
				$prev[] = $post->ID;
				} elseif ( $start_event <= $time && $time  <= $end_event ) {
				$sey[] = $post->ID;
				} elseif ( $start_event > $time ) {
				$next[]=$post->ID;
			}
			
			endwhile; else: 
		_e('Нет мероприятий привязанных к данному местоположению.'); ?>
	<!-- .post-content -->
	<?php	endif;  wp_reset_query(); ?>
		</div>
		<div class='too-event'>
		<?php if( !empty( $prev ) ) {
			echo '<h3>Прошедшие мероприятия</h3>';
			echo '<ul>';
			foreach($prev as $post_id) {
				echo '<li><a href="' . get_permalink( $post_id ) . '" title="Перейти к ' . get_the_title( $post_id ). '">' . get_the_title($post_id) . '</a> - ' . get_post_meta($post_id,'event_start_date',1) . '-' . get_post_meta($post_id,'event_end_date',1) . ' / ' . get_post_meta($post_id,'event_start_time',1) . ' - ' . get_post_meta($post_id,'event_end_time',1) . '</il>';
			}
			echo '</ul>';
		}
		
		if( !empty( $sey ) ) {
			echo '<h3>Текущщие мероприятия</h3>';
			echo '<ul>';
			foreach($sey as $post_id) {
				echo '<li><a href="' . get_permalink( $post_id ) . '" title="Перейти к ' . get_the_title( $post_id ). '">' . get_the_title($post_id) . '</a> - ' . get_post_meta($post_id,'event_start_date',1) . '-' . get_post_meta($post_id,'event_end_date',1) . ' / ' . get_post_meta($post_id,'event_start_time',1) . ' - ' . get_post_meta($post_id,'event_end_time',1) . '</il>';
			}
			echo '</ul>';
		}
		
		if( !empty( $next ) ) {
			echo '<h3>Будущие мероприятия</h3>';
			echo '<ul>';
			foreach($next as $post_id) {
				echo '<li><a href="' . get_permalink( $post_id ) . '" title="Перейти к ' . get_the_title( $post_id ) . '">' . get_the_title($post_id) . '</a> - ' . get_post_meta($post_id,'event_start_date',1) . '-' . get_post_meta($post_id,'event_end_date',1) . ' / ' . get_post_meta($post_id,'event_start_time',1) . ' - '  . get_post_meta($post_id,'event_end_time',1) . '</il>';
			}
			echo '</ul>';
		} ?>
	</div>
</div><!-- .wrapper-left -->

<div class="wrapper-right">
	<div class="column-3">
		<?php get_sidebar('single-column-3'); ?>	
	</div><!-- .column-3 -->
</div><!-- .wrapper-right -->
<?php get_footer(); ?>