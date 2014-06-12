(function ($) {
    $(function () {
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
        /*----------------------------------------------------------------------------*/
        /*//показывкаем вкладки
     /*----------------------------------------------------------------------------*/

        var $li = $('[data-li]'),
        $div = $('[data-li]') .children('.add-event-options');
        $li.click(function () {
            var indx = $li.index(this);
            $div.not(':eq(' + indx + ')') .slideUp();
            $div.eq(indx) .slideToggle('slow');
        });
        /*----------------------------------------------------------------------------*/
        /* //ajax в анонсах вкладки
     /*----------------------------------------------------------------------------*/
        $('[data-event]') .click(function () {
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
            });
        });
        /*----------------------------------------------------------------------------*/
        /* ajax вкладки пагинация
     /*----------------------------------------------------------------------------*/
        var data;
        $(document) .on('click', 'span.pagin-linc.main-pg', function (e) {
            e.preventDefault();
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
            });
        });
        /*----------------------------------------------------------------------------*/
        /*Период
     /*----------------------------------------------------------------------------*/
        $('button.date-button') .click(function (event) {
            var data = {
                action: 'cr_event_tabs_action',
                security: EventAjax.security,
                day_start: $('input#from-event') .val(),
                day_end: $('input#to-event') .val(),
                region_id: $('.cr-event-tabs') .attr('data-region'),
                data_type_event: $('.event-active') .attr('data-type-event')
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                alert(response);
                $('#cr-event-response') .html(response);
                crAjaxPaginator('period-pg');
            });
        });
        /*----------------------------------------------------------------------------*/
        /* Период пагинация*/
        ///////////////////////////////////////////////////////
        /*----------------------------------------------------------------------------*/
        var data;
        $(document) .on('click', 'span.pagin-linc.period-pg', function (e) {
            e.preventDefault();
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
            });
        });
        /*----------------------------------------------------------------------------*/
        /*Регион
     /*----------------------------------------------------------------------------*/
        $('select#location_region') .change(function () {
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
            });
        });
        /*----------------------------------------------------------------------------*/
        /* Регион пагинация*/
        ///////////////////////////////////////////////////////
        /*----------------------------------------------------------------------------*/
        var data;
        $(document) .on('click', 'span.pagin-linc.region-pg', function (e) {
            e.preventDefault();
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
            });
        });
        /*----------------------------------------------------------------------------*/
        /*Город
     /*----------------------------------------------------------------------------*/
        $('select#location_town') .change(function () {
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
            });
        });
        /*----------------------------------------------------------------------------*/
        /* Город пагинация*/
        ///////////////////////////////////////////////////////
        /*----------------------------------------------------------------------------*/
        var data;
        $(document) .on('click', 'span.pagin-linc.all-pg', function (e) {
            e.preventDefault();
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
            });
        });
        /*----------------------------------------------------------------------------*/
        /* Сегодня
     /*----------------------------------------------------------------------------*/
        $('[data-type-event]') .click(function () {
            $(this) .addClass('event-active') .siblings() .removeClass('event-active');
            var data = {
                action: 'cr_event_tabs_action',
                security: EventAjax.security,
                data_event: 'today',
                data_type_event: $(this) .attr('data-type-event')
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('today-pg');
            });
        });
        /*----------------------------------------------------------------------------*/
        /* Сегодня пагинация*/
        ///////////////////////////////////////////////////////
        /*----------------------------------------------------------------------------*/
        var data;
        $(document) .on('click', 'span.pagin-linc.today-pg', function (e) {
            e.preventDefault();
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
            });
        });
        /*----------------------------------------------------------------------------*/
        /* Расширенный фильтр
     /*----------------------------------------------------------------------------*/
        var data;
        $('form#advanced-filter-form') .submit(function (e) {
            e.preventDefault();
            var data = {
                action: 'cr_event_filter_action',
                security: EventAjax.security,
                data_form: $(this) .serialize(),
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('filter-pg');
            });
        });
        /*----------------------------------------------------------------------------*/
        /* Расширенный фильтр пагинация
     /*----------------------------------------------------------------------------*/
        var data;
        $(document) .on('click', 'span.pagin-linc.filter-pg', function (e) {
            alert($(this) .attr('data-pagin'));
            e.preventDefault();
            var data = {
                action: 'cr_event_filter_action',
                security: EventAjax.security,
                data_form: $(this) .serialize(),
                data_page: $(this) .attr('data-pagin'),
            };
            $.post(EventAjax.ajaxurl, data, function (response) {
                $('#cr-event-response') .html(response);
                crAjaxPaginator('filter-pg');
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
    });
}) (jQuery)