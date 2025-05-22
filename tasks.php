<?php

require_once __DIR__ . '/config/site_config.php';

$isMainPage = false;
$title_page = 'Задачи по программированию с автоматической проверкой. Язык Си.';
$canonical_pagelink = SITE_URL.'/tasks.php';
$description_page = 'Задачи по программированию с автоматической проверкой на языке Си для новичков. Подборка задач на различные аспекты синтаксиса языка программирования Си и основы алгоритмизации.';
$keywords_page = 'задачи по программированию, задачи си, задачи с автоматической проверкой, задачи по программированию для новичков';


ob_start();
include 'pages/tasks_content.php';
$content = ob_get_clean();
   
include 'templates/basepage.php';
?>