<?php
include '../path.php';
include SITE_ROOT . '/app/include/redirectUser.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include SITE_ROOT . '/app/include/head.php' ?>
    <title>Личный кабинет</title>
</head>
<body>
<div class="wrapper">

    <?php include SITE_ROOT . '/app/include/header.php' ?>
    <main class="main">
        <div style="background-image: url('../img/bg_2.jpg');" class="img_first second">
            <div class="cover second"></div>
            <div class="container">
                <div class="txt_img second">
                    Личный кабинет
                </div>
                <div class="txt_img path">
                    <a href="<?php echo BASE_URL ?>index.php">Главная</a> &#8250; <a href="#">Личный кабинет</a>
                </div>
            </div>
        </div>
        <div style="visibility: hidden" class="user_img">
            <a href="#" class="edit_img">Изменить</a>
        </div>
        <div class="user_name">
            <span class="title"><?php echo $_SESSION['surname']; ?> <?php echo $_SESSION['name']; ?></span>
        </div>
        <div class="container">
            <div class="user">
                <div class="title">
                    <span>Общая информация</span>
                    <span>
                        <a href="timetable.php?timetable_user">Расписание</a>
                        <a href="<?php echo BASE_URL ?>logout.php">Выйти</a>
                    </span>
                </div>
                <div class="general_info_user">
                    <div class="info_block">
                        <div class="label">Почта</div>
                        <div class="label">Группа</div>
                    </div>
                    <div class="result_block">
                        <?php if (iconv_strlen($_SESSION['mail']) == 0): ?>
                            <div class="label valueNull">Отсутствует</div>
                        <?php else: ?>
                            <div class="label"><?= $_SESSION['mail']; ?></div>
                        <?php endif; ?>

                        <?php if (count(callProc("GroupOnStud", $_SESSION['id_student'])) == 0): ?>
                            <div class="label valueNull">Отсутствует</div>
                        <?php else: ?>
                            <?php foreach (callProc("GroupOnStud", $_SESSION['id_student']) as $key => $group): ?>
                                <div class="label">
                                    <a class="label"
                                       href="info_group.php?id_group=<?= $group['id_group']; ?>&number=<?= $group['number']; ?>"><?= $group['number']; ?></a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="info_block">
                        <div class="label">Логин</div>
                        <div class="label">Телефон</div>
                        <div class="label">Баланс</div>
                    </div>
                    <div class="result_block">
                        <div class="label">
                            <?php echo $_SESSION['login']; ?>
                        </div>
                        <?php if (iconv_strlen($_SESSION['phone']) == 0): ?>
                            <div class="label valueNull">Отсутствует</div>
                        <?php else: ?>
                            <div class="label"><?= $_SESSION['phone']; ?></div>
                        <?php endif; ?>
                        <div class="label valueNull">
                            <?php echo $_SESSION['balance']; ?> BYN
                        </div>
                    </div>
                </div>

<!--                <div class="timetable_user">-->
<!--                                        <span class="msg">Вы не записаны ни на один курс</span>-->
<!--                    <span class="msg">Ещё в разработке :)</span>-->
<!--                </div>-->
            </div>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>
