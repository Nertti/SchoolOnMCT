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
                    <div class="title">Уроки сегодня (<?=date('d.m')?>)</div>
<!--                    <form action="index.php" method="post" class="search_menu">-->
<!--                        <label>-->
<!--                            Поиск по названия группы:-->
<!--                            <input class="search" value="--><?//= $find_sql ?><!--" type="text" name="search">-->
<!--                        </label>-->
<!--                        <button type="submit" value="selectlessons" name="find">Найти</button>-->
<!--                        <button type="submit" value="selectlessons" name="reset">Сбросить</button>-->
<!--                    </form>-->
                    <div class="head_table">
                        <span class="number">№</span>
                        <span class="price">Группа</span>
                        <span class="surname">Курс</span>
                        <span class="control">Управление</span>
                    </div>
                    <div class="table">
                        <?php foreach ($lessonsVisits as $key => $lesson): ?>
                            <div class="row_table">
                                <span class="number"><?= $lesson['name_l']; ?></span>
                                <span class="price"><?= $lesson['number']; ?></span>
                                <span class="surname"><?php echo $lesson['name']?></span>

                                <span class="control" >
                                <a class="add" href="note.php?id_group=<?= $lesson['id_group'] ?>&id_lesson=<?= $lesson['id_lesson'] ?>">Отметить учащихся</a>
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