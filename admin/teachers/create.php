<?php
include '../../path.php';
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
                <div class="title">Добавление преподавателя</div>
                <div class="create_block_student">
                    <div class="fio">
                        <label>
                            Имя:
                            <input type="text" name="name">
                        </label>
                        <label>
                            Фамилия:
                            <input type="text" name="surname">
                        </label>
                        <label>
                            Отчество:
                            <input type="text" name="last_name">
                        </label>
                    </div>
                    <div class="login">
                        <label>
                            Телефон:
                            <input type="text" name="phone">
                        </label>
                        <label>
                            Логин:
                            <input type="text" name="login">
                        </label>
                        <label>
                            Пароль:
                            <input type="password" name="pass">
                        </label>
                    </div>
                </div>
                <div class="control_buts">
                    <button name="btn-add" value="teachers" class="button" type="submit">Добавить</button>
                    <button class="button reset" type="reset">Очистить</button>
                    <button name="btn-back" class="button reset" type="submit">Отмена</button>
                </div>
            </form>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>