<?php 
/**
 * menu.php зависит от MENU_ITEMS из site_config.php
 * site_config.php подключается во всех файлах, 
 * где подключается menu.php: 
 * map, tasks, team, donate, lessons, how_to_learn
 * 
 */
?>

<header>
<nav class="mainMenu">
    <button id="toggleBtn" class="mainMenu__toggleBtn">
        <div class="toggleBtn__icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </button>
    <ul id="mainMenuItems" class="mainMenu__items">
        <li class="mainMenu__logo">
            <a href="/" class="mainMenu__link">
                <img src="/static/img/logo_min.png" alt="Логотип YoungCoder.ru">
            </a>
        </li>
        
        <?php foreach (MENU_ITEMS as $item) { ?>
            <li class="mainMenu__item">
                <a href="<?php echo $item['url']; ?>" class="mainMenu__link">
                    <?php echo $item['text']; ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>
</header>