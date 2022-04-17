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
            <div class="admin_pages">
                <div class="admin_panel">
                    <?php include SITE_ROOT . '/admin/include-admin/admin_panel.php' ?>
                </div>
                <div class="admin_table">
                    <?php include SITE_ROOT . '/admin/include-admin/nav_admin.php' ?>
                    <div class="title_menu">
                        <?php include SITE_ROOT . '/admin/include-admin/admin_panel.php' ?>
                    </div>
                    <div class="title">Уроки</div>
                    <form action="index.php" method="post" class="search_menu">
                        <label>
                            Поиск по названия курса:
                            <input class="search" value="<?= $find_sql ?>" type="text" name="search">
                        </label>
                        <button type="submit" value="selectlessons" name="find">Найти</button>
                        <button type="submit" value="selectlessons" name="reset">Сбросить</button>
                    </form>
                    <div class="head_table">
<!--                        <span class="number">№</span>-->
                        <span class="surname">Курс</span>
                        <span class="price">Группа</span>
                        <span class="price">Дата</span>
                        <span class="price">Время</span>
                        <span class="price">Управление</span>
                    </div>
                    <div class="table">
                        <?php foreach ($lessons as $key => $lesson): ?>
                            <div class="row_table">
<!--                                <span class="number">--><?//= $key + 1; ?><!--</span>-->
                                <span class="surname"><?php echo $lesson['name']?></span>
                                <span class="price"><?= $lesson['number']; ?></span>
                                <span class="price"><?= $lesson['date']; ?></span>
                                <span class="price"><?= $lesson['time_start']; ?></span>
                                <span class="price">
<!--                                <a class="edit" href="student.php?table=students&id_edit=--><?//= $lesson['id_lesson']; ?><!--">Информация</a>-->
                                <a class="delete" onClick="return window.confirm('Удалить урок?');" href="?table=lessons&del_id=<?= $lesson['id_lesson']; ?>">Удалить</a>
                            </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>