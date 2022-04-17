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
            <div class="info_page">
                <div class="admin_menu">
                    <a href="edit.php?table=students&id_edit=<?= $student['id_student']; ?>">Редактировать</a>
                    <a href="javascript:history.go(-1)">Назад</a>
                </div>
                <div class="name"><?= $student['surname'] . ' ' . $student['name'] . ' ' . $student['last_name'] ?></div>
                <div class="info_student">
                    <div class="contact">
                        <div>Почта: <span class="valueNull"><?= $student['mail'] ?></span></div>
                        <div>Телефон: <span class="valueNull"><?= $student['phone'] ?></span></div>
                    </div>
                    <div class="groups">
                        <div class="tag_group">Группа:</div>
                        <div>
                            <?php if (count(callProc("GroupOnStud", $student['id_student'])) == 0): ?>
                                <div class="valueNull">
                                    <span>Отсутствует</span>
                                </div>
                            <?php else: ?>
                                <?php foreach (callProc("GroupOnStud", $student['id_student']) as $key => $group): ?>
                                    <div class="valueNull">
                                        <a class="number_group"
                                           href="../groups/info_group.php?id_group=<?= $group['id_group']; ?>&number=<?= $group['number']; ?>"><?= $group['number']; ?></a>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="login">
                        <div>Логин: <?= $student['login'] ?></div>
                        <div>Баланс: <?= $student['balance'] ?> BYN</div>
                    </div>
                </div>
                <div class="edit_line_student">
                    <a href="create_pay.php?id_student_pay=<?= $student['id_student'] ?>">Внести оплату</a>
                </div>

            </div>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>