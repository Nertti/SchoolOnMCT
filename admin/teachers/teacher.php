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
<!--                    <div class="img"></div>-->
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
                        </div>
                        <div class="title_desc">Описание</div>
                        <?php if (iconv_strlen($teacher['description']) == 0): ?>
                            <div class="description valueNull">Отсутствует</div>
                        <?php else: ?>
                            <div class="description"><?= $teacher['description'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>