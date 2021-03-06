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
                <div class="title">Добавление преподавателя</div>
                <div class="error_create"><?= $error ?></div>

                <div class="create-for-admin">
                    <label>
                        <span>Фамилия:</span>
                        <input value="<?= $surname ?>" type="text" name="surname" required>
                    </label>
                    <label>
                        <span>Имя:</span>
                        <input value="<?= $name ?>" type="text" name="name" required>
                    </label>
                    <label>
                        Отчество:
                        <input value="<?= $last_name ?>" type="text" name="last_name">
                    </label>
                    <label>
                        Телефон:
                        <input value="<?= $phone ?>" type="text" name="phone" placeholder="+375 хх ххх хх хх">
                    </label>
                    <label>
                        <span>Логин:</span>
                        <input value="<?= $login ?>" type="text" name="login" required>
                    </label>
                    <label>
                        <span>Пароль:</span>
                        <input type="password" name="pass" required>
                    </label>
                    <label class="label_line">
                        <span>Ставка:</span>
                        <select name="id_time_work" required>
                            <option value="" selected>'Выбрать'</option>
                            <?php foreach ($time_work as $key => $time): ?>
                                <option value="<?= $time['id_time_work']; ?>"><?= $time['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
                <div class="create-btn">
                    <button type="submit" name="btn-add" value="teachers">Добавить</button>
                    <a href="index.php">Назад</a>

                </div>
            </form>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>