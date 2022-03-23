<?php
include 'path.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <?php include SITE_ROOT . '/app/include/head.php' ?>
    <title>Контакты</title>
</head>
<body>
<div class="wrapper">
    <?php include SITE_ROOT . '/app/include/header.php' ?>
    <main class="main">
        <div style="background-image: url('img/bg_2.jpg');" class="img_first second">
            <div class="cover second"></div>
            <div class="container">
                <div class="txt_img second">
                    Контакты
                </div>
                <div class="txt_img path">
                    <a href="index.php">Главная</a> &#8250; <a href="#">Контакты</a>
                </div>
            </div>
        </div>
        <div class="contact">
            <div class="container">
                <div class="contact_row">
                    <div class="block_contact">
                        <div class="title">
                            Адрес
                        </div>
                        <div class="description">
                            г. Колодищи
                        </div>
                    </div>
                    <div class="block_contact">
                        <div class="title">
                            Телефон
                        </div>
                        <div class="description">
                            +37544101010
                        </div>
                    </div>
                    <div class="block_contact">
                        <div class="title">
                            Почта
                        </div>
                        <div class="description">
                            school@gmail.com
                        </div>
                    </div>
                    <div class="block_contact">
                        <div class="title">
                            Сайт
                        </div>
                        <div class="description">
                            School.by
                        </div>
                    </div>
                </div>
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2350.1233032040222!2d27.774475655098332!3d53.91178478347068!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x78f655931d183942!2zNTPCsDU0JzQyLjQiTiAyN8KwNDYnMjQuMyJF!5e0!3m2!1sru!2sby!4v1642598128650!5m2!1sru!2sby"
                            style="border:0;" allowfullscreen="" loading="lazy"></iframe>

                </div>
            </div>

        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>