<?php function cr_first_vizit_style() {
    if( $_COOKIE['regions'] )
        return;
 ?>

<style>
    
#mask {
    background-color: #000;
    display: none;
    left: 0;
    position: absolute;
    top: 0;
    z-index: 9000;
}
#boxes .window {
    display: none;
    height: 200px;
    left: 0;
    overflow: hidden;
    padding: 20px;
    position: fixed;
    top: 0;
    width: 440px;
    z-index: 9999;
}
#boxes #dialog {
    background-color: #ffffff;
    height: 203px;
    padding: 10px;
    width: 375px;
}
.top {
    border-bottom: 1px solid;
    height: 35px;
    left: 0;
    padding: 8px 20px 6px 10px;
    position: absolute;
    top: 0;
    width: 100%;
}
.close {
    border-left: 1px solid;
    cursor: pointer;
    height: 100%;
    padding: 0 7px;
    position: absolute;
    right: 0;
    top: 0;
    width: 70px;
}

.close:before {
    font-size: 3rem;
    padding-right: 2rem;
}
    .content-wd {
    padding-top: 54px;
}
</style>
<?php }

	function cr_first_vizit_data() { 
         if( $_COOKIE['regions'] )
        return;
        wp_enqueue_style( 'dashicons' );
    ?>

    

    <!-- Само окно -->
<div id="boxes">  
    <div id="dialog" class="window">
        <div class="top">Ваш регион.<i class="link close dashicons dashicons-no-alt"></i></div>
        <?php  $ip_array  = get_conwert_ip_too_region();
        $region_id = $ip_array['region_id'];
        if ( !empty( $region_id ) ) { 
            $region_name = get_region_select($region_id);
            $text = "Ваш регион  - " . $region_name . ",<br>если регион определен не правильно выберите правильный";
        } else {
             $text = "Ваш регион не определен <br>выберите регион";
        } ?>
        
        <div class="content-wd"><?php echo $text; ?><br><br>
            <input type="hidden" class='regon_cookies' name="regon_cookies" value="<?php echo $region_id; ?>">
            <select name="regione" class='regione'>
            <option value='1'><?php  _e('Республика Адыгея','wp_panda'); ?></option>
            <option value='3'><?php  _e('Республика Алтай','wp_panda'); ?></option>
            <option value='4'><?php  _e('Алтайский край','wp_panda'); ?></option>
            <option value='5'><?php  _e('Амурская область','wp_panda'); ?></option>     
            <option value='6'><?php  _e('Архангельская область','wp_panda'); ?></option>        
            <option value='7'><?php  _e('Астраханская область','wp_panda'); ?></option> 
            <option value='8'><?php  _e('Республика Башкортостан ','wp_panda'); ?></option>         
            <option value='9'><?php  _e('Белгородская область','wp_panda'); ?></option>
            <option value='10'><?php  _e('Брянская область','wp_panda'); ?></option>
            <option value='11'><?php  _e('Республика Бурятия','wp_panda'); ?></option>          
            <option value='13'><?php  _e('Челябинская область','wp_panda'); ?></option>     
            <option value='14'><?php  _e('Забайкальский край','wp_panda'); ?></option>  
            <option value='15'><?php  _e('Чукотский автономный округ','wp_panda'); ?></option>          
            <option value='16'><?php  _e('Чувашская Республика','wp_panda'); ?></option>            
            <option value='17'><?php  _e('Республика Дагестан','wp_panda'); ?></option> 
            <option value='19'><?php  _e('Республика Ингушетия','wp_panda'); ?></option>        
            <option value='20'><?php  _e('Иркутская область','wp_panda'); ?></option>           
            <option value='21'><?php  _e('Ивановская область','wp_panda'); ?></option>      
            <option value='22'><?php  _e('Республика Кабардино-Балкария','wp_panda'); ?></option>   
            <option value='23'><?php  _e('Калининградская область','wp_panda'); ?></option> 
            <option value='24'><?php  _e('Республика Калмыкия','wp_panda'); ?></option> 
            <option value='25'><?php  _e('Калужская область','wp_panda'); ?></option>   
            <option value='26'><?php  _e('Камчатский край','wp_panda'); ?></option>     
            <option value='27'><?php  _e('Республика Карачаево-Черкессия','wp_panda'); ?></option>      
            <option value='28'><?php  _e('Республика Карелия','wp_panda'); ?></option>  
            <option value='29'><?php  _e('Кемеровская область','wp_panda'); ?></option>     
            <option value='30'><?php  _e('Хабаровский край','wp_panda'); ?></option>
            <option value='31'><?php  _e('Республика Хакасия','wp_panda'); ?></option>      
            <option value='32'><?php  _e('Ханты-Мансийский автономный округ','wp_panda'); ?></option>           
            <option value='33'><?php  _e('Кировская область','wp_panda'); ?></option>       
            <option value='34'><?php  _e('Республика Коми','wp_panda'); ?></option>         
            <option value='35'><?php  _e('Пермский край','wp_panda'); ?></option>       
            <option value='36'><?php  _e('Камчатский край','wp_panda'); ?></option>         
            <option value='37'><?php  _e('Костромская область','wp_panda'); ?></option>     
            <option value='38'><?php  _e('Краснодарский край','wp_panda'); ?></option>      
            <option value='39'><?php  _e('Красноярский край','wp_panda'); ?></option>           
            <option value='40'><?php  _e('Курганская область','wp_panda'); ?></option>          
            <option value='41'><?php  _e('Курская область','wp_panda'); ?></option>     
            <option value='42'><?php  _e('Санкт-Петербург','wp_panda'); ?></option>             
            <option value='43'><?php  _e('Липецкая область','wp_panda'); ?></option>            
            <option value='44'><?php  _e('Магаданская область','wp_panda'); ?></option>     
            <option value='45'><?php  _e('Республика Марий Эл','wp_panda'); ?></option>     
            <option value='46'><?php  _e('Республика Мордовия','wp_panda'); ?></option>     
            <option value='47'><?php  _e('Московская область','wp_panda'); ?></option>
            <option value='48'><?php  _e('Москва','wp_panda'); ?></option>
            <option value='49'><?php  _e('Мурманская область','wp_panda'); ?></option>          
            <option value='50'><?php  _e('Ненецкий автономный округ','wp_panda'); ?></option>           
            <option value='51'><?php  _e('Нижегородская область','wp_panda'); ?></option>       
            <option value='52'><?php  _e('Новгородская область','wp_panda'); ?></option>    
            <option value='53'><?php  _e('Новосибирская область','wp_panda'); ?></option>       
            <option value='54'><?php  _e('Омская область','wp_panda'); ?></option>
            <option value='55'><?php  _e('Оренбургская область','wp_panda'); ?></option>        
            <option value='56'><?php  _e('Орловская область','wp_panda'); ?></option>   
            <option value='57'><?php  _e('Пензенская область','wp_panda'); ?></option>      
            <option value='58'><?php  _e('Пермский край','wp_panda'); ?></option>   
            <option value='59'><?php  _e('Приморский край','wp_panda'); ?></option>         
            <option value='60'><?php  _e('Псковская область','wp_panda'); ?></option>           
            <option value='61'><?php  _e('Ростовская область','wp_panda'); ?></option>      
            <option value='62'><?php  _e('Рязанская область','wp_panda'); ?></option>
            <option value='63'><?php  _e('Республика Саха','wp_panda'); ?></option> 
            <option value='64'><?php  _e('Сахалинская область','wp_panda'); ?></option>         
            <option value='65'><?php  _e('Самарская область','wp_panda'); ?></option>           
            <option value='66'><?php  _e('Ленинградская область','wp_panda'); ?></option>               
            <option value='67'><?php  _e('Саратовская область','wp_panda'); ?></option>     
            <option value='68'><?php  _e('Республика Северная Осетия-Алания ','wp_panda'); ?></option>          
            <option value='69'><?php  _e('Смоленская область','wp_panda'); ?></option>      
            <option value='70'><?php  _e('Ставропольский край','wp_panda'); ?></option>         
            <option value='71'><?php  _e('Свердловская область','wp_panda'); ?></option>
            <option value='72'><?php  _e('Тамбовская область','wp_panda'); ?></option>
            <option value='73'><?php  _e('Республика Татарстан','wp_panda'); ?></option>        
            <option value='74'><?php  _e('Красноярский край','wp_panda'); ?></option>       
            <option value='75'><?php  _e('Томская область','wp_panda'); ?></option>     
            <option value='76'><?php  _e('Тульская область','wp_panda'); ?></option>        
            <option value='77'><?php  _e('Тверская область','wp_panda'); ?></option>        
            <option value='78'><?php  _e('Тюменская область','wp_panda'); ?></option>           
            <option value='79'><?php  _e('Республика Тыва','wp_panda'); ?></option> 
            <option value='80'><?php  _e('Республика Удмуртия','wp_panda'); ?></option>     
            <option value='81'><?php  _e('Ульяновская область','wp_panda'); ?></option>         
            <option value='82'><?php  _e('Иркутская область','wp_panda'); ?></option>           
            <option value='83'><?php  _e('Владимирская область','wp_panda'); ?></option>    
            <option value='84'><?php  _e('Волгоградская область','wp_panda'); ?></option>
            <option value='85'><?php  _e('Вологодская область','wp_panda'); ?></option>     
            <option value='86'><?php  _e('Воронежская область','wp_panda'); ?></option> 
            <option value='87'><?php  _e('Ямало-Ненецкий автономный округ','wp_panda'); ?></option>     
            <option value='88'><?php  _e('Ярославская область','wp_panda'); ?></option>     
            <option value='89'><?php  _e('Еврейская автономная область','wp_panda'); ?></option>            
            <option value='90'><?php  _e('Пермский край','wp_panda'); ?></option>           
            <option value='91'><?php  _e('Красноярский край','wp_panda'); ?></option>       
            <option value='92'><?php  _e('Красноярский край','wp_panda'); ?></option>           
            <option value='93'><?php  _e('Забайкальский край','wp_panda'); ?></option>          
            <option value='CI'><?php  _e('Республика  Чечня','wp_panda'); ?></option>
            </select>
        </div>
    </div>
</div>

<!-- Маска, затемняющая фон -->
<div id="mask"></div>


    <script type="text/javascript">
    	(function($) {
            $(document).ready(function() {  
                setTimeout(function () {
                    $(".regione [value='<?php echo $region_id; ?>']").attr("selected", "selected");
                    var id = $('#dialog');
                    var maskHeight = $(document).height();
                    var maskWidth = $(window).width();
                    $('#mask').css({'width':maskWidth,'height':maskHeight});
                    $('#mask').fadeIn(1000); 
                    $('#mask').fadeTo("slow",0.8); 
                    var winH = $(window).height();
                    var winW = $(window).width();
                    $(id).css('top',  winH/2-$(id).height()/2);
                    $(id).css('left', winW/2-$(id).width()/2);
                    $(id).fadeIn(2000); 
                }, 1);
                $('.window .close,#mask').click(function (e) { 
                    e.preventDefault();
                    var names = $(".regione :selected").val();
                    $(".regon_cookies").val(names);
                     $.cookie('regions', names, {  
                        expires: 365,  
                        path: '/'  
                    }); 
                    $('#mask, .window').fadeOut('slow');
                }); 

           });
        })( jQuery);
    </script>
<?php } 

add_action('cr_top_head','cr_first_vizit_style');
add_action('cr_top_head','cr_first_vizit_data');