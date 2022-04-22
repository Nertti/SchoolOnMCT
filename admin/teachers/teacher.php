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
                    <a href="edit.php?table=teachers&id_edit=<?= $teacher['id_teacher']; ?>">Редактировать</a>
                    <a href="javascript:history.go(-1)">Назад</a>
                </div>
                <div class="name"><?= $teacher['surname'] . ' ' . $teacher['name'] . ' ' . $teacher['last_name'] ?></div>
                <div class="info_teacher">
                    <div class="img"></div>
                    <div class="down">
                        <div class="up">
                            <div>
                                <?php if (iconv_strlen($teacher['phone']) == 0): ?>
                                    <div>
                                        <span>Телефон: </span><span class="valueNull">Отсутствует</span>
                                    </div>
                                <?php else: ?>
                                    <div>Телефон: <?= $teacher['phone'] ?></div>
                                <?php endif; ?>
                                <div>Логин: <?= $teacher['login'] ?></div>
                            </div>
                            <div class="group_list">
                                <div>Список групп:</div>
                                <?php if (count(callProc("groupsTeacher", $teacher['id_teacher'])) == 0): ?>
                                    <div class="valueNull">
                                        <span>Отсутствует</span>
                                    </div>
                                <?php else: ?>
                                    <?php foreach (callProc("groupsTeacher", $teacher['id_teacher']) as $key => $group): ?>
                                        <div class="valueNull">
                                            <a class="number_group"
                                               href="../groups/info_group.php?id_group=<?= $group['id_group']; ?>&number=<?= $group['number']; ?>"><?= $group['number']; ?></a>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="title_desc">Описание</div>
                        <div class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, eos!</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>