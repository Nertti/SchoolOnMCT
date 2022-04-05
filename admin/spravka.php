<?php
include '../path.php';
include SITE_ROOT . '/app/include/redirectAdmin.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include SITE_ROOT . '/app/include/head.php' ?>
    <title>Администратор</title>
</head>
<body>
<div class="wrapper">

    <?php include SITE_ROOT . '/app/include/header.php' ?>
    <main class="main">

        <div class="block_spravka">

            <div class="title">Справка</div>
            <div class="title_block_spravk">О приложении</div>
            <div class="flex_information">
                <div class="name_proj">Имя продукта: Автоматизация рабочего места администратора инженерной школы</div>
                <div class="version">Версия: 0.0.1123442</div>
                <div class="name_company">Имя заказчика: ООО "Минский городской технопарк"</div>
                <div class="name_me">Разработчик: Неретин Даниил Александрович</div>
            </div>
            <div class="title_block_spravk">Об использовании</div>
            <div class="spravk">
                Данное веб приложение предназначено для автоматизации администратора инженерной школы.
                После авторизации от имени администратора, Вы попадаете на общую страницу администратора,
                где показывается информация о вашем профиле и выведены доступные таблицы для изменения.
                В них есть возможность поиска и сортировки информации. А так же добавление, изменение и удаление строк.
                Для учеников предусмотрены зачисление оплаты за обучение в баланс учащегося и зачисление в группу.
            </div>

        </div>

    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>