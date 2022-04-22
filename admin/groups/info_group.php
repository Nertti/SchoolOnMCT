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
                        <a style="margin: 0 auto 0 0"
                           href="editStudentInGroup.php?id_group=<?= $_GET['id_group']; ?>">Добавить/Удалить
                            участников</a>
                        <a href="edit.php?table=groups&id_edit=<?= $_GET['id_group']; ?>">Редактировать</a>
                        <a href="index.php">Назад</a>
                    </div>
                    <div class="title_menu">
                        <?php include SITE_ROOT . '/admin/include-admin/admin_panel.php' ?>
                    </div>
                    <div class="title">Группа <?= $_GET['number'] ?></div>
                    <?php if (count($teach_in_group) == 0): ?>
                        <div class="title teacher_group">Преподаватель: <span class="valueNull">Отсутствует</span></div>
                    <?php else: ?>
                        <?php foreach ($teach_in_group as $key => $teacher): ?>
                            <div class="title teacher_group">Преподаватель: <?php echo $teacher['surname'] . ' ';
                                echo mb_substr($teacher['name'], 0, 1) . '.';
                                echo mb_substr($teacher['last_name'], 0, 1) . '.'; ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="head_table little">
                        <span class="number">№</span>
                        <a class="surname">Фамилия И.О.</a>
                    </div>
                    <div class="table">
                        <?php foreach ($stud_in_group as $key => $student): ?>
                            <div class="row_table little">
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