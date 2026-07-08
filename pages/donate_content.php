<div class="wrapper">
    <div class="breadNav">
        <a href="/">Главная</a> &gt; Поддержать проект
    </div>
    <article>
        <h1>Как помочь развитию курса YoungCoder.Ru?</h1>
        <p>Есть несколько способов поддержать проект:</p>

        <h3>1. Пройдите курс и расскажите о нём</h3>
        <p>Пройдите <a href="/#map">все уроки</a> и решите <a href="tasks.php"> задачи</a>.
            Я ежемесячно отслеживаю статистику: новые ученики, сертификаты и общее количество решённых задач. Мне важно понимать,
            что курс полезен другим людям. После прохождения поделитесь своими впечатлениями соцсетях и оставьте
            <a href="https://stepik.org/course/3078/reviews">отзыв на Stepikе</a>.

        <h3>2. Сообщайте об ошибках</h3>
        <p> Если заметили опечатку, ошибку или неработающую ссылку — оставьте комментарий под уроком, а лучше
            заведите <a href="https://github.com/youngcoder-ru/youngcoder-ru.github.io/issues">issue</a> на гитхабе.

        <h3>3. Делитесь полезными материалами</h3>
        <p> Нашли интересный материал по теме урока? Добавьте его в комментарии к уроку. </p>

        <a name="donate"></a>
        <h2> Финансовая поддержка </h2>

        <p>Вы можете поддержать проект финансово. Это поможет нам поддерживать и развивать Курс.</p>
        <p>Перевод по QR-коду и через системы YooMoney и WebMoney:
        <div class="donationSystems">
            <div>
                <img
                    src="/static/img/tbank_qr.png"
                    style="display: block; margin: 0 auto;" />
            </div>
            <div>
                <iframe
                    style="max-width: 315px; .widget-shop{box-shadow: none;}"
                    src="https://yoomoney.ru/quickpay/shop-widget?writer=seller&targets=%D0%9D%D0%B0%20%D1%81%D0%BE%D0%B7%D0%B4%D0%B0%D0%BD%D0%B8%D0%B5%20%D0%BD%D0%BE%D0%B2%D1%8B%D1%85%20%D1%83%D1%80%D0%BE%D0%BA%D0%BE%D0%B2&default-sum=100&button-text=11&payment-type-choice=on&mobile-payment-type-choice=on&successURL=https%3A%2F%2Fyoungcoder.ru%2Fdonate.php&quickpay=shop&account=41001388269088&"
                    width="315"
                    height="240"
                    allowtransparency="true"
                    frameborder="0"
                    scrolling="no"></iframe>
            </div>
            <div>
                <iframe
                    src="https://funding.webmoney.ru/widgets/vertical/93b25f7f-fbd4-4148-9bb3-2e7ffbc5df9e?bt=0&hs=1&sum=100&hsb=1&hab=1&hbtc=1"
                    width="240"
                    height="240"
                    scrolling="no"
                    style="border:none; display: block; margin: 0 auto;"></iframe>
            </div>
        </div>
        <p>Другие варианты:</p>
        <ul>
            <li>перевод через <a href="https://yoomoney.ru/to/41001388269088">Сбор в YooMoney</a> (РФ и СНГ, рубли)</li>
            <li>перевод на карту ВТБ: <strong>2200 2418 5059 2936</strong></li>
            <li>перевод на WebMoney кошелёк (все страны): <strong>Z127414214571</strong></li>
            <li>перевод через <a href="https://tbank.ru/cf/AQaphilF8KD">Сбор в Т-Банке</a> (сервис позволяет оставить комментарий к донату)</li>
            <li>подписка на <a href="https://boosty.to/lang_c">Бусти</a>. Там я пишу о текущей работе над Курсом.</li>
        </ul>

        <h3> На что тратятся средства?</h3>
        <ul>
            <li>покрытие ежегодных расходов на хостинг, домен и сервер (примерно 10к руб.);</li>
            <li>всё, что останется после этого, пойдёт на новогодние подарки мне и Денису. </li>
        </ul>

        <h4> Информация по текущему сбору средств</h4>
        <?php

        if (in_array('database', MODULES)) {
            require_once __DIR__ . '/../config/db_config.php';
        }
        if (in_array('donations', MODULES) && in_array('database', MODULES)) {
            include __DIR__ . '/../api/donations/donations_handlers.php';
            $donated = get_total_donations_in_rub($con);
            $goal = 100000;
            $percent = $goal > 0 ? round($donated / $goal * 100) : 0;
        ?>
            <div class="donationProgressWrapper">
                <div class="donationProgressBarBg">
                    <div class="donationProgressBar" style="width:<?= $percent ?>%"></div>
                </div>
                <div class="donationProgressText">
                    <b><?= $donated ?></b> из <b><?= $goal ?></b> руб. (<b><?= $percent ?>%</b>)
                </div>
            </div>
            <p>
            <?php
        }
            ?>

            <h4>Сделано за 2026 год</h4>
            <ul>
                <li>в урок по функциям добавлены 4 новые задачи на программирование;</li>
                <li>изменена структура курса: урок про функции и указатели перемещён на 8-й урок;</li>
                <li>переписана <a href="https://youngcoder.ru/lessons/8/function_arguments">заметка про передачу аргументов в функцию</a>;</li>
                <li>на степик добавлен <a href="https://stepik.org/lesson/2434437/step/1"> новый интерактивный урок про указатели</a>;</li>
                <li>в урок по переменных добавлны 2 задачи на программирование;</li>
                <li>переписана заметка про <a href="https://youngcoder.ru/lessons/8/pointers">указатели</a>;</li>
                <li>переписана <a href="https://youngcoder.ru/manuals/1/c_library">заметка про Стандартную библиотеку языка Си</a> и справочники по функциям.</li>
                <li>в урок по функциям на Степике добавлены <a href="https://t.me/youngcoder_c/108">три новые задачи</a>: 1 тестовая и 2 на программирование;</li>
                <li>добавлена <a href="https://youngcoder.ru/lessons/10/using_functions">заметка про использование пользовательских функций</a> для декомпозиции и рефакторинга программ;</li>
                <li>переписан <a href="https://youngcoder.ru/lessons/10/polzovatelskie_funkcii">урок про пользовательские функции</a>;</li>
                <li>открыт Зал Славы 7-го урока (с заковыристой задачей)</li>
                <li><a href="https://t.me/youngcoder_c/94">7 новых задач на программирование</a> в урок про Циклы с условиями;</li>
                <li>на Степик добавлен <a href="https://stepik.org/lesson/2226810/step/1">урок с простыми задачами на условные циклы</a>;</li>
                <li>переработаны заметки про <a href="https://youngcoder.ru/lessons/7/cikli_s_usloviem">циклы с условиями</a> и <a href="https://youngcoder.ru/lessons/7/upravlenie_ciklom">инструкции управления циклом</a>;</li>

            </ul>

            <h4>Бонусы для донатеров</h4>
            <p>Всех, кто сделал донат (независимо от суммы), я упоминаю в разделе <a href="https://youngcoder.ru/team.php">Команда</a> и на <a href="https://stepik.org/lesson/1340735/step/11?unit=1356402">отдельной странице в Stepik.</a></p>


            <h3>Архивные сборы </h3>

            <h4> 2025 год </h4>
            <p>Цель сбора: Покрытие ежегодных расходов на материально-техническую сторону проекта (цены на 2025 год):</p>
            <ul>
                <li><span style="text-decoration: line-through;">аренда виртуального сервера для системы комментариев (~ €50)</span> Оплачено 07.12.2025</li>
                <li><span style="text-decoration: line-through;">оплата услуг хостинга (4788 руб.)</span> Оплачено 07.12.2025</li>
                <li><span style="text-decoration: line-through;">оплата доменного имени (288 руб.)</span> <a href="https://boosty.to/lang_c/posts/dabefbb0-3de2-44f4-963f-0028b60dbc65">Оплачено 27.07.2025</a></li>
            </ul>
            <p> <b>7 декабря 2025 года</b> оплачены хостинг, сервер и домен (ещё на год). Подробности в <a href="https://boosty.to/lang_c/posts/6f7d9a45-28d0-417b-a14f-afe507e73c7d">посте на Бусти</a>.</p>

            <?php

            if (in_array('database', MODULES)) {
                require_once __DIR__ . '/../config/db_config.php';
            }
            if (in_array('donations', MODULES) && in_array('database', MODULES)) {
                //include __DIR__ . '/../api/donations/donations_handlers.php';
                $donated2025 = 21000;
                $goal2025 = 9576;
                $percent2025 = $goal2025 > 0 ? round($donated2025 / $goal2025 * 100) : 0;

            ?>

                <h4><span style="text-decoration: line-through;">Сбор на материально-техническое обеспечение сайта на 2026 год</span> (ЗАВЕРШЕН)</h4>
                <div class="donationProgressWrapper">
                    <div class="donationProgressBarBg">
                        <div class="donationProgressBar" style="width:<?= $percent2025 ?>%"></div>
                    </div>
                    <div class="donationProgressText">
                        <b><?= $donated2025 ?></b> из <b><?= $goal2025 ?></b> руб. (<b><?= $percent2025 ?>%</b>)
                    </div>
                </div>

            <?php
            }
            ?>

            <p>Поступления на WebMoney учитываются в этой статистике по условному курсу 65 руб. за 1 доллар,
                т.к. не понятно какой будет курс на официальной бирже для обмена на момент, когда я буду оттуда выводить средства. На 08.08.2025 максимальное предложение на официальной бирже 63 руб. за 1 доллар.
            </p>

            <h4> Что было сделано за 2025 год: </h4>
            <ul>
                <li> полностью переработаны 5 уроков + заметка про Цикл for и заметка про тип данных char;
                <li> обновлены заметки про установку IDE и урок про переменные и типы данных в языке Си;
                <li> добавлены новые заметки-мануалы про приоритет операторов и тестирование через классы эквивалентности;
                <li> Денис написал заметку-мануал про базовые принципы написания чистого кода;
                <li> на Степике добавлено около 40 новых задач на программирование разного уровня сложности;
            </ul>

            <p> <b> Внимание! UPD от 27.07.2025.</b><br />
                Ранний доступ к тестированию новых задач для курса более не актуален, т.к. выяснилось, что на Степик нельзя создавать приватные уроки с доступом по ссылке. Можно добавить только несколько тестеров. <br />
                Анонимы с картами, оканчивающимися на *2056, *7694, сделавшие донаты в период, пока объявление висело на сайте (1-27.07.2025). Для вас этот бонус по прежнему актуален. Решите воспользоваться, напишите мне на почту kadeat [гав-гав] gmail [точка] com или в группу ВК до конца 2025 года. Я добавлю вас в "курс-песочницу" в качестве тестировщиков. </p>

    </article>
</div>

<link rel="stylesheet" href="/static/css/donation.css">