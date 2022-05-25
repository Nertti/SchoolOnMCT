<?php
include '../../path.php';
include SITE_ROOT . '/app/include/redirectTeacher.php';
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
        <div class="admin_pages_create">
            <div class="admin_menu">
                <a href="../teacher.php?timetable_teacher">Назад</a>
            </div>
            <div class="title">Отметить учащихся на занятии</div>
            <div class="error_create"><?= $error ?></div>

            <div class="add_stud_in_group">
                <div class="admin_table">
                    <div class="head_table">
                        <span class="number">№</span>
                        <a class="surname" href="#">Фамилия И.О.</a>
                        <span class="control">Управление</span>
                    </div>
                    <div class="table">
                        <?php foreach ($stud_in_group as $key => $student): ?>
                            <div class="row_table">
                                <span class="number"><?= $key + 1; ?></span>
                                <span class="surname"><?php echo $student['surname'] . ' ';
                                    echo $student['name'] . ' ';
                                    echo $student['last_name']; ?></span>
                                <span class="control">
                                    <?php if (!isset($student['id_visit'])): ?>
                                        <a class="add" href="?id_lesson=<?= $_GET['id_lesson']; ?>&note_student=<?= $student['id_student']; ?>&id_group=<?= $_GET['id_group'] ?>">Отметить</a>
                                    <?php else: ?>
                                        <img src="https://img.icons8.com/emoji/30/000000/check-mark-emoji.png"/>
                                        <a class="delete" onClick="return window.confirm('Убрать отметку присутствия?');" href="?id_lesson=<?= $_GET['id_lesson']; ?>&note_student_del=<?= $student['id_student']; ?>&id_group=<?= $_GET['id_group'] ?>">Убрать</a>
                                    <?php endif; ?>
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