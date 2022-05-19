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
        <div style="background-image: url('../img/bg_2.jpg');" class="img_first second">
            <div class="cover second"></div>
            <div class="container">
                <div class="txt_img second">
                    Отчёты
                </div>
                <div class="txt_img path">
                    <a href="<?php echo BASE_URL ?>index.php">Главная</a> &#8250; <a href="#">Отчёты</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="admin">
                <div class="admin_info">
                    <div class="title_info_admin"><span>Создать отчёт</span><span><a href="<?php echo BASE_URL ?>logout.php">Выйти</a></span></div>
                </div>
                <div class="admin_panel">
                    <a class="menu_block" href="?report_teach">Занятость преподавателей за предыдущий месяц</a>
                    <a class="menu_block" href="<?php echo BASE_URL ?>">Статистика посещений занятий учащимися</a>
                </div>
            </div>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>