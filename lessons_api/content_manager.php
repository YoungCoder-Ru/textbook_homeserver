<?php

require_once __DIR__ . '/../config/lessons_config.php';


/**
 * Возвращает номера существующих уроков в виде массива.
 * 
 * @return array Массив номеров существующих уроков
 */
function get_available_lessons(string $course): array {
    $skip = ['.', '..', '_template', '0'];
    $lessons = [];
    
    foreach (scandir(SERVER_ARTICLES_DIRECTORY . $course . '/') as $name) {
        if (!in_array($name, $skip) && is_numeric($name)) {
            $lessons[] = $name;
        }
    }
    
    sort($lessons, SORT_NUMERIC);
    return $lessons;
}


/**
 * Возвращает массив статей урока в формате [название_статьи => имя_папки со статьей]
 * 
 * @param string $lesson_folder Путь к папке урока
 * @return array <string, string> Массив статей
 * @throws RuntimeException Если не удалось прочитать директорию
 */
function get_lesson_articles(string $lesson_folder): array {
	if (!is_dir($lesson_folder)) {
        throw new RuntimeException("Директория урока не существует!");
    }

	$articles = [];
	$subfolders = scandir($lesson_folder);

	if ($subfolders === false) {
        throw new RuntimeException("Ошибка при чтении директории урока!");
    }

	foreach ($subfolders as $item){
		if ($item == '.' or $item == '..') continue;

		$subfolder_path = $lesson_folder.'/'.$item;

		if (is_dir($subfolder_path)){
			$articles[] = $item;
		}
	}

	usort($articles, function($a, $b) {
        return (int)explode('__', $a)[0] <=> (int)explode('__', $b)[0];
    });

	return $articles;
}


/**
 * Возвращает метаданные статьи из файла с метаданными.
 * 
 * @param string $file_path Путь к файлу метаданных
 * @return array Массив метаданных
 */
function get_article_metadata(string $file_path): array {
	clearstatcache(true, $file_path);
	
	if (!file_exists($file_path)) {
		throw new RuntimeException("Файл метаданных не существует!");
	}

	$json_content = file_get_contents($file_path);

	if ($json_content === false) {
		throw new RuntimeException("Ошибка при чтении файла метаданных!");
	}

	$metadata = json_decode($json_content, true);
	if (json_last_error() !== JSON_ERROR_NONE) {
		throw new RuntimeException("Ошибка при декодировании файла метаданных!");
	}

	return $metadata;
}


/**
 * Возвращает массив статей урока в формате [название_статьи => массив_с_данными].
 * 
 * @param int $lesson_number Номер урока
 * @param array $articles Массив статей урока
 * @param string $sitepath Путь до папки статей на сайте
 * @param string $serverpath Путь к папке статей на сервере
 * @return array Массив статей урока в формате 
 * 	[
 * 		'название подпапки статьи' => [
 * 			'title' => 'Заголовок статьи',
 * 			'link' => 'URL статьи',
 * 			'name' => 'название подпапки статьи'
 * 		],
 * 		...
 * 	]
 */
function get_lesson_contents(int $lesson_number, array $articles, string $sitepath, string $serverpath, string $course): array {
	$contents = [];

	foreach($articles as $article_folder) {
		$article_name = explode('__', $article_folder, 2)[1] ?? $article_folder;
		$metadata_file_path = "$serverpath/$article_folder/" . METADATA_FILENAME;

		$metadata = get_article_metadata($metadata_file_path);
		$link = $course == 'lang_c' ? "$lesson_number/$article_name" : "$course/$lesson_number/$article_name";
		$contents[$article_name] = [
			"title" => $metadata['title'],
			"link" => $sitepath.$link,
			"name" => $article_name,
            'folder' => $article_folder
		];
	}

	return $contents;
}


function get_lesson_title(int $lesson_number, string $course): string {
    $lesson_folder = SERVER_ARTICLES_DIRECTORY . $course . '/' . $lesson_number;
    $metadata_file = $lesson_folder . '/' . METADATA_FILENAME;
    
    try {
        $metadata = get_article_metadata($metadata_file);
        return $metadata['title'] ?? "Без названия";
    } catch (RuntimeException $e) {
        return "Без названия";
    }
}


function prepare_map_data(string $course) {   
    $lessons = get_available_lessons($course);
    usort($lessons, fn($a, $b) => (int)$a <=> (int)$b);

    $prepared = [];
    foreach ($lessons as $lesson_num) {
        $lesson_folder = SERVER_ARTICLES_DIRECTORY . $course . '/' . $lesson_num;
        $articles = get_lesson_articles($lesson_folder);
        $lesson_title = get_lesson_title($lesson_num, $course);
        
        $prepared[] = [
            'title' => $lesson_title,
            'articles' => get_lesson_contents(
                $lesson_num,
                $articles,
                SITE_LESSONS_DIRECTORY,
                SERVER_ARTICLES_DIRECTORY. $course . '/' .$lesson_num,
                $course
            ),
            'num' => $lesson_num
        ];
    }
    return $prepared;
}