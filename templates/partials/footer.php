<?php 
/**
 * footer.php зависит от MENU_ITEMS из site_config.php
 * site_config.php подключается во всех файлах, 
 * где подключается footer.php: 
 * map, tasks, team, donate, lessons, index, how_to_learn
 * 
 */
?>

<footer>
    <aside>
        <nav>
            <ul class="FooterLinks">
            <?php foreach (MENU_ITEMS as $item) { ?>
                <li>
                    <a href="<?php echo $item['url']; ?>"> <?php echo $item['text']; ?></a>
                </li>
            <?php } ?>
            </ul>
        </nav>
    </aside>
    <div class="FooterSign">
        Сделано <a href="https://vk.com/bazaar#kdt">KaDeaT</a> <br/> 2014 — <span id="currentYear"></span>
    </div>
</footer>

<script>
    document.getElementById("currentYear").textContent = new Date().getFullYear();

/* Обработчик клика по кнопке МЕНЮ (гармошка) */
    var menuItems = document.querySelector("#mainMenuItems");

    function toggleMenu() {
        if (menuItems.classList.contains("mainMenu__items--visible")) {
            menuItems.classList.remove("mainMenu__items--visible");
        } else {
            menuItems.classList.add("mainMenu__items--visible");
        }
    }

    document.addEventListener("click", function(e) {
        if (e.target.closest("#toggleBtn, .toggleBtn__icon")) {
            e.preventDefault();
            toggleMenu();
        } else if (!e.target.closest("#mainMenuItems")) {
            menuItems.classList.remove("mainMenu__items--visible");
        }
    });

</script>

<?php
if (in_array('metrika', BLOCKS)) {
    include __DIR__ . '/../../site_templates/partials/metrica.php';
} ?>
    