<?php
function extract_article_name(string $folder): string {
    return explode('__', $folder, 2)[1];
}

function get_sorted_lessons(array $lessons): array {
    $sorted = $lessons;
    sort($sorted, SORT_NUMERIC);
    return $sorted;
}

function get_adjacent_lesson(array $sorted_lessons, int $current_lesson, int $offset): ?int {
    $current_index = array_search($current_lesson, $sorted_lessons);
    return $sorted_lessons[$current_index + $offset] ?? null;
}

function build_navigation_links(
    array $all_lessons,
    int $current_lesson,
    array $current_articles,
    bool $is_index_article,
    ?int $article_index,
    array $all_lessons_articles,
    string $course
): array {

    $sorted_lessons = get_sorted_lessons($all_lessons);
    
    return [
        'prev' => $is_index_article
            ? get_prev_link_for_index($sorted_lessons, $current_lesson, $all_lessons_articles, $course)
            : get_prev_link_for_article($current_lesson, $current_articles, $article_index, $course),
        
        'next' => $is_index_article
            ? get_next_link_for_index($current_lesson, $current_articles, $course)
            : get_next_link_for_article($sorted_lessons, $current_lesson, $current_articles, $article_index, $course)
    ];
}

function get_prev_link_for_index(array $sorted_lessons, int $current_lesson, array $all_lessons_articles, string $course): ?string {
    $prev_lesson = get_adjacent_lesson($sorted_lessons, $current_lesson, -1);
    if (!$prev_lesson || empty($all_lessons_articles[$prev_lesson])) return null;

    $prev_articles = $all_lessons_articles[$prev_lesson];
    $last_article = end($prev_articles);
    if ($course == 'lang_c') {
        return "/lessons/$prev_lesson/" . extract_article_name($last_article);
    } else if ($course == 'manuals') {
        return "/manuals/$prev_lesson/" . extract_article_name($last_article);
    } else {
        return "/lessons/$course/$prev_lesson/" . extract_article_name($last_article);
    }
}

function get_prev_link_for_article(int $lesson, array $articles, ?int $article_index, string $course): ?string {
    if ($article_index > 0) {
        $prev_article = $articles[$article_index - 1];
        if ($course == 'lang_c') {
            return "/lessons/$lesson/" . extract_article_name($prev_article);
        } else if ($course == 'manuals') {
            return "/manuals/$lesson/" . extract_article_name($prev_article);
        } else {
            return "/lessons/$course/$lesson/" . extract_article_name($prev_article);
        }
    }
    if ($course == 'lang_c') {
        return "/lessons/$lesson/";
    } else if ($course == 'manuals') {
        return "/manuals/$lesson/";
    } else {
        return "/lessons/$course/$lesson/";
    }
}

function get_next_link_for_index(int $lesson, array $articles, string $course): ?string {
    if (empty($articles)) return null;
    $first_article = reset($articles);
    if ($course == 'lang_c') {
        return "/lessons/$lesson/" . extract_article_name($first_article);
    } else if ($course == 'manuals') {
        return "/manuals/$lesson/" . extract_article_name($first_article);
    } else {
        return "/lessons/$course/$lesson/" . extract_article_name($first_article);
    }
}

function get_next_link_for_article(array $sorted_lessons, int $lesson, array $articles, ?int $article_index, string $course): ?string {
    if ($article_index < count($articles) - 1) {
        $next_article = $articles[$article_index + 1];
        if ($course == 'lang_c') {
            return "/lessons/$lesson/" . extract_article_name($next_article);
        } else if ($course == 'manuals') {
            return "/manuals/$lesson/" . extract_article_name($next_article);
        } else {
            return "/lessons/$course/$lesson/" . extract_article_name($next_article);
        }
    }

    $next_lesson = get_adjacent_lesson($sorted_lessons, $lesson, 1);

    if (!$next_lesson) return null;


    if ($course == 'lang_c') {
        return "/lessons/$next_lesson/";
    } else if ($course == 'manuals') {
        return "/manuals/$next_lesson/";
    } else {
        return "/lessons/$course/$next_lesson/";
    }
}