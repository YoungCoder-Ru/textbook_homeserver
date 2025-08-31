<?php
require_once __DIR__ . '/config/site_config.php';
require_once __DIR__ . '/lessons_api/content_manager.php';

$isMainPage = true;
$title_page = 'Основы программирования (язык Си, C) для начинающих с нуля';
$canonical_pagelink = SITE_URL;
$description_page = 'Бесплатный онлайн-курс по изучению основ программирования на Си с нуля. 10 уроков и 296 практических задач с автоматической проверкой, которые помогут вам освоить базовые конструкции языка Си.';
$keywords_page = 'Язык Си, C, road map по Си, онлайн-курс Си, учебник по Си, си с нуля, основы программирования, как стать программистом';

$map_data = prepare_map_data('lang_c');
$map_data_ide = prepare_map_data('ide');
$map_data_manuals = prepare_map_data('manuals');

include 'templates/basepage.php';
?>