<div class="HeaderBlock">
	<img class="HeaderBlock_logo" src="/static/img/logo_full.png" alt="Логотип youngcoder.ru">
	<p>Программирование — это не сложно! <br/>
		Пройди путь от чайника до начинающего программиста<br/>
		Основы программирования на языке С
	</p>
</div>

<div class="MainPageContentWrapper">
	<article class="MainPageContent">
		<h1>Как научиться программировать?</h1>

		<ul>
			<li>с чего начать обучение программированию?</li>
			<li>какой язык изучать первым?</li>
			<li>какие книги читать?</li>
		</ul>

		<p>Отвечу по порядку. Начните с изучения уроков на этом сайте. В них вы
			освоите основы программирования с использованием языка C (читается как Си).
			Курс самодостаточен, поэтому на данном этапе вам не потребуется никаких
			дополнительных книг, хотя их чтение не возбраняется. Более того, почти в
			каждом уроке есть ссылки на дополнительные материалы (книги, видео, статьи
			и т.д.).
		</p>

		<h2>Базовый курс</h2>
		<a id="map"></a>
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