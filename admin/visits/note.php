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
        <div class="admin_pages_create">
            <div class="admin_menu">
                <a href="index.php">Назад</a>
            </div>
            <div class="title">Отметить учащихся на занятии</div>
            <div class="error_create"><?= $error ?></div>

            <div class="add_stud_in_group">
                <!--                <div class="admin_table">-->
                <!--                    <div class="title">Отмеченные</div>-->
                <!--                    <div class="head_table">-->
                <!--                        <span class="number">№</span>-->
                <!--                        <a class="surname" href="#">Фамилия И.О.</a>-->
                <!--                        <span class="control">Управление</span>-->
                <!--                    </div>-->
                <!--                    <div class="table">-->
                <!--                        --><?php //foreach ($stud_in_group as $key => $student): ?>
                <!--                            <div class="row_table">-->
                <!--                                <span class="number">--><?php //= $key + 1; ?><!--</span>-->
                <!--                                <span class="surname">--><?php //echo $student['surname'] . ' ';
                //                                    echo $student['name'] . ' ';
                //                                    echo $student['last_name']; ?><!--</span>-->
                <!--                                <span class="control">-->
                <!--                                <a class="delete" onClick="return window.confirm('Удалить учащегося из группы?');"-->
                <!--                                   href="?id_group=-->
                <?php //= $_GET['id_group']; ?><!--&del_id_accounting=-->
                <?php //= $student['id_accounting']; ?><!--">Убрать</a>-->
                <!--                                </span>-->
                <!--                            </div>-->
                <!--                        --><?php //endforeach; ?>
                <!--                    </div>-->
                <!--                </div>-->
                <div class="admin_table">
                    <!--                    <div class="title">Неотмеченные</div>-->
                    <div class="head_table">
<!--                        <span class="number">№</span>-->
                        <a class="surname" href="#">Фамилия И.О.</a>
                        <span class="control">Управление</span>
                    </div>
                    <div class="table">
                        <?php foreach ($stud_in_group as $key => $student): ?>
                            <div class="row_table">
                                <span class="surname"><?php echo $student['surname'] . ' ';
                                    echo $student['name'] . ' ';
                                    echo $student['last_name']; ?></span>
                                <span class="control">
                                    <?php if (isset($student['id_visit']) and $student['id_lesson'] == $_GET['id_lesson'] and $student['id_timetable'] == $_GET['name_l']): ?>
                                        <img src="https://img.icons8.com/emoji/30/000000/check-mark-emoji.png"/>
                                        <a class="delete" onClick="return window.confirm('Убрать отметку присутствия?');"
                                           href="?id_lesson=<?= $_GET['id_lesson'] ?>&note_student_del=<?= $student['id_student']; ?>&id_group=<?= $_GET['id_group'] ?>&name_l=<?= $_GET['name_l'] ?>">Убрать</a>
                                    <?php else: ?>
                                        <a class="add"
                                           href="note.php?id_lesson=<?= $_GET['id_lesson'] ?>&note_student=<?= $student['id_student'] ?>&id_group=<?= $_GET['id_group'] ?>&name_l=<?= $_GET['name_l'] ?>">Отметить</a>
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