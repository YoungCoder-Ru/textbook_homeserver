<?php
require_once __DIR__ . '/config/site_config.php';
require_once __DIR__ . '/lessons_api/content_manager.php';

$isMainPage = true;
$title_page = 'YoungCoder — бесплатный online курс для обучения основам программирования на Си';
$canonical_pagelink = SITE_URL;
$description_page = 'Бесплатный онлайн-курс по основая программирования на языке Си. 10 уроков, который помогут вам освоить базовые конструкции языка программирования Си.';
$keywords_page = 'Язык Си, C, онлайн-курс Си, учебник по Си, основы программирования, как стать программистом';


$map_data = prepare_map_data('lang_c');
$map_data_ide = prepare_map_data('ide');

include 'templates/basepage.php';
?>