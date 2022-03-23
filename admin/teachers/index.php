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
                    <div class="title">Преподаватели</div>
                    <form action="index.php" method="post" class="search_menu">
                        <label>
                            Поиск по фамилии:
                            <input class="search" value="<?= $find_sql ?>" type="text" name="search">
                        </label>
                        <button type="submit" value="teachers" name="find">Найти</button>
                        <button type="submit" value="teachers" name="reset">Сбросить</button>
                    </form>
                    <div class="head_table">
                        <span class="number">№</span>
                        <a class="surname<?php echo sort_link_bar('Фамилия И.О.', 'surname_asc', 'surname_desc', 'teachers'); ?></a>
                        <span class="control">Управление</span>
                    </div>
                    <div class="table">
                        <?php foreach ($teachers as $key => $teacher): ?>
                            <div class="row_table">
                                <span class="number"><?= $key + 1; ?></span>
                                <span class="surname"><?php echo $teacher['surname'] . ' ';
                                    echo mb_substr($teacher['name'], 0, 1) . '.';
                                    echo mb_substr($teacher['last_name'], 0, 1) . '.'; ?></span>
<!--                                <span class="balance">--><?//= $student['balance']; ?><!-- BYN</span>-->
                                <span class="control">
                                <a class="edit" href="#">Изменить</a>
                                <a class="delete" href="?table=teachers&del_id=<?= $teacher['id_teacher']; ?>">Удалить</a>
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