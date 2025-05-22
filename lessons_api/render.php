<?php

require_once __DIR__ . '/../vendor/autoload.php';
use cebe\markdown\GithubMarkdown;

/**
 * Обрабатывает Markdown-контент: заменяет символы и пути, затем парсит.
 * 
 * @param string $text Исходный Markdown-текст
 * @param string $imgPrefixUrl Префикс для путей изображений (например, "http://site.com/lesson1")
 * @param GithubMarkdown $parser Парсер Markdown
 * @return string Обработанный HTML
 */
function preprocess_markdown_content(string $markdown_text, string $img_prefix_url, GithubMarkdown $parser): string {
	$markdown_text = str_replace(" -- ", " — ", $markdown_text);
    $correct_markdown_text = str_replace("](./", "]($img_prefix_url/", $markdown_text);
    return $parser->parse($correct_markdown_text);
}

class CustomMarkdown extends GithubMarkdown {
    protected function renderCode($block) {
        $language = isset($block['language']) ? $block['language'] : 'plaintext';
        $code = htmlspecialchars($block['content'], ENT_NOQUOTES, 'UTF-8');
        return "<div class=\"blockCode\"><pre><code class=\"language-$language\">$code</code></pre></div>";
    }

	protected function renderInlineCode($block) {
        $code = htmlspecialchars($block[1], ENT_NOQUOTES | ENT_SUBSTITUTE, 'UTF-8');
        return "<code class=\"inlineCode\">$code</code>";
    }

	protected function renderImage($block) {

		$url = htmlspecialchars($block['url'], ENT_COMPAT | ENT_HTML401, 'UTF-8') ;
        $alt = htmlspecialchars($block['text'], ENT_COMPAT | ENT_HTML401 | ENT_SUBSTITUTE, 'UTF-8');
        $title = isset($block['title']) ? htmlspecialchars($block['title'], ENT_COMPAT | ENT_HTML401 | ENT_SUBSTITUTE, 'UTF-8') : '';

		return '
			<div class="articleImage">
				<img src="' . $url . '"' . ' alt="' . $alt . '"'. ' />'
			. '<p class="articleImage__caption">' . $title . '</p>'
			.'</div>';
	}



    // Определяем блок NotaBene (символ %)
    protected function identifyNotaBene($line) {
        return $line[0] === '%' && (!isset($line[1]) || ($l1 = $line[1]) === ' ' || $l1 === "\t");
    }

    // Собираем содержимое блока NotaBene
    protected function consumeNotaBene($lines, $current) {
        
		$content = [];
		for ($i = $current, $count = count($lines); $i < $count; $i++) {
			$line = $lines[$i];
			if (ltrim($line) !== '') {
				if ($line[0] == '%' && !isset($line[1])) {
					$line = '';
				} elseif (strncmp($line, '% ', 2) === 0) {
					$line = substr($line, 2);
				}
				$content[] = $line;
			} else {
				break;
			}
		}

		$block = [
            'notaBene',
            'content'  => $this->parseBlocks($content),
			'simple' => true,
		];

        return [$block, $i];
    }

    // Рендерим блок NotaBene
    protected function renderNotaBene($block) {
        $content = $this->renderAbsy($block['content']);
        return "<div class=\"notaBene\">$content</div>\n";
    }
}


/**
 * Возвращает текст статьи в виде HTML
 * 
 * @param bool $is_index_article Является ли статья индексной
 * @param string $serverpath_to_article Путь к статье на сервере
 * @param string $sitepath_to_article_folder Путь к статье на сайте
 * @param string $serverpath_to_practice Путь к практике на сервере
 * @param string $serverpath_to_reference Путь к справочным материалам на сервере
 * @return string HTML текст статьи
 */
function get_article_text(
    bool $is_index_article,
    string $serverpath_to_article,
    string $sitepath_to_article_folder,
    string $serverpath_to_practice,
    string $serverpath_to_reference
): string {

	$parser = new CustomMarkdown();
	$parser->enableNewlines = true;
	
	if ($is_index_article){
		return preprocess_markdown_content(
			file_get_contents($serverpath_to_article),
			$sitepath_to_article_folder,
			$parser);
	} else {
		$lesson_text = preprocess_markdown_content(
			file_get_contents($serverpath_to_article),
			$sitepath_to_article_folder,
			$parser);

		$practice = preprocess_markdown_content(
			file_get_contents($serverpath_to_practice),
			$sitepath_to_article_folder,
			$parser);

		$reference = preprocess_markdown_content(
			file_get_contents($serverpath_to_reference),
			$sitepath_to_article_folder,
			$parser);

		return $lesson_text . $practice . $reference;
	}
}