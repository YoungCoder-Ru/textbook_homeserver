<?php
declare(strict_types=1);

/**
 * Файл lessons.php обрабатывает ссылки вида: 
 *    /lessons/%NUMBER_OF_LESSON%/%NAME_OF_ARTICLE%
 *    lessons.php?lesson=%NUMBER_OF_LESSON%&article=%NAME_OF_ARTICLE%
 * 
 *  Подготавливает данные для формирования страницы урока по шаблону lessonpage.php
 * 
 */

require_once __DIR__ . '/config/lessons_config.php';

if (in_array('database', MODULES)) {
    require_once __DIR__ . '/config/db_config.php';
}

require_once __DIR__ . '/lessons_api/navigation.php';
require_once __DIR__ . '/lessons_api/content_manager.php';
require_once __DIR__ . '/lessons_api/cache.php';
require_once __DIR__ . '/lessons_api/render.php';
require_once __DIR__ . '/lessons_api/errors.php';

if (in_array('donations', MODULES)) {
    require_once __DIR__ . '/api/donations/donations_handlers.php';
}


function get_lesson_number(): int {
    $lesson_number = filter_input(INPUT_GET, 'lesson', FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1]
    ]);
    
    if ($lesson_number === false) {
        show_error(400, "Некорректный номер урока");
    }
    
    return $lesson_number;
}

function get_article_info(array $lesson_articles): array {
    $article = $_GET['article'] ?? '';
    $article = is_string($article) ? trim($article) : '';
    $is_index_article = empty($article);

    if ($is_index_article) {
        return [
            'is_index' => true,
            'current_dir' => '',
            'index' => -1
        ];
    }

    $article_map = array_combine(
        array_map(fn($f) => explode('__', $f, 2)[1], $lesson_articles),
        $lesson_articles
    );

    $current_dir = $article_map[$article] ?? null;
    $article_index = array_search($current_dir, $lesson_articles);

    if ($article_index === false) {
        show_error(404, "Статья отсутствует!");
    }

    return [
        'is_index' => false,
        'current_dir' => $current_dir,
        'index' => $article_index
    ];
}

function get_article_paths(int $lesson_number, string $current_dir, bool $is_index, string $course): array {
    $lesson_folder = [
        'server' => SERVER_ARTICLES_DIRECTORY . $course . '/' . $lesson_number,
        'site' => SITE_ARTICLES_DIRECTORY . $course . '/' . $lesson_number
    ];

    if (!is_dir($lesson_folder['server'])) {
        show_error(404, "Урок не найден");
    }

    if ($is_index) {
        $paths = [
            'server' => $lesson_folder['server'],
            'site' => $lesson_folder['site'],
            'metadata' => $lesson_folder['server'] . '/' . METADATA_FILENAME,
            'article' => $lesson_folder['server'] . '/' . INDEX_FILENAME,
            'practice' => '',
            'reference' => ''
        ];
    } else {
        $article_folder = [
            'server' => $lesson_folder['server'] . '/' . $current_dir,
            'site' => $lesson_folder['site'] . '/' . $current_dir
        ];
        
        $paths = [
            'server' => $article_folder['server'],
            'site' => $article_folder['site'],
            'metadata' => $article_folder['server'] . '/' . METADATA_FILENAME,
            'article' => $article_folder['server'] . '/' . ARTICLE_FILENAME,
            'practice' => $article_folder['server'] . '/' . PRACTICE_FILENAME,
            'reference' => $article_folder['server'] . '/' . REFERENCE_FILENAME
        ];
    }

    return $paths;
}

function check_lesson_exists(int $lesson_number, array $available_lessons): void {
    if (!in_array($lesson_number, $available_lessons)) {
        show_error(404, "Урок не существует!");
        http_response_code(404);
    }
}

// Основной код
try {
    // 1. Получаем и проверяем номер урока
    $course_name = $_GET['course'] ?? 'lang_c';
    $lesson_number = get_lesson_number();
    $available_lessons = get_cached_lessons($course_name);
    check_lesson_exists($lesson_number, $available_lessons);

    // 2. Получаем информацию о статье
    $lesson_articles = get_cached_lesson_articles($lesson_number, $course_name);
    $article_info = get_article_info($lesson_articles);
    
    // 3. Формируем все необходимые пути
    $paths = get_article_paths(
        $lesson_number, 
        $article_info['current_dir'], 
        $article_info['is_index'],
        $course_name
    );

    // Проверяем существование файла статьи
    if (!file_exists($paths['article'])) {
        show_error(404, "Статья не найдена");
    }

    // 4. Получаем навигацию
    $nav_links = build_navigation_links(
        $available_lessons,
        $lesson_number,
        $lesson_articles,
        $article_info['is_index'],
        $article_info['index'],
        get_cached_all_lessons_articles($available_lessons, $course_name),
        $course_name
    );

    // 5. Получаем метаданные
    try {
        $meta = get_cached_article_metadata($paths['metadata'], $course_name);
    } catch (Throwable $e) {
        $meta = [
            'title' => 'Без названия',
            'canonical_link' => '',
            'description' => '',
            'keywords' => '',
        ];
    }

    // 6. Формируем данные для шаблона
    $template_data = [
        'article_title' => $meta['title'],
        'title_page' => $meta['title'],
        'canonical_pagelink' => $meta['canonical_link'],
        'description_page' => $meta['description'],
        'keywords_page' => $meta['keywords'],
        'has_glory_hall' => $meta['has_glory_hall'] ?? false,
        
        'prev_article_link' => $nav_links['prev'],
        'next_article_link' => $nav_links['next'],

        'lesson_contents' => get_lesson_contents(
            $lesson_number, 
            $lesson_articles, 
            SITE_LESSONS_DIRECTORY, 
            SERVER_ARTICLES_DIRECTORY . $course_name . '/' . $lesson_number,
            $course_name
        ),
        'article_text' => get_article_text(
            $article_info['is_index'],
            $paths['article'],
            $paths['site'],
            $paths['practice'],
            $paths['reference']
        ),
        'article' => $article_info['is_index'] ? '' : explode('__', $article_info['current_dir'], 2)[1],
        'lesson' => $lesson_number,
        'donations' => in_array('last_donations', BLOCKS) ? get_last_donations($con) : false,
    ];

    // 7. Рендерим шаблон
    extract($template_data);
    include 'templates/lessonpage.php';

} catch (Throwable $e) {
    show_error(500, "Ошибка при формировании страницы: " . $e->getMessage());
}
?>