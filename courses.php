<?php
include 'path.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <?php include SITE_ROOT . '/app/include/head.php' ?>
    <title>Курсы</title>
</head>
<body>
<div class="wrapper">
    <?php include SITE_ROOT . '/app/include/header.php' ?>
    <main class="main">
        <div style="background-image: url('img/bg_2.jpg');" class="img_first second">
            <div class="cover second"></div>
            <div class="container">
                <div class="txt_img second">
                    Курсы
                </div>
                <div class="txt_img path">
                    <a href="index.php">Главная</a> &#8250; <a href="#">Курсы</a>
                </div>
            </div>
        </div>
        <div class="head_block">
            <div class="container">
                <div class="title"><span class="title_blue">Наши</span> <span class="title_yellow">курсы</span></div>
                <div class="description">Separated they live in. A small river named Duden flows by their place and
                    supplies
                    it with the necessary regelialia. It is a paradisematic country
                </div>
            </div>
        </div>
        <div class="courses">
            <div class="container">
                <div class="our">
                    <div class="lesson">
                        <div class="img" style="background-image: url('img/course-1.jpg')"></div>
                        <div class="txt_lesson">
                            <div class="title">
                                Конструирование
                            </div>
                            <div class="time">
                                Время занятий: Среда
                            </div>
                            <div class="description">
                                Образовательная робототехника – это направление, в котором осуществляется современный
                                подход к внедрению элементов технического творчества в учебный процесс.
                            </div>
                        </div>
                    </div>
                    <div class="lesson">
                        <div class="img" style="background-image: url('img/course-2.jpg')"></div>
                        <div class="txt_lesson">
                            <div class="title">
                                Схемотехника
                            </div>
                            <div class="time">
                                Время занятий: Вторник
                            </div>
                            <div class="description">
                                Знания пригодятся ребятам как для учебы (понимание места и роли учебных
                                предметов и их значимость в повседневной жизни), так и для дальнейшего
                                профессионального самоопределения.
                            </div>
                        </div>
                    </div>
                    <div class="lesson">
                        <div class="img" style="background-image: url('img/course-3.jpg')"></div>
                        <div class="txt_lesson">
                            <div class="title">
                                Компьютерная графика
                            </div>
                            <div class="time">
                                Время занятий: Среда
                            </div>
                            <div class="description">
                                Компьютерная графика — это возможность научиться пользоваться всей палитрой цветов и
                                самыми разными инструментами. Ваши дети с нуля научатся создавать смелые креативные
                                концепции графических изображений.
                            </div>
                        </div>
                    </div>
                    <div class="lesson">
                        <div class="img" style="background-image: url('img/course-4.jpg')"></div>
                        <div class="txt_lesson">
                            <div class="title">
                                Программирование
                            </div>
                            <div class="time">
                                Время занятий: Четверг
                            </div>
                            <div class="description">
                                Данный курс совместил приятное с полезным: ребята знакомятся с понятиями «умные вещи»,
                                «интернет вещей» и др. На каждом занятии учащиеся сами собирают различные устройства,
                                изучают принципы его работы, основы программирования.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>