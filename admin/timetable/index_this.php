<?php
include '../../path.php';
include SITE_ROOT . '/app/include/redirectAdmin.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?php include SITE_ROOT . '/app/include/head.php' ?>
    <title>Администратор</title>
</head>
<body>
<div class="wrapper">
    <?php include SITE_ROOT . '/app/include/header.php' ?>

    <main class="main">
        <div class="">
            <div class="admin_pages">
                <div class="admin_table">
                    <div class="title">Расписание на текущую неделю</div>
                    <form action="" method="post" class="search_menu">
                        <label class="label_line">
                            <span>Группа:</span>
                            <select name="id_group" required>
                                <option value="" selected>'Выбрать'</option>
                                <?php foreach ($groups as $key => $group): ?>
                                    <option value="<?= $group['id_group']; ?>"><?= $group['number']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <button type="submit" value="selectlessons" name="find_timetable">Показать</button>
<!--                        <button type="submit" value="selectlessons" name="reset">Сбросить</button>-->
                    <a class="right bold_text" href="index_next.php">Следующая неделя</a>
                    </form>
                    <div class="head_table">
                        <span class="number">№</span>
                        <?php for ($i = 0; $i < 6; $i++): ?>

                        <span class="timetable_block">
                            <span><?=$day_of_week[$i]?></span>
                            <span><?=$week[$i]?></span>
                        </span>

                        <?php endfor; ?>

                    </div>
                    <div class="table">
                        <?php for ($i = 1; $i <= 6; $i++): ?>
                            <div class="row_table">
                                <span class="number"><?=$i?></span>
                                <?php
                                ${'this_date'.$i} = date('Y-m-d', strtotime('monday this week'));
                                ?>
                                <?php foreach (${'lessons'.$i} as $key => $lesson): ?>
                                    <?php while ($lesson['date'] !== ${'this_date'.$i}): ?>
                                        <span class=" timetable_block"></span>
                                        <?php
                                        ${'this_date'.$i} = date('Y-m-d', strtotime(${'this_date'.$i} . '+ 1 day'));
                                        ?>
                                    <?php endwhile; ?>
                                    <span class=" timetable_block">
                                        <span style="display: flex; justify-content: space-around">
                                            <span title="<?= $lesson['name'] ?>" class="perenos"><?= $lesson['name'] ?></span>
                                            <a href="../groups/info_group.php?id_group=<?=$lesson['id_group']?>"><?=$lesson['number']?></a>
                                        </span>
                                        <span>
                                            <?=$lesson['surname']?>
                                            <?= ' ' . mb_substr($lesson['name_t'], 0, 1) . '.' ?>
                                            <?= mb_substr($lesson['last_name'], 0, 1) . '.' ?>
                                        </span>
                                    </span>
                                    <?php
                                    ${'this_date'.$i} = date('Y-m-d', strtotime(${'this_date'.$i} . '+ 1 day'));
                                    ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include SITE_ROOT . '/app/include/footer.php' ?>
</div>
</body>
</html>