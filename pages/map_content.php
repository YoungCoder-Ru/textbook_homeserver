<div class="wrapper">
	<div class="breadNav">
		<a href="/">Главная</a> &gt;  Карта изучения основ программирования на языке Си
	</div>

	<article>
		<h1> Основы языка Си </h1>
		<p>В этом разделе последовательно и доступно излагаются основы программирования 
            на языке Си. Для обучение не требуется никакой специальной подготовки. Каждый урок 
            снабжен задачами для самостоятельного решения. </p>
		<p><a href="https://coggle.it/diagram/WXaPy5VbdQABwO2k/0a7a0da316d2bffcc4c3c0443f318c3a825d65d2b80fc2f6b93ffe2f4060939e">Mind map</a> основных понятий базовой части курса.</p>

        <?php
            require_once __DIR__ . '/../templates/partials/map_list.php';
            renderMapList($map_data, 'lessons/');
        ?>
		
        <h2>IDE для программирования на языке Си</h2>
        <p>В этом разделе расположены уроки, посвящённые установке, настройке и основным 
            функциям различых IDE, поддерживающих программирование на языке Си.</p>
	
        <?php
            renderMapList($map_data_ide, 'lessons/ide/');
        ?>

    </article>
</div>