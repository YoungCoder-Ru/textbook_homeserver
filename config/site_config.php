<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

define('SITE_URL', $_ENV['SITE_URL']);

define('PAGES', json_decode($_ENV['PAGES'], true));

define('MENU_ITEMS', array_filter([
    ['name'=> 'blog', 'url' => 'https://blog.youngcoder.ru', 'text' => 'Блог'],
    ['name'=> 'how-to-learn', 'url' => '/how-to-learn.php', 'text' => 'Как&nbsp;учиться?'],
    ['name'=> 'map', 'url' => '/map.php', 'text' => 'Карта'],
    ['name'=> 'tasks', 'url' => '/tasks.php', 'text' => 'Задачи'],
    ['name'=> 'donate', 'url' => '/donate.php', 'text' => 'Ваша&nbsp;поддержка'],
    ['name'=> 'team', 'url' => '/team.php', 'text' => 'Команда'],
    ['name'=> 'about', 'url' => '/about.php', 'text' => 'О&nbsp;проекте'],
], function($item){
    return in_array($item['name'], PAGES);
}));

$blocks = json_decode($_ENV['BLOCKS'], true);
define('BLOCKS', $blocks);

$required_modules = [
    'pages' => [
        'blog' => [],
        'how-to-learn' => [],
        'map' => [],
        'tasks' => [],
        'donate' => [],
        'team' => ['database'],
        'about' => ['stepik_api'],
    ],
    'blocks' => [
        'donate_button' => [],
        'gloryhall' => ['database', 'gloryhall_usertop'],
        'announcement' => [],
        'share_buttons' => [],
        'last_donations' => ['database', 'donations'],
        'comments' => [],
        'metrika' => [],
    ],
];

$modules = [];

foreach (PAGES as $page) {
    if (isset($required_modules['pages'][$page])) {
        $modules = array_merge($modules, $required_modules['pages'][$page]);
    }
}

foreach ($blocks as $block) {
    if (isset($required_modules['blocks'][$block])) {
        $modules = array_merge($modules, $required_modules['blocks'][$block]);
    }
}

$modules = array_unique($modules);

DEFINE('MODULES', $modules);

?>