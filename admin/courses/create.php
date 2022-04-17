<?php
include '../../path.php';
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
        <div class="container">
            <form class="admin_pages_create" action="" method="post">
                <div class="title">Добавление курса</div>
                <div class="error_create"><?= $error ?></div>

                <div class="create-for-admin">
                    <label>
                        Название:
                        <input value="<?= $name ?>" type="text" name="name">
                    </label>
                    <label>
                        Стоимость:
                        <input value="<?= $price ?>" type="number" min="0" max="999" name="price">
                    </label>
                </div>
                <div class="create-btn">
                    <button type="submit" name="btn-add" value="courses">Добавить</button>
                    <a href="javascript:history.go(-1)">Назад</a>

                </div>
            </form>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>