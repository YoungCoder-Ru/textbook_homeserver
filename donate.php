<?php

require_once __DIR__ . '/config/site_config.php';


$isMainPage = false;
$title_page = 'Как помочь проекту YoungCoder.Ru.';
$canonical_pagelink = SITE_URL.'/donate.php';
$description_page = 'Варианты вашего участия в реализации проекта YoungCoder.Ru: от донатов до работы над сайтом и группой ВКонтакте.';
$keywords_page = 'Как помочь проекту youngcoder.ru';


ob_start();
include 'pages/donate_content.php';


$content = ob_get_clean();
   
include 'templates/basepage.php';
?>