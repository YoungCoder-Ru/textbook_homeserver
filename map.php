<?php

require_once __DIR__ . '/config/site_config.php';
require_once __DIR__ . '/lessons_api/content_manager.php';

$isMainPage = false;
$title_page = 'Карта курса по основам программирования на Си.';
$canonical_pagelink = SITE_URL.'/map.php';
$description_page = 'Программа базового курса для начинающих  «Основы программирования и алгоритмизации на языке Си». Курс программированию на языке Си расчитаный на начинающих.';
$keywords_page = 'уроки по программированию, программа курса, разделы учебника по Си, основы программирования ';

$map_data = prepare_map_data('lang_c');
$map_data_ide = prepare_map_data('ide');
$map_data_manuals = prepare_map_data('manuals');

ob_start();
include 'pages/map_content.php';
$content = ob_get_clean();
   
include 'templates/basepage.php';
?>