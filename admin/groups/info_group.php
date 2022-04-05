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
            <div class="admin_pages">
                <div class="admin_panel">
                    <span>a<?= $_GET['id_group']?></span>
                </div>
                <div class="admin_table">
                    <?php include SITE_ROOT . '/admin/include-admin/nav_admin.php' ?>
                    <div class="title_menu">
                        <?php include SITE_ROOT . '/admin/include-admin/admin_panel.php' ?>
                    </div>
                    <div class="title">Список группы <?= $_GET['number']?></div>
                    <div class="head_table">
                        <span class="number">№</span>
                        <a class="surname">Фамилия И.О.</a>
                    </div>
                    <div class="table">
                        <?php foreach ($stud_in_group as $key => $student): ?>
                            <div class="row_table">
                                <span class="number"><?= $key + 1; ?></span>
                                <span class="surname"><?php echo $student['surname'] . ' ';
                                    echo mb_substr($student['name'], 0, 1) . '.';
                                    echo mb_substr($student['last_name'], 0, 1) . '.'; ?></span>

                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>