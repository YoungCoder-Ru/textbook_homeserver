<!DOCTYPE html>
<html lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/favicon.svg" rel="icon" type="image/svg+xml" />
    <?php
        $styles = [
            '/static/css/common-styles.css',
            '/static/css/map.css',
            '/static/css/menu.css',
            '/site_static/css/team.css',
            '/static/css/tasks.css',
            '/static/css/donation.css',
            '/static/css/mainpage.css'
        ];
        foreach ($styles as $style) {
            $path = __DIR__ . "/.." . $style;
            $version = filemtime($path);
            echo '<link rel="stylesheet" href="' . $style . '?v=' . $version . '">' ."\n\t";
        }
    
        include 'partials/meta.php';
    ?>
</head>
<body>
        
    <?php 
        include 'partials/menu.php';
        if ($isMainPage) {
            include 'pages/mainpage_content.php';
        } else { ?>
        <div class="Content">
            <?= $content ?>
        </div>
    <?php } ?>
    

    <?php include 'partials/footer.php'; ?>
</body>
</html>