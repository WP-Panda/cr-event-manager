<?php
	function cr_event_anonses_table() {
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-datepicker');
$ip_array = get_conwert_ip_too_region();
				$region_id = $ip_array['region_id'];
?>
<div id="cr-event-tabs" data-region='<?php echo $region_id; ?>'>
	<button class='advanced-filter none-filter'><?php _e('Расширенный Фильтр','wp_panda') ?></button>
	<div class="icall-block-filter">
		<a href="<?php echo home_url('/');?>wp-content/evens/tmp_events/all-events.ics" title="<?php _e('Скачать iCal (все мероприятия)','wp_panda' ); ?>" class="doun-ical-filter"><?php _e('Скачать iCal (все мероприятия)','wp_panda'); ?></a>
		<a href="" class="support-filter"><?php _e('Справка','wp_panda'); ?></a>
		<input type="text" class="link-ical-filter" value='<?php echo home_url('/');?>wp-content/evens/tmp_events/all-events.ics'>
	</div>
	<form id='advanced-filter-form'>
		<table>
			<tbody>
				<tr>
						<h3 class='table-title'><?php _e('Расширенный фильтр анонсов','wp_panda') ?></h3>
							<span class='table-reser'><?php _e('Очистить','wp_panda') ?></span>
							<span class='table-close'><?php _e('Закрыть','wp_panda') ?></span>
				</tr>
				<tr>
					<td class="lebel"><label for='cr-ev-keywords'>Ключевые слова</label></td>
					<td><input type='text' id='cr-ev-keywords' class='cr-ev-keywords' name='cr-ev-keywords' value=''></td>
				</tr>
				<?php $categories = get_categories('orderby=name&taxonomy=event-categories');
					 if ( count( $categories ) > 0) {
						echo "<tr>";
						echo "<td class='lebel'><h3>" . __('Вид мероприятия','wp_panda') . "</h3></td>";
						echo "<td><ul>";
						foreach ($categories as $category ) {
							$term_link = get_term_link( $category->slug, 'event-categories' );
						   echo "<li><input type='checkbox' name='cr-ev-categories[]'  class='cr-ev-categories' value='" . $category->term_id ."' /><a href='" . $term_link . "' title='".$category->name . "'>" . $category->name . "</a></li>";
						}
						echo "</ul></td>";
						echo "</tr>";
				} ?>				
				<?php $categories = get_categories('orderby=name&taxonomy=event-tag');
					 if ( count( $categories ) > 0) {
						echo "<tr>";
						echo "<td class='lebel'><h3>" . __('Тема','wp_panda') . "</h3></td>";
						echo "<td><ul>";
						foreach ($categories as $category ) {
							$term_link = get_term_link( $category->slug, 'event-tag' );
						   echo "<li><input type='checkbox' name='cr-ev-tag[]'  class='cr-ev-tag' value='" . $category->term_id ."' /><a href='" . $term_link . "' title='".$category->name . "'>" . $category->name . "</a></li>";
						}
						echo "</ul></td>";
						echo "</tr>";
				} ?>
				<tr>
					<td class='lebel'><h3><?php _e('Регион','wp_panda'); ?></h3></td>
					<td><ul><?php echo get_meta_values('location_region','checkbox', 'location') ?></ul></td>
				</tr>
				<tr>
					<td class='lebel'><h3><?php _e('Город','wp_panda'); ?></h3></td>
					<td><ul><?php echo get_meta_values('location_town','checkbox') ?></ul></td>
				</tr>
				<tr>
					<td class='lebel'><h3><?php _e('Дата анонса','wp_panda'); ?></h3></td>
					<td>
						<ul class='date-selector'>
							<li><input type="radio" name="cr-ev-date" value="all"><?php _e('Показать всесе активные анонсы','wp_panda') ?></li>
							<li><input type="radio" name="cr-ev-date" value="today"><?php _e('Показать анонсы на  сегодня','wp_panda') ?></li>
							<li><input type="radio" name="cr-ev-date" value="tomorrow"><?php _e('Показать анонсы на завтра','wp_panda') ?></li>
							<li><input type="radio" name="cr-ev-date" value="past"><?php _e('Показать прошедшие ананонсы') ?></li>
							<li>
								<input type="radio" name="cr-ev-date" value="in-date"><?php _e('Показать все анонсы за период') ?></br>
								<label for="from-event-in"><?php _e('От','wp_panda'); ?></label>
								<input type="text" id="from-event-in" name="from-event-in">
								<label for="to-event-in"><?php _e('До','wp_panda'); ?></label>
								<input type="text" id="to-event-in" name="to-event-in">
							</li>
						</ul>
					</td>
				</tr>
			</tbody>
		</table>
		<button class="submit-filter"><?php _e('Применить фильтр','wp_panda'); ?></button>
	</form>
	<ul class='cr-event-tabs-head'>
		<li data-type-event='all'><?php _e('Все анонсы','wp_panda'); ?></a></li>
		<li data-type-event='event'><?php _e('Пресс-мероприятия','wp_panda'); ?></a></li>
		<li data-type-event='developments'><?php _e('События','wp_panda'); ?></a></li>
		<li data-type-event='exhibitions'><?php _e('Выставки','wp_panda');?></a></li>
		<li data-type-event='concerts'><?php _e('Визиты','wp_panda'); ?> </a></li>
		<li data-type-event='visits'><?php _e('Концерты','wp_panda'); ?></a></li>
		<li data-type-event='other'><?php _e('ПРОЧЕЕ','wp_panda'); ?></a></li>
	</ul>
	
	<div id="cr-event-tabs-body">
	<ul class='event-select'>
		<li data-event='today'> <span><?php _e('на сегодня','wp_panda') ?></span></li>
		<li data-event='tomorrow'><span><?php _e('на завтра','wp_panda') ?></span></li>
		<li data-li='to-date'>
			<span><?php _e('на дату','wp_panda') ?></span>
			<div class='add-event-options slide-date-select'>
				<label for="from-event"><?php _e('От','wp_panda'); ?></label>
				<input type="text" id="from-event" name="from-event">
				<label for="to-event"><?php _e('До','wp_panda'); ?></label>
				<input type="text" id="to-event" name="to-event">
				<button class='date-button'><?php _e('Cортировать','wp_panda') ?></button>
			</div>
		</li>
		<li data-event='all-anonses'> <span><?php _e('все анонсы','wp_panda') ?></span></li>
		<li data-li='themes'><span><?php _e('выбрать тему','wp_panda'); ?></span>
			<div class='add-event-options'>
				<select id="location_theme">
					<? foreach ($categories as $category ) {
							$term_link = get_term_link( $category->slug, 'event-categories' );
						   echo "<option value='" . $category->term_id ."' >".$category->name  . "</option>";
					} ?>
				</select>
			</div>
		</li>
		<li data-li='location-region'><span><?php _e('выбрать регион','wp_panda') ?></span>
			<div class='add-event-options'>
				<select id="location_region">
					<? echo get_meta_values( 'location_region' ); ?>
				</select>
			</div>
		</li>
		<li data-li='location-town'><span><?php _e('выбрать город','wp_panda') ?></span>
			<div class='add-event-options'>
				<select id="location_town">
					<? echo get_meta_values( 'location_town','select' ); ?>
				</select>
			</div>
		</li>
	</ul>
		<div id="cr-event-response">
			<?php 
			 cr_todays_events_tabs();
			 ?>
		 </div>
	</div>
</div>
<?php }

add_shortcode ( 'cr_event_anonses_table','cr_event_anonses_table');