<?php $title = 'О нас'?>
<div class="about">
    <header>
        <h1><?=$title?></h1>
        <img src="images/about_us.jpeg" alt="our_company.jpg"/>
        <h2>Разработка и сопровождение веб-сайтов</h2>
    </header>

    <section class="about_text">
        <p>
            <span>«Our Company» </span>
            <?=$data['description']?>
        </p>
        <p>Как с нами связаться: <a href="/contacts">нажмите здесь</a></p>
    </section>
</div>