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
            <form class="admin_pages_create" action="" method="post">
                <div class="title">Изменение информации учащегося</div>
                <div class="create_block_student">
                    <div class="fio">
                        <label>
                            Имя:
                            <input type="text" value="<?= $student['name'] ?>"  name="name">
                        </label>
                        <label>
                            Фамилия:
                            <input type="text" value="<?= $student['surname'] ?>"  name="surname">
                        </label>
                        <label>
                            Отчество:
                            <input type="text" value="<?= $student['last_name'] ?>" name="last_name">
                        </label>
                    </div>
                    <div class="login">

                        <a href="create_pay.php?id_student=<?= $student['id_student'] ?>">Оплата</a>
                        <a href="create_test_accounting.php?id_student=<?= $student['id_student'] ?>">Зачисление в группу</a>
                    </div>
                </div>
                <div class="control_buts">
                    <button name="btn-update" value="students" class="button" type="submit">Изменить</button>
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