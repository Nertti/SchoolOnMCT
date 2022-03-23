<?php include SITE_ROOT . '/app/controllers/control.php';?>
<header>
    <div class="nav lock-padding">
        <div class="container">
            <div class="nav__head">
                <div class="logo">
                    <div onclick="location.href='<?php echo BASE_URL ?>index.php'" class="nav__logo">
                        Инженерная школа
                    </div>
                </div>
                <div class="nav__burger">
                    <span></span>
                </div>
                <div class="nav__menu">
                    <ul class="nav__list">
                        <li><a href="<?php echo BASE_URL ?>index.php">Главная</a></li>
                        <li><a href="<?php echo BASE_URL ?>about.php">О нас</a></li>
                        <li><a href="<?php echo BASE_URL ?>courses.php">Курсы</a></li>
                        <li><a href="<?php echo BASE_URL ?>contact.php">Контакты</a></li>
                        <li>
                            <?php if (isset($_SESSION['id_admin'])): ?>
                                <a href="<?php echo BASE_URL ?>admin/admin.php">Администратор</a>
                            <?php elseif (isset($_SESSION['id_student'])): ?>
                                <a href="<?php echo BASE_URL ?>user/user.php">Личный кабинет</a>
                            <?php elseif (isset($_SESSION['id_teacher'])): ?>
                                <a href="<?php echo BASE_URL ?>teacher/teacher.php">Личный кабинет</a>
                            <?php else: ?>
                                <a class="popup-link" href="#popup_log">Войти</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="popup_log" class="popup">
    <div class="popup_body">
        <div class="popup_content" style="background-image: url('img/back_log.webp')">
            <span class="error_msg"><?=$error?></span>
            <a href="#" class="popup_close"></a>
            <div class="log">
                <div class="block">
                    <div class="form">
                        <form method="post" action="">
                            <label>
                                Логин:
                                <input value="<?= $login ?>" type="text" name="login">
                            </label>
                            <br>
                            <label>
                                Пароль:
                                <input type="password" name="pass">
                            </label>
                            <button type="submit" class="button" name="btn-sign" >
                                Войти
<!--                                onclick="drawShelves(); return false;-->
                            </button>
                            <div class="register">
                                <a class="popup-link" href="#popup_reg">Зарегистрироваться</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup_reg" class="popup">
    <div class="popup_body">
        <div class="popup_content" style="background-image: url('img/back_log.webp')">
            <a href="#" class="popup_close"></a>
            <div class="log">
                <div class="block">
                    <div class="title_form">Регистрация</div>
                    <div class="form">
                        <form method="post" action="">
                            <label>
                                Имя:
                                <input value="<?= $name ?>" type="text" name="name">
                            </label>
                            <label>
                                Фамилия:
                                <input value="<?= $surname ?>" type="text" name="surname">
                            </label>
                            <label>
                                Отчество:
                                <input value="<?= $last_name ?>" type="text" name="last_name">
                            </label>
                            <label>
                                Логин:
                                <input value="<?= $login ?>" type="text" name="login">
                            </label>
                            <label>
                                Пароль:
                                <input type="password" name="pass">
                            </label>
                            <br>
                            <label>
                                Повторите пароль:
                                <input type="password" name="check_pass">
                            </label>
                            <button name="btn-registry" type="submit" class="button">
                                подтвердить
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>