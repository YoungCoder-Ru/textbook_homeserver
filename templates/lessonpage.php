<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/favicon.svg" rel="icon" type="image/svg+xml" />
    <?php
        $styles = [
            '/static/css/common-styles.css',
            '/static/css/menu.css',
            '/static/css/lesson.css',
            '/static/js/highlightjs/styles/atom-one-dark.css'
        ];

        foreach ($styles as $style) {
            $path = __DIR__ . "/.." . $style;
            $version = filemtime($path);
            echo '<link rel="stylesheet" href="' . $style . '?v=' . $version . '">'."\n\t";
        }
    
        include 'partials/meta.php'; 
    ?>
    
    <script src="/static/js/highlightjs/highlight.min.js"></script>
    <script src="/static/js/highlightjs/languages/c.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            hljs.configure({
                ignoreUnescapedHTML: true
            });
            hljs.highlightAll();
        });
    </script>

    <?php if (in_array('comments', BLOCKS)) { ?>
    <script>
        var remark_config = {
            host: "https://comments.youngcoder.ru",
            site_id: "youngcoder_ru",
            locale: "ru",
			show_rss_subscription: false,
			no_footer: false
        }
        !function(e,n){for(var o=0;o<e.length;o++){var r=n.createElement("script"),c=".js",d=n.head||n.body;"noModule"in r?(r.type="module",c=".mjs"):r.async=!0,r.defer=!0,r.src=remark_config.host+"/web/"+e[o]+c,d.appendChild(r)}}(remark_config.components||["embed"],document);
    </script>
    <?php } ?>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "<?php $course == 'manuals' ? print('Мануалы') : print('Уроки') ?>",
                "item": "<?php $course == 'manuals' ? print(htmlspecialchars(SITE_URL . '/manuals/')) : print(htmlspecialchars(SITE_URL . '/lessons/')) ?>"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "<?= htmlspecialchars($article_title) ?>",
                "item": "<?= htmlspecialchars(SITE_URL . $_SERVER['REQUEST_URI']) ?>"
            }
        ]
    }
    </script>
</head>

</head>
<body>
    <?php include 'partials/menu.php'; ?>
    
    <div class="Content">
        <div class="wrapper">
            <div class="breadNav">
                    <a href="<?php $course == 'manuals' ? print('/manuals/') : print('/lessons/') ?>">
                        <?php $course == 'manuals' ? print('Мануалы') : print('Уроки') ?>
                    </a> 
                        &gt; <?php echo $article_title; ?>
            </div>

            <?php 
                if (in_array('announcement', BLOCKS)) {
                    include __DIR__ . '/../site_templates/partials/announcement.php';
                }
            ?>
            <article class='LessonContent'>
                <?php echo $article_text; ?>

                <?php $has_glory_hall && in_array('gloryhall', BLOCKS) ? include __DIR__ . '/../site_templates/partials/gloryhall.php' : '' ?>

            </article>

            <div class="lessonNavigationLinks">
                <?= $prev_article_link 
                    ? "<a class='lessonNavigationLinks__item' href='$prev_article_link'>&#9668; <span class='lessonNavigationLinks__item_text'>Предыдущий&nbsp;шаг</span></a>"
                    : "<div class='lessonNavigationLinks__item'><span class='lessonNavigationLinks__item_text'>&#9668;&nbsp;Предыдущий&nbsp;шаг</span></div>"
                ?>

                <?= $next_article_link 
                    ? "<a class='lessonNavigationLinks__item' href='$next_article_link'> <span class='lessonNavigationLinks__item_text'>Следующий&nbsp;шаг</span>&nbsp;&#9658; </a>"
                    : "<div class='lessonNavigationLinks__item'> <span class='lessonNavigationLinks__item_text'>Следующий&nbsp;шаг&nbsp;&#9658;</span></div>"
                ?>
            </div>

            <?php if (in_array('comments', BLOCKS)) { ?>
                <div id="remark42"></div>
            <?php } ?>

        </div>

        <div class="sidebar--right">
            <div class="sidebarContent">    
                <div class="lessonIndex">
                    <div class="sidebar_header">Содержание</div>
                    <nav>
                        <ol>
                            <?php
                                foreach ($lesson_contents as $key => $item){
                                    if($article != $item['name']){
                            ?>
                            <li>
                                <a href="<?php echo $item['link']; ?>">
                                        <?php echo $item['title']; ?>
                                </a>
                            </li>
                            <?php
                                    } else {
                            ?>
                            <li>
                                <?php echo $item['title']; ?>
                            </li>
                            <?php
                                }
                            }
                            ?>
                        </ol>
                    </nav>
                </div>
                
                <div class="lessonDonationBlock--sidebar-right">         
                    <?php
                    if (in_array('last_donations', BLOCKS)) { 
                        include __DIR__ . '/../site_templates/partials/last_donations.php';
                    } ?>

                    <?php 
                    if (in_array('donate_button', BLOCKS)) { 
                        include __DIR__ . '/partials/donate_button.php';
                    }  ?>
                </div>

                <?php 
                    foreach ($lesson_contents as $key => $item){                        
                        $github_prefix_link = "https://github.com/YoungCoder-Ru/youngcoder.ru/tree/main/$course/$lesson";
                        $github_link = '';
                        if($article == $item['name']){
                            $github_link = $github_prefix_link . '/' . $item['folder'];
                            break;
                        }
                    }

                    if ($github_link == ''){
                        $github_link = $github_prefix_link . '/' . 'index.md';
                    }
                ?>
                
                <div class="lessonGitHubEditLink">
                    <a href="<?= $github_link; ?>">Редактировать статью на GitHub</a>
                </div>


                <?php if (in_array('share_buttons', BLOCKS)) { ?>
                    <div class="lessonShareButtons">
                        <script src="https://yastatic.net/share2/share.js"></script>
                        <div class="ya-share2" data-curtain data-size="m" data-services="telegram,vkontakte,odnoklassniki,lj"></div>
                    </div>
                <?php } ?>
                
            </div>
        </div>
    </div>


    <?php include 'partials/footer.php'; ?>
    
</body>
</html>

