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
                <div class="title">Зачисление в группу учащегося</div>
                <div class="create_block_student">
                    <div class="fio">
                        <label> Курс:
                            <select name="id_group">
                                <option value="" selected>'Выбрать'</option>
                                <?php foreach ($groups as $key => $group): ?>
                                    <option value="<?=$group['id_group'];?>"><?=$group['number'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </div>
                    <div class="login">

                    </div>
                </div>
                <div class="control_buts">
                    <button name="btn-add" value="accounting" class="button" type="submit">Добавить</button>
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