<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/lessons_config.php';
require_once __DIR__ . '/content_manager.php';

const CACHE_TIME = 3600; // 1 час

// Инициализация директорий кэша
foreach (CACHE_DIRS as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

/**
 * Проверяет валидность кэша
 */
function is_cache_valid(string $cache_file): bool {
    if (!file_exists($cache_file)) {
        return false;
    }
    $mtime = filemtime($cache_file);
    return $mtime && (time() - $mtime) < CACHE_TIME;
}

/**
 * Получает данные из кэша
 */
function get_from_cache(string $cache_file): ?array {
    if (!is_cache_valid($cache_file)) {
        return null;
    }
    $data = json_decode(file_get_contents($cache_file), true);
    return $data !== null ? $data : null;
}

/**
 * Сохраняет данные в кэш
 */
function save_to_cache(string $cache_file, array $data): void {
    file_put_contents($cache_file, json_encode($data));
}

/**
 * Получает список уроков из кэша или обновляет его
 */
function get_cached_lessons(string $course): array {
    $cache_file = CACHE_DIRS[$course] . 'available_lessons.json';
    $cached = get_from_cache($cache_file);
    if ($cached !== null && $cached !== []) {
        return $cached;
    }

    $lessons = get_available_lessons($course);
    save_to_cache($cache_file, $lessons);
    return $lessons;
}

/**
 * Получает статьи урока из кэша или обновляет его
 */
function get_cached_lesson_articles(int $lesson_number, string $course): array {
    $cache_file = CACHE_DIRS[$course] . "lesson_{$lesson_number}.json";
    
    $cached = get_from_cache($cache_file);
    if ($cached !== null) {
        return $cached;
    }

    try {
        $articles = get_lesson_articles(SERVER_ARTICLES_DIRECTORY . $course . '/' . $lesson_number);
        save_to_cache($cache_file, $articles);
        return $articles;
    } catch (Throwable $e) {
        error_log("Ошибка при получении статей урока $lesson_number: " . $e->getMessage());
        return [];
    }
}

/**
 * Получает метаданные статьи из кэша или обновляет его
 */
function get_cached_article_metadata(string $metadata_path, string $course): array {
    $cache_key = md5($metadata_path);
    $cache_file = CACHE_DIRS[$course] . "metadata_{$cache_key}.json";
    
    clearstatcache(true, $cache_file);
    
    $cached = get_from_cache($cache_file);
    if ($cached !== null) {
        return $cached;
    }
    
    try {
        $metadata = get_article_metadata($metadata_path);
        save_to_cache($cache_file, $metadata);
        return $metadata;
    } catch (Throwable $e) {
        return [
            'title' => 'Без названия',
            'description' => '',
            'keywords' => '',
            'canonical_link' => ''
        ];
    }
}

/**
 * Получает все статьи для всех уроков из кэша
 */
function get_cached_all_lessons_articles(array $lessons, string $course): array {
    $cache_file = CACHE_DIRS[$course] . 'all_lessons_articles.json';
    
    $cached = get_from_cache($cache_file);
    if ($cached !== null) {
        return $cached;
    }

    $result = [];
    foreach ($lessons as $lesson) {
        $result[$lesson] = get_cached_lesson_articles((int)$lesson, $course);
    }
    
    save_to_cache($cache_file, $result);
    return $result;
}

/**
 * Очищает весь кэш
 */
function clear_lessons_cache(string $course): void {
    $files = glob(CACHE_DIRS[$course] . '*.json');
    foreach ($files as $file) {
        unlink($file);
    }
} 