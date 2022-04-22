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
        <div class="admin_pages_create">
            <div class="admin_menu">
               <a href="index.php">Вернуться на группы</a>
            </div>
            <div class="title">Изменение состава группы</div>
            <div class="add_stud_in_group">
                <div class="admin_table">
                    <div class="title">Учащиеся группы</div>
                    <div class="search_menu">
                        <label>
                            Поиск по фамилии:
                            <input class="search" type="text" name="search">
                        </label>
                        <button>Найти</button>
                        <a href="#">Сбросить</a>
                    </div>
                    <div class="head_table">
                        <span class="number">№</span>
                        <a class="surname" href="#">Фамилия И.О.</a>
                        <span class="control">Управление</span>
                    </div>
                    <div class="table">
                        <?php foreach ($stud_in_group as $key => $student): ?>
                            <div class="row_table">
                                <span class="number"><?= $key + 1; ?></span>
                                <span class="surname"><?php echo $student['surname'] . ' ';
                                    echo $student['name'] . ' ';
                                    echo $student['last_name']; ?></span>
                                <span class="control">
                                <a class="delete" onClick="return window.confirm('Удалить учащегося из группы?');"
                                   href="?id_group=<?= $_GET['id_group']; ?>&del_id_accounting=<?= $student['id_accounting']; ?>">Удалить</a>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="admin_table">
                    <div class="title">Остальные учащиеся</div>
                    <div class="search_menu">
                        <label>
                            Поиск по фамилии:
                            <input class="search" type="text" name="search">
                        </label>
                        <button>Найти</button>
                        <a href="#">Сбросить</a>
                    </div>
                    <div class="head_table">
                        <span class="number">№</span>
                        <a class="surname" href="#">Фамилия И.О.</a>
                        <span class="control">Управление</span>
                    </div>
                    <div class="table">
                        <?php foreach ($stud_in_not_group as $key => $student): ?>
                            <div class="row_table">
                                <span class="number"><?= $key + 1; ?></span>
                                <span class="surname"><?php echo $student['surname'] . ' ';
                                    echo $student['name'] . ' ';
                                    echo $student['last_name']; ?></span>
                                <span class="control">
                                <a class="add" href="?id_group=<?= $_GET['id_group']; ?>&add_id_student=<?= $student['id_student']; ?>">Добавить</a>
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