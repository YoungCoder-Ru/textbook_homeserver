<?php
/**
 * @param array $data - Массив данных для отображения (аналог $map_data)
 * @param string $base_url - Базовый URL для ссылок (например, 'lessons/')
 */
function renderMapList(array $data, string $base_url = '') {?>
<div class="mapList">
    <ol>
        <?php foreach ($data as $item): ?>
            <li>

                <span class='mapList_lessonTitle'><?= $item['title'] ?></span>

                <ol class="mapList_lessonContent">
                    <li class="mapList_lessonContent_item">
                        <a href='<?= $base_url . $item['num'] ?>/'>Обзор</a>
                    </li>
                    <?php foreach ($item['articles'] as $article): ?>
                        <li class="mapList_lessonContent_item">
                            <a href='<?= $article['link'] ?>'>
                                <?= $article['title'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </li>
        <?php endforeach; ?>
    </ol>
</div>
<?php } ?>
