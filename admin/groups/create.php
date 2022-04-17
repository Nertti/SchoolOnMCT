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
                <div class="title">Добавление группы</div>
                <div class="error_create"><?= $error ?></div>

                <div class="create-for-admin">
                    <label>
                        Номер:
                        <input value="<?= $number ?>" type="text" name="number">
                    </label>
                    <div class="select">
                        <label>
                            Курс:
                            <select name="id_course">
                                <option value="" selected>'Выбрать'</option>
                                <?php foreach ($courses as $key => $course): ?>
                                    <option value="<?= $course['id_course']; ?>"><?= $course['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <label>
                            Преподаватель:
                            <select name="id_teacher">
                                <option value="" selected>'Выбрать'</option>
                                <?php foreach ($teachers as $key => $teacher): ?>
                                    <option value="<?= $teacher['id_teacher']; ?>"><?= $teacher['surname']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="create-btn">
                    <button type="submit" name="btn-add" value="groups">Добавить</button>
                    <a href="javascript:history.go(-1)">Назад</a>
                </div>

            </form>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>