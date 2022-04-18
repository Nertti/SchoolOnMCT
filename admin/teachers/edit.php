<?php
include '../../path.php';
include SITE_ROOT . '/app/include/redirectAdmin.php';
//tt($student);
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
                <div class="title">Изменение информации преподавателя</div>
                <div class="error_create"><?= $error ?></div>
                <div class="create-for-admin">
                    <label>
                        <span>Фамилия:</span>
                        <input value="<?= $teacher['surname'] ?>" type="text" name="surname" required>
                    </label>
                    <label>
                        <span>Имя:</span>
                        <input value="<?= $teacher['name'] ?>" type="text" name="name" required>
                    </label>
                    <label>
                        Отчество:
                        <input value="<?= $teacher['last_name'] ?>" type="text" name="last_name">
                    </label>
                    <label>
                        <span>Логин:</span>
                        <input value="<?= $teacher['login'] ?>" type="text" name="login" required>
                    </label>
                    <label>
                        Телефон:
                        <input value="<?= $teacher['phone'] ?>" type="text" name="phone">
                    </label>
                </div>
                <div class="create-btn">
                    <button type="submit" name="btn-update" value="teachers">Обновить</button>
                    <a href="javascript:history.go(-1)">Назад</a>
                </div>
            </form>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>