<?php
include '../../path.php';
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
            <form class="admin_pages_create" action="" method="post">
                <div class="title">Добавление группы</div>
                <div class="create_block_student">
                    <div class="fio">
                        <label>
                            Номер:
                            <input type="text" name="number">
                        </label>
                    </div>
                    <div class="login">
                        <label> Курс:
                            <select name="id_course">
                                <option value="" selected>'Выбрать'</option>
                                <?php foreach ($courses as $key => $course): ?>
                                    <option value="<?=$course['id_course'];?>"><?=$course['name'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <label> Преподаватели:
                            <select name="id_teacher">
                                <option value="" selected>'Выбрать'</option>
                                <?php foreach ($teachers as $key => $teacher): ?>
                                    <option value="<?=$teacher['id_teacher'];?>"><?=$teacher['surname'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="control_buts">
                    <button name="btn-add" value="groups" class="button" type="submit">Добавить</button>
                    <button class="button reset" type="reset">Очистить</button>
                    <button name="btn-back" class="button reset" type="submit">Отмена</button>
                </div>
            </form>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>