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
                <div class="title">Оплата учащегося</div>
                <div class="create_block_student">
                    <div class="fio">
                        <label>
                            Номер документа:
                            <input type="text" name="number">
                        </label>
                    </div>
                    <div class="login">
                        <label>
                            Сумма:
                            <input type="number" name="summary">
                        </label>
                    </div>
                </div>
                <div class="control_buts">
                    <button name="btn-add" value="pay" class="button" type="submit">Добавить</button>
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