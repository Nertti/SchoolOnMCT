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
                    <a style="margin: 0 auto 0 0"
                       href="create_pay.php?id_student_pay=<?= $student['id_student'] ?>">Внести оплату</a>
                    <a href="edit.php?table=students&id_edit=<?= $student['id_student']; ?>">Редактировать</a>
                    <a href="javascript:history.go(-1)">Назад</a>
                </div>
                <div class="name"><?= $student['surname'] . ' ' . $student['name'] . ' ' . $student['last_name'] ?></div>
                <div class="info_student">
                    <div class="contact">
                        <?php if (iconv_strlen($student['mail']) == 0): ?>
                            <div>
                                <span>Почта: </span><span class="valueNull">Отсутствует</span>
                            </div>
                        <?php else: ?>
                            <div>Почта: <?= $student['mail'] ?></div>
                        <?php endif; ?>
                        <?php if (iconv_strlen($student['phone']) == 0): ?>
                            <div>
                                <span>Телефон: </span><span class="valueNull">Отсутствует</span>
                            </div>
                        <?php else: ?>
                            <div>Телефон: <?= $student['phone'] ?></div>
                        <?php endif; ?>
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
            </div>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>