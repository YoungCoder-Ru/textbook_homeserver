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
    ];
    foreach ($styles as $style) {
        $path = __DIR__ . "/.." . $style;
        $version = filemtime($path);
        echo '<link rel="stylesheet" href="' . $style . '?v=' . $version . '">'."\n\t";
    }
    ?>

    <title>Ошибка <?= $error_code ?></title>

</head>
<body>
    <?php
        include 'partials/menu.php'; 
    ?>
    <div class="Content">
        <div class="wrapper">
            <article>
                <h1>Ошибка <?= $error_code ?></h1>
                <div class="error-message">
                    <p><?= $error_message ?></p>
                </div>
            </article>
        </div>
    </div>
     
    <?php include 'partials/footer.php'; ?>
</body>
</html>


