<?php 
	function get_region_select($x) {
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
	}	