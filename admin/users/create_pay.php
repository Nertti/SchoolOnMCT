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
                <div class="title">Оплата учащегося(йся) <?php echo $student['surname'] . ' ';
                    echo mb_substr($student['name'], 0, 1) . '.';
                    echo mb_substr($student['last_name'], 0, 1) . '.'; ?></div>
                <div class="error_create"><?= $error ?></div>

                <div class="create-for-admin">
                    <label>
                        <span>Номер документа:</span>
                        <input value="<?= $number ?>" type="text" name="number" required>
                    </label>
                    <label>
                        <span>Сумма:</span>
                        <input value="<?= $summary ?>" type="number" min="0" name="summary" required>
                    </label>
                </div>
                <div class="create-btn">
                    <button type="submit" name="btn-add" value="pay">Зачислить</button>
                    <a href="javascript:history.go(-1)">Назад</a>
                </div>
            </form>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>