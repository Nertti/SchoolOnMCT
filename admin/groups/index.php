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
                    <?php include SITE_ROOT . '/admin/include-admin/admin_panel.php' ?>
                </div>
                <div class="admin_table">
                    <?php include SITE_ROOT . '/admin/include-admin/nav_admin.php' ?>
                    <div class="title_menu">
                        <?php include SITE_ROOT . '/admin/include-admin/admin_panel.php' ?>
                    </div>
                    <div class="title">Группы</div>
                    <form action="index.php" method="post" class="search_menu">
                        <label>
                            Поиск по номеру:
                            <input class="search" value="<?= $find_sql ?>" type="text" name="search">
                        </label>
                        <button type="submit" value="groups" name="find">Найти</button>
                        <button type="submit" value="groups" name="reset">Сбросить</button>
                    </form>
                    <div class="head_table">
                        <span class="number">№</span>
                        <a class="price<?php echo sort_link_bar('Номер', 'number_asc', 'number_desc', 'groups'); ?></a>
                        <a class="count<?php echo sort_link_bar('Кол-во учащихся', 'count_students_asc', 'count_students_desc', 'groups'); ?></a>
                        <span class="control">Управление</span>
                    </div>
                    <div class="table">
                        <?php foreach ($groups as $key => $group): ?>
                            <div class="row_table">
                                <span class="number"><?= $key + 1; ?></span>
                                <span class="price"><?= $group['number']?></span>
                                <span class="count"><?= $group['count_students']; ?></span>
                                <span class="control">
                                <a class="edit" href="info_group.php?id_group=<?= $group['id_group']; ?>&number=<?= $group['number']; ?>">Информация</a>
                                <a class="delete" onClick="return window.confirm('Удалить группу?');" href="?table=groups&del_id=<?= $group['id_group']; ?>">Удалить</a>
                            </span>
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