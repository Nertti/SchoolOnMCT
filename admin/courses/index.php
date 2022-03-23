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
            <div class="admin_pages">
                <div class="admin_panel">
                    <?php include SITE_ROOT . '/admin/include-admin/admin_panel.php' ?>
                </div>
                <div class="admin_table">
                    <?php include SITE_ROOT . '/admin/include-admin/nav_admin.php' ?>
                    <div class="title_menu">
                        <?php include SITE_ROOT . '/admin/include-admin/admin_panel.php' ?>
                    </div>
                    <div class="title">Курсы</div>
                    <form action="index.php" method="post" class="search_menu">
                        <label>
                            Поиск по названию:
                            <input class="search" value="<?= $find_sql ?>" type="text" name="search">
                        </label>
                        <button type="submit" value="courses" name="find">Найти</button>
                        <button type="submit" value="courses" name="reset">Сбросить</button>
                    </form>
                    <div class="head_table">
                        <span class="number">№</span>
                        <a class="surname<?php echo sort_link_bar('Название', 'name_asc', 'name_desc', 'courses'); ?></a>
                        <a class="price<?php echo sort_link_bar('Стоимость', 'price_asc', 'price_desc', 'courses'); ?></a>
                        <span class="control">Управление</span>
                    </div>
                    <div class="table">
                        <?php foreach ($courses as $key => $course): ?>
                            <div class="row_table">
                                <span class="number"><?= $key + 1; ?></span>
                                <span class="surname"><?php echo $course['name']?></span>
                                <span class="balance"><?= $course['price']; ?> BYN</span>
                                <span class="control">
                                <a class="edit" href="#">Изменить</a>
                                <a class="delete" href="?table=courses&del_id=<?= $course['id_course']; ?>">Удалить</a>
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