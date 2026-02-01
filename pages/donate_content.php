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

        <p>Если у вас есть желание и возможность поддержать проект финансово, вот реквизиты:</p>
        <ul>
            <li>карта ВТБ: <strong>2200 2418 5059 2936</strong></li>
            <li>Тинькоф (сервис позволяет оставить комментарий к донату): <a href="https://tbank.ru/cf/AQaphilF8KD">ссылка</a></li>
            <li>YooMoney (РФ и СНГ, рубли):<a href="https://yoomoney.ru/to/41001388269088"> <strong>41001388269088</strong></a></li>
            <li>WebMoney (все страны, сервис позволяет оставить комментарий к донату): <strong>Z127414214571</strong></li>
            <li>Бусти (здесь выкладываю отчёты о работе над курсом): <a href="https://boosty.to/lang_c">Посмотреть</a></li>
        </ul>

        <p>Если переводите средства на карту ВТБ, пожалуйста, указывайте в комментарии, что это пожертвование/донат на развитие проекта YoungCoder или что-то в таком духе. Иначе банковские структуры безопасности могут счесть меня мошенником, отмывающим денежные средства и заблокировать карту.</p>

        <p>Перевод по QR-коду и через системы Yoomoney и WebMoney:
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

        <h3>Для чего требуются средства?</h3>

        <p>Первое. Покрытие ежегодных расходов на материально-техническую сторону проекта (цены на 2025 год):</p>
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
            include __DIR__ . '/../api/donations/donations_handlers.php';
            $donated = get_total_donations_in_rub($con);
            $goal1 = 9576;
            $percent1 = 100;
            #$percent = $goal > 0 ? round($donated / $goal * 100) : 0;

        ?>

            <h4><span style="text-decoration: line-through;">Сбор на материально-техническое обеспечение сайта на 2026 год</span> (ЗАВЕРШЕН)</h4>
            <div class="donationProgressWrapper">
                <div class="donationProgressBarBg">
                    <div class="donationProgressBar" style="width:<?= $percent ?>%"></div>
                </div>
                <div class="donationProgressText">
                    <b><?= $goal1 ?></b> из <b><?= $goal1 ?></b> руб. (<b><?= $percent1 ?>%</b>)
                </div>
            </div>

        <?php
        }
        ?>

        <p>Поступления на WebMoney учитываются в этой статистике по условному курсу 65 руб. за 1 доллар,
            т.к. не понятно какой будет курс на официальной бирже для обмена на момент, когда я буду оттуда выводить средства. На 08.08.2025 максимальное предложение на официальной бирже 63 руб. за 1 доллар.
        </p>

        <p>Второе. Доработка и поддержка текущей версии курса.</p>
        <p>Сейчас идёт работа над последовательной переработкой теоретического материала, размещённого на сайте, и добавлением новых задач на Stepik. Кроме того, мы стараемся оперативно помогать ученикам в комментариях на Степике. </p>

        <p> </p>

        <?php

        if (in_array('database', MODULES)) {
            require_once __DIR__ . '/../config/db_config.php';
        }
        if (in_array('donations', MODULES) && in_array('database', MODULES)) {
            $donated = $donated;
            $goal = 100000;
            $percent = $goal > 0 ? round($donated / $goal * 100) : 0;
        ?>

            <h4>Сбор на развитие и поддержку текущей версии курса</h4>
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

            За 2025 год:
            <ul>
                <li> полностью переработаны 5 уроков + заметка про Цикл for;
                <li> обновлены заметки про установку IDE и урок про переменные и типы данных в языке Си;
                <li> добавлены новые заметки-мануалы про приоритет операторов и тестирование через классы эквивалентности;
                <li> Денис написал заметку-мануал про базовые принципы написания чистого кода;
                <li> на Степике добавлено около 40 новых задач на программирование разного уровня сложности;
            </ul>


            <h3>Бонусы для донатеров</h3>
            <div class="donationBonuses">
                <div class="donationBonusCard">
                    <div class="donationBonusTitle">Для всех донатов</div>
                    <div>Упоминание на сайте в разделе <a href="https://youngcoder.ru/team.php">Команда</a> и на <a href="https://stepik.org/lesson/1340735/step/11?unit=1356402">отдельной странице в Stepik</a></div>
                </div>
                <div class="donationBonusCard">
                    <div class="donationBonusTitle" style="text-decoration: line-through;">от 512 руб.</div>
                    <div style="text-decoration: line-through;">Ранний доступ к тестированию новых задач для курса</div>
                </div>
            </div>

            <p> <b> Внимание! UPD от 27.07.2025.</b><br />
                Ранний доступ к тестированию новых задач для курса более не актуален, т.к. выяснилось, что на Степик нельзя создавать приватные уроки с доступом по ссылке. Можно добавить только несколько тестеров. <br />
                Анонимы с картами, оканчивающимися на *2056, *7694, сделавшие донаты в период, пока объявление висело на сайте (1-27.07.2025). Для вас этот бонус по прежнему актуален. Решите воспользоваться, напишите мне на почту kadeat [гав-гав] gmail [точка] com или в группу ВК до конца 2025 года. Я добавлю вас в "курс-песочницу" в качестве тестировщиков. </p>

    </article>
</div>

<link rel="stylesheet" href="/static/css/donation.css">