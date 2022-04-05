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
                    Администратор
                </div>
                <div class="txt_img path">
                    <a href="<?php echo BASE_URL ?>index.php">Главная</a> &#8250; <a href="#">Администратор</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="admin">
                <div class="admin_info">
                    <div class="title_info_admin"><span>Общая информация</span><span><a href="<?php echo BASE_URL ?>logout.php">Выйти</a></span></div>
                    <div><span>Логин: <?php echo $_SESSION['login'];?> </span><span><?php echo $_SESSION['surname'];?> <?php echo $_SESSION['name'];?></span></div>
                </div>
                <div class="admin_panel">
                    <?php include SITE_ROOT . '/admin/include-admin/admin_panel.php' ?>
                </div>
            </div>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>