(function ($) {
    $(function () {
        $('body').append("<div class='cr-font-loader'></div>");
        //активируем вкладки
        $('#tabs') .tabs();
        //активируем датапикеры
        $('#from-event') .datepicker({
            //defaultDate: '+1w',
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            dayNames: [
                'Понедельник',
                'Вторник',
                'Среда',
                'Четверг',
                'Пятница',
                'Суббота',
                'Воскресеннье'
            ],
            dayNamesMin: [
                'Вс',
                'Пн',
                'Вт',
                'Ср',
                'Чт',
                'Пт',
                'Сб'
            ],
            monthNamesShort: [
                'Янв',
                'Фев',
                'Мар',
                'Апр',
                'Май',
                'Июн',
                'Июл',
                'Авг',
                'Сен',
                'Окт',
                'Ноя',
                'Дек'
            ],
            changeYear: true,
            onClose: function (selectedDate) {
                $('#to-event') .datepicker('option', 'minDate', selectedDate);
            }
        });
        $('#to-event') .datepicker({
            // defaultDate: '+1w',
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            dayNames: [
                'Понедельник',
                'Вторник',
                'Среда',
                'Четверг',
                'Пятница',
                'Суббота',
                'Воскресеннье'
            ],
            dayNamesMin: [
                'Вс',
                'Пн',
                'Вт',
                'Ср',
                'Чт',
                'Пт',
                'Сб'
            ],
            monthNamesShort: [
                'Янв',
                'Фев',
                'Мар',
                'Апр',
                'Май',
                'Июн',
                'Июл',
                'Авг',
                'Сен',
                'Окт',
                'Ноя',
                'Дек'
            ],
            changeYear: true,
            onClose: function (selectedDate) {
                $('#from-event') .datepicker('option', 'maxDate', selectedDate);
            }
        });
        $('#from-event-in') .datepicker({
            //defaultDate: '+1w',
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            dayNames: [
                'Понедельник',
                'Вторник',
                'Среда',
                'Четверг',
                'Пятница',
                'Суббота',
                'Воскресеннье'
            ],
            dayNamesMin: [
                'Вс',
                'Пн',
                'Вт',
                'Ср',
                'Чт',
                'Пт',
                'Сб'
            ],
            monthNamesShort: [
                'Янв',
                'Фев',
                'Мар',
                'Апр',
                'Май',
                'Июн',
                'Июл',
                'Авг',
                'Сен',
                'Окт',
                'Ноя',
                'Дек'
            ],
            changeYear: true,
            onClose: function (selectedDate) {
                $('#to-event-in') .datepicker('option', 'minDate', selectedDate);
            }
        });
        $('#to-event-in') .datepicker({
            // defaultDate: '+1w',
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            dayNames: [
                'Понедельник',
                'Вторник',
                'Среда',
                'Четверг',
                'Пятница',
                'Суббота',
                'Воскресеннье'
            ],
            dayNamesMin: [
                'Вс',
                'Пн',
                'Вт',
                'Ср',
                'Чт',
                'Пт',
                'Сб'
            ],
            monthNamesShort: [
                'Янв',
                'Фев',
                'Мар',
                'Апр',
                'Май',
                'Июн',
                'Июл',
                'Авг',
                'Сен',
                'Окт',
                'Ноя',
                'Дек'
            ],
            changeYear: true,
            onClose: function (selectedDate) {
                $('#from-event-in') .datepicker('option', 'maxDate', selectedDate);
            }
        });
        $('#ui-datepicker-div,.add-event-options input,.add-event-options select') .click(function (event) {
            event.stopPropagation();
        });
        /*----------------------------------------------------------------------------*/
        /*//обработка пагинации под ajax
     /*----------------------------------------------------------------------------*/
        function crAjaxPaginator($class) {
            $('a.page-numbers') .each(function (indx) {
                $url = $(this) .html();
                $(this) .after('<span class="pagin-linc ' + $class + '" data-pagin="' + $url + '">' + $url + '</span>');
                $(this) .remove();
            });
            $('.page-numbers.current') .removeClass('page-numbers') .removeClass('page-numbers') .addClass('pagin-linc') .addClass('current-page');
            $('[data-pagin="»"]') .attr('data-pagin', parseInt($('.current-page') .html()) + 1);
            $('[data-pagin="«"]') .attr('data-pagin', parseInt($('.current-page') .html()) - 1);
        }

        crAjaxPaginator('def-pg');

         /*----------------------------------------------------------------------------*/
        /* ajax вкладки пагинация по дефолту
     /*----------------------------------------------------------------------------*/
        var data;
        $(document) .on('click', 'span.pagin-linc.def-pg', function (e) {
            $('.cr-font-loader').show('fast');
            e.preventDefault();
            var data = {
                action: 'cr_event_default_action',
                security: EventAjax.security,
                data_page: $(this) .attr('data-pagin'),
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('def-pg');
                $('.cr-font-loader').hide('fast');
            });
        });

        /*----------------------------------------------------------------------------*/
        /*//показывкаем вкладки
     /*----------------------------------------------------------------------------*/

        var $li = $('[data-li]'),
        $div = $('[data-li]') .children('.add-event-options');

        $li.click(function () {
            $(this).addClass('actual-filtred').siblings('[data-event],[data-li]').removeClass('actual-filtred');
            var indx = $li.index(this);
            $div.not(':eq(' + indx + ')') .slideUp();
            $div.eq(indx) .slideToggle('slow');
        });
        /*----------------------------------------------------------------------------*/
        /* //ajax в анонсах вкладки
     /*----------------------------------------------------------------------------*/
        $('[data-event]') .click(function () {
            $('.add-event-options').slideUp('slow');
            $(this).addClass('actual-filtred').siblings('[data-event],[data-li]').removeClass('actual-filtred');
            $('.cr-font-loader').show('fast');
            var data = {
                action: 'cr_event_tabs_action',
                security: EventAjax.security,
                data_event: $(this) .attr('data-event'),
                region_id: $('.cr-event-tabs') .attr('data-region'),
                data_type_event: $('.event-active') .attr('data-type-event')
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('main-pg');
                $('.cr-font-loader').hide('fast');
            });
        });
        /*----------------------------------------------------------------------------*/
        /* ajax вкладки пагинация
     /*----------------------------------------------------------------------------*/
        var data;
        $(document) .on('click', 'span.pagin-linc.main-pg', function (e) {
            e.preventDefault();
            $('.cr-font-loader').show('fast');
            var data = {
                action: 'cr_event_tabs_action',
                security: EventAjax.security,
                data_event: $(this) .attr('data-event'),
                region_id: $('.cr-event-tabs') .attr('data-region'),
                data_type_event: $('.event-active') .attr('data-type-event'),
                data_page: $(this) .attr('data-pagin'),
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('main-pg');
                $('.cr-font-loader').hide('fast');
            });
        });
        /*----------------------------------------------------------------------------*/
        /*Период
     /*----------------------------------------------------------------------------*/
        $('button.date-button') .click(function (event) {
            $(this).children('.add-event-options').slideUp('slow');
            $('.cr-font-loader').show('fast');
            var data = {
                action: 'cr_event_tabs_action',
                security: EventAjax.security,
                day_start: $('input#from-event') .val(),
                day_end: $('input#to-event') .val(),
                region_id: $('.cr-event-tabs') .attr('data-region'),
                data_type_event: $('.event-active') .attr('data-type-event')
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('period-pg');
                $('.cr-font-loader').hide('fast');
            });
        });
        /*----------------------------------------------------------------------------*/
        /* Период пагинация*/
        ///////////////////////////////////////////////////////
        /*----------------------------------------------------------------------------*/
        var data;
        $(document) .on('click', 'span.pagin-linc.period-pg', function (e) {
            e.preventDefault();
            $('.cr-font-loader').show('fast');
            var data = {
                action: 'cr_event_tabs_action',
                security: EventAjax.security,
                day_start: $('input#from-event') .val(),
                day_end: $('input#to-event') .val(),
                region_id: $('.cr-event-tabs') .attr('data-region'),
                data_type_event: $('.event-active') .attr('data-type-event'),
                data_page: $(this) .attr('data-pagin'),
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('period-pg');
                $('.cr-font-loader').hide('fast');
            });
        });
        /*----------------------------------------------------------------------------*/
        /*Регион
     /*----------------------------------------------------------------------------*/
        $('select#location_region') .change(function () {
            $(this).children('.add-event-options').slideUp('slow');
            $('.cr-font-loader').show('fast');
            var data = {
                action: 'cr_event_tabs_action',
                security: EventAjax.security,
                region_id: $(this) .val(),
                data_event: 'all-anonses',
                data_type_event: $('.event-active') .attr('data-type-event')
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('region-pg');
                $('.cr-font-loader').hide('fast');
            });
        });
        /*----------------------------------------------------------------------------*/
        /* Регион пагинация*/
        ///////////////////////////////////////////////////////
        /*----------------------------------------------------------------------------*/
        var data;
        $(document) .on('click', 'span.pagin-linc.region-pg', function (e) {
            e.preventDefault();
            $('.cr-font-loader').show('fast');
            var data = {
                action: 'cr_event_tabs_action',
                security: EventAjax.security,
                region_id: $(this) .val(),
                data_event: 'all-anonses',
                data_type_event: $('.event-active') .attr('data-type-event'),
                data_page: $(this) .attr('data-pagin'),
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('region-pg');
                $('.cr-font-loader').hide('fast');
            });
        });

        /*********************/
        /* тема
        /****************************/

        $('select#location_theme') .change(function () {
            $(this).children('.add-event-options').slideUp('slow');
            $('.cr-font-loader').show('fast');
            var data = {
                action: 'cr_event_tabs_action',
                security: EventAjax.security,
                theme_id: $(this) .val(),
                //data_event: 'all-anonses',
                data_type_event: $('.event-active') .attr('data-type-event')
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('region-tn');
                $('.cr-font-loader').hide('fast');
            });
        });
        /*----------------------------------------------------------------------------*/
        /* Регион пагинация*/
        ///////////////////////////////////////////////////////
        /*----------------------------------------------------------------------------*/
        var data;
        $(document) .on('click', 'span.pagin-linc.region-tn', function (e) {
            e.preventDefault();
            $('.cr-font-loader').show('fast');
            var data = {
                action: 'cr_event_tabs_action',
                security: EventAjax.security,
                theme_id: $(this) .val(),
                data_event: 'all-anonses',
                data_type_event: $('.event-active') .attr('data-type-event'),
                data_page: $(this) .attr('data-pagin'),
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('region-tn');
                $('.cr-font-loader').hide('fast');
            });
        });
        /*----------------------------------------------------------------------------*/
        /*Город
     /*----------------------------------------------------------------------------*/
        $('select#location_town') .change(function () {
            $('.add-event-options').slideUp('slow');
            $('.cr-font-loader').show('fast');
            var data = {
                action: 'cr_event_tabs_action',
                security: EventAjax.security,
                town: $(this) .val(),
                data_event: 'all-anonses',
                data_type_event: $('.event-active') .attr('data-type-event')
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('all-pg');
                $('.cr-font-loader').hide('fast');
            });
        });
        /*----------------------------------------------------------------------------*/
        /* Город пагинация*/
        ///////////////////////////////////////////////////////
        /*----------------------------------------------------------------------------*/
        var data;
        $(document) .on('click', 'span.pagin-linc.all-pg', function (e) {
            e.preventDefault();
            $('.cr-font-loader').show('fast');
            var data = {
                action: 'cr_event_tabs_action',
                security: EventAjax.security,
                town: $(this) .val(),
                data_event: 'all-anonses',
                data_type_event: $('.event-active') .attr('data-type-event'),
                data_page: $(this) .attr('data-pagin'),
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('all-pg');
                $('.cr-font-loader').hide('fast');
            });
        });
        /*----------------------------------------------------------------------------*/
        /* Сегодня
     /*----------------------------------------------------------------------------*/
        $('[data-type-event]') .click(function () {
            $('.add-event-options').slideUp('slow');
            $(this) .addClass('event-active') .siblings() .removeClass('event-active');
            $('*').removeClass('actual-filtred');
            $('[data-event="today"]').addClass('actual-filtred');
            $('.cr-font-loader').show('fast');
            var data = {
                action: 'cr_event_tabs_action',
                security: EventAjax.security,
                data_event: 'today',
                data_type_event: $(this) .attr('data-type-event')
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('today-pg');
                $('.cr-font-loader').hide('fast');
            });
        });
        /*----------------------------------------------------------------------------*/
        /* Сегодня пагинация*/
        ///////////////////////////////////////////////////////
        /*----------------------------------------------------------------------------*/
        var data;
        $(document) .on('click', 'span.pagin-linc.today-pg', function (e) {
            e.preventDefault();
            $('.cr-font-loader').show('fast');
            var data = {
                action: 'cr_event_tabs_action',
                security: EventAjax.security,
                data_event: 'today',
                data_type_event: $(this) .attr('data-type-event'),
                data_page: $(this) .attr('data-pagin'),
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('today-pg');
                $('.cr-font-loader').hide('fast');
            });
        });
        /*----------------------------------------------------------------------------*/
        /* Расширенный фильтр
     /*----------------------------------------------------------------------------*/
        var data;
        $('form#advanced-filter-form') .submit(function (e) {
            e.preventDefault();
            $('.cr-font-loader').show('fast');
            var data = {
                action: 'cr_event_filter_action',
                security: EventAjax.security,
                data_form: $(this) .serialize(),
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('filter-pg');
                $('.cr-font-loader').hide('fast');
            });
        });
        /*----------------------------------------------------------------------------*/
        /* Расширенный фильтр пагинация
     /*----------------------------------------------------------------------------*/
        var data;
        $(document) .on('click', 'span.pagin-linc.filter-pg', function (e) {
            e.preventDefault();
            $('.cr-font-loader').show('fast');
            var data = {
                action: 'cr_event_filter_action',
                security: EventAjax.security,
                data_form: $(this) .serialize(),
                data_page: $(this) .attr('data-pagin'),
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('filter-pg');
                $('.cr-font-loader').hide('fast');
            });
        });

        /*-------------------------------------------------------------------------------*/
        /* Простой фильтр
        /------------------------------------------------------------------------------*/

        $(document) .on('click', 'span.all-filters-button', function (e) {
            e.preventDefault();
            $('.cr-font-loader').show('fast');
            var data = {
                action: 'cr_event_ide_filter_action',
                security: EventAjax.security,
                data_filters: $(this) .attr('data-type'),
            };

            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('filter-pa');
                $('.cr-font-loader').hide('fast');
            });

        });

        /*-------------------------------------------------------------------------------*/
        /* Простой фильтр пагинация
        /------------------------------------------------------------------------------*/
          var data;
        $(document) .on('click', 'span.pagin-linc.filter-pa', function (e) {
            e.preventDefault();
            $('.cr-font-loader').show('fast');
            var data = {
                action: 'cr_event_ide_filter_action',
                security: EventAjax.security,
                data_filters: $(this) .attr('data-type'),
                data_page: $(this) .attr('data-pagin'),
            };

            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('filter-pa');
                $('.cr-font-loader').hide('fast');
            });

        });
        /*----------------------------------------------------------------------------*/
        /* Показать, скрыть форму
         /*----------------------------------------------------------------------------*/
        $('.advanced-filter') .click(function () {
            $('#advanced-filter-form') .slideToggle('slow');
        });
        //сбросить форму
        $('.table-reser') .click(function () {
            $('#advanced-filter-form') .trigger('reset');
        });
        // закрыть форму
        $('.table-close') .click(function () {
            $('#advanced-filter-form') .slideUp();
        });

        function checkedData(){
            var selectedItems = new Array();
            $('input[name="location_region[]"]:checked').each(function(){
                selectedItems.push($(this).val());
                
            });
            return selectedItems;
        }

        /* обработка регион-город */
        $(document).on('change', '[name="location_region[]"]',function() {

            var data = {
                action: 'cr_event_checkbox_action',
                security: EventAjax.security,
                data_ids:checkedData(),
            };

             $.post(EventAjax.ajaxurl, data, function (response) {
                $('ul.filtred-town-respons') .html(response);
            });

        });

    });
}) (jQuery)