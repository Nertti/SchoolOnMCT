<?php
include '../path.php';
include SITE_ROOT . '/app/include/redirectTeacher.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include SITE_ROOT . '/app/include/head.php' ?>
    <title>Личный кабинет</title>
</head>
<body>
<div class="wrapper">

    <?php include SITE_ROOT . '/app/include/header.php'?>
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
        <div class="user dark">
            <div class="timetable_user">
                <div class="admin_pages max">
                    <div class="admin_table">
                        <div class="admin">
                            <div class="admin_info">
                                <div class="title_info_admin"><span>Общая информация</span><span><a href="<?php echo BASE_URL ?>logout.php">Выйти</a></span></div>
                                <div><span>Логин: <?php echo $_SESSION['login'];?> </span><span><?php echo $_SESSION['surname'];?> <?php echo $_SESSION['name'];?> <?php echo $_SESSION['last_name'];?></span></div>
                            </div>
                        </div>
                        <div class="title"><span>Расписание</span><span><a href="visits/index.php">Отметить присутствующих</a></span></div>
                        <div class="head_table">
                            <span class="number">№</span>
                            <?php for ($i = 0; $i < 6; $i++): ?>

                                <span class="timetable_block">
                            <span><?=$day_of_week[$i]?></span>
                            <span><?=$week[$i]?></span>
                        </span>

                            <?php endfor; ?>

                        </div>
                        <div class="table">
                            <?php for ($i = 1; $i <= 6; $i++): ?>
                                <div class="row_table">
                                    <span class="number"><?=$i?></span>
                                    <?php
                                    ${'this_date'.$i} = date('Y-m-d', strtotime('monday this week'));
                                    ?>
                                    <?php foreach (${'lessons'.$i} as $key => $lesson): ?>
                                        <?php while ($lesson['date'] !== ${'this_date'.$i}): ?>
                                            <span class=" timetable_block"></span>
                                            <?php
                                            ${'this_date'.$i} = date('Y-m-d', strtotime(${'this_date'.$i} . '+ 1 day'));
                                            ?>
                                        <?php endwhile; ?>
                                        <span class=" timetable_block">
                                        <span style="display: flex; justify-content: space-around">
                                            <span title="<?= $lesson['name'] ?>" class="perenos"><?= $lesson['name'] ?></span>
                                            <a href="?id_group=<?=$lesson['id_group']?>"><?=$lesson['number']?></a>
                                        </span>
                                        <span>
                                            <?=$lesson['surname']?>
                                            <?= ' ' . mb_substr($lesson['name_t'], 0, 1) . '.' ?>
                                            <?= mb_substr($lesson['last_name'], 0, 1) . '.' ?>
                                        </span>
                                    </span>
                                        <?php
                                        ${'this_date'.$i} = date('Y-m-d', strtotime(${'this_date'.$i} . '+ 1 day'));
                                        ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <div id="popup_edit_info" class="popup">
        <div class="popup_body">
            <div class="popup_content">
                <a href="#" class="popup_close"></a>
                <div class="edit_user_info">
                    <!--                    <div class="title_edit_info">-->
                    <!--                        Настройки-->
                    <!--                    </div>-->
                    <div class="body_edit_info">
                        <form method="post" action="">
                            <label>
                                Имя:
                                <input type="text" name="name">
                            </label>
                            <label>
                                Фамилия:
                                <input type="text" name="surname">
                            </label>
                            <label>
                                Отчество:
                                <input type="text" name="last_name">
                            </label>
                            <label>
                                Логин:
                                <input type="text" name="surname">
                            </label>
                            <label>
                                Почта:
                                <input type="text" name="surname">
                            </label>
                            <label>
                                Телефон:
                                <input type="text" name="surname">
                            </label>
                            <button type="submit" name="btn-save-user" class="button">
                                Сохранить
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>
