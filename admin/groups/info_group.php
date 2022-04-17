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
                <div class="admin_table">
                    <div class="admin_menu">
                        <a href="edit.php">Редактировать</a>
                        <a href="javascript:history.go(-1)">Назад</a>
                    </div>                    <div class="title_menu">
                        <?php include SITE_ROOT . '/admin/include-admin/admin_panel.php' ?>
                    </div>
                    <div class="title">Группа <?= $_GET['number']?></div>
                    <?php foreach ($teach_in_group as $key => $teacher): ?>
                        <div class="title teacher_group">Преподаватель: <?php echo $teacher['surname'] . ' ';
                            echo mb_substr($teacher['name'], 0, 1) . '.';
                            echo mb_substr($teacher['last_name'], 0, 1) . '.'; ?></div>
                    <?php endforeach; ?>
                    <div class="head_table">
                        <span class="number">№</span>
                        <a class="surname">Фамилия И.О.</a>
                    </div>
                    <div class="table">
                        <?php foreach ($stud_in_group as $key => $student): ?>
                            <div class="row_table">
                                <span class="number"><?= $key + 1; ?></span>
                                <span><?php echo $student['surname'] . ' ';
                                    echo $student['name'] . ' ';
                                    echo $student['last_name']; ?></span>
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