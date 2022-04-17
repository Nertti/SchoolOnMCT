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
            <form method="post" class="admin_pages_create">
                <div class="title">Добавление учащегося</div>
                <div class="error_create"><?= $error ?></div>
                <div class="create-for-admin">
                    <label>
                        Фамилия*:
                        <input value="<?= $surname ?>" type="text" name="surname">
                    </label>
                    <label>
                        Имя*:
                        <input value="<?= $name ?>" type="text" name="name">
                    </label>
                    <label>
                        Отчество:
                        <input value="<?= $last_name ?>" type="text" name="last_name">
                    </label>
                    <label>
                        Логин*:
                        <input value="<?= $login ?>" type="text" name="login">
                    </label>
                    <label>
                        Пароль*:
                        <input type="password" name="pass">
                    </label>
                </div>
                <div class="create-btn">
                    <button type="submit" name="btn-add" value="students">Добавить</button>
                    <a href="javascript:history.go(-1)">Назад</a>

                </div>
            </form>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>