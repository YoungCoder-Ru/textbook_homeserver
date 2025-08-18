<?php

require_once __DIR__ . '/site_config.php';

// Базовые пути
define('SERVER_ROOT_DIRECTORY', $_SERVER['DOCUMENT_ROOT']);

// Директории статей и уроков
define('SERVER_ARTICLES_DIRECTORY', SERVER_ROOT_DIRECTORY . '/materials/');
define('SITE_ARTICLES_DIRECTORY', SITE_URL . '/materials/');
define('SITE_LESSONS_DIRECTORY', SITE_URL . '/lessons/');

// Имена файлов
define('INDEX_FILENAME', 'index.md');
define('ARTICLE_FILENAME', 'article.md');
define('PRACTICE_FILENAME', 'practice.md');
define('REFERENCE_FILENAME', 'reference.md');
define('METADATA_FILENAME', 'meta.json');


define('CACHE_DIRS', [
    'lang_c' => __DIR__ . '/../cache/lessons/',
    'ide' => __DIR__ . '/../cache/ide/',
    'manuals' => __DIR__ . '/../cache/manuals/',
    'sandbox' => __DIR__ . '/../cache/sandbox/',
]);


?>