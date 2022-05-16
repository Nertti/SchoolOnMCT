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
                <div class="title">Создание нового занятия</div>
                <div class="error_create"><?= $error ?></div>

                <div class="create-for-admin">
                    <label class="label_line">
                        <span>Группа:</span>
                        <select name="id_group" required>
                            <option value="" selected>'Выбрать'</option>
                            <?php foreach ($groups as $key => $group): ?>
                                <option value="<?= $group['id_group']; ?>"><?= $group['number']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label class="label_line">
                        <span>Преподаватель:</span>
                        <select name="id_teacher" required>
                            <option value="" selected>'Выбрать'</option>
                            <?php foreach ($teachers as $key => $teacher): ?>
                                <option value="<?= $teacher['id_teacher']; ?>"><?= $teacher['surname']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label>
                        <span>Дата:</span>
                        <input value="<?= $date ?>" type="date" name="date" required>
                    </label>
                    <label>
                        <span>Время начала занятия:</span>
                        <input value="<?= $time_start ?>" type="time" name="time_start" required>
                    </label>
<!--                    <label>-->
<!--                        <span>Время окончания занятия:</span>-->
<!--                        <input value="--><?//= $time_end ?><!--" type="time" name="time_end" required>-->
<!--                    </label>-->
                </div>
                <div class="create-btn">
                    <button type="submit" name="btn-add" value="lessons">Создать</button>
                    <a href="index.php">Назад</a>
                </div>

            </form>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>