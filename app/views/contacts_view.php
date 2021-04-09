<?php $title = 'Контакты'?>

<div class="contacts">
    <header>
        <h1><?=$title?></h1>
        <img itemprop="logo" src="images/our_contucts_400x115.png" />
        <h2>Разработка и сопровождение веб-сайтов</h2>
    </header>

    <a itemprop="url" href="/about"><p itemprop="name">«Our Company»</p></a>
    <p itemprop="telephone">Телефон: <a href="tel:+7 000 000‒00‒00">+7 000 000‒00‒00</a>
    <p itemprop="faxNumber">Факс: <a href="fax:+7 000 000‒00‒01">+7 000 000‒00‒01</a>
    <p>Email: <a href="mailto:support@ourcompany.site" target="_blank" itemprop="email">support@ourcompany.site</a> Ответ на письма приходит в течении 15 минут
    <!-- <p>Время работы:  -->
    <!-- <time itemprop="openingHours" datetime="Mo-Th 8:00-17:00">пн-чт 08:00-17:00, перерыв 12:00-12:48</time>
    <time itemprop="openingHours" datetime="Fr 8:00-16:00">пт 08:00-16:00, перерыв 12:00-12:48</time> -->
    
    <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">Адрес: <span itemprop="postalCode">420000</span>, Россия, <span itemprop="addressLocality">Казань</span>, <span itemprop="streetAddress">улица Улица, дом 00</span></p>
    <p><a href="https://maps.yandex.ru/?text={Казань}" target="_blank">Схема проезда</a></p>
    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A3db028a5e4086622c50a2b73f91faf12252d15f58f1ada5a49bf6262cade4025&amp;source=constructor" width="467" height="279" frameborder="0"></iframe>
    <div class="sendcontact">
        <form method="post" action="#" id="contact">
            <input type="text" name="contact_name" placeholder="Ваше имя">
            <input type="text" name="contact_email" placeholder="Ваш e-mail">
            <textarea name="contact_text"></textarea>
            <input type="submit" class="btn">
        </form>
    </div>
</div>
