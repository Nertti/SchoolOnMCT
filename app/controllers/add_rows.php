<?php
$preg_phone = "/^\+375(25|29|33|44)[0-9]{7}$/";
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-add'])) {
    $table = trim($_POST['btn-add']);
    if ($table === 'students') {
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $last_name = trim($_POST['last_name']);
        $login = trim($_POST['login']);
        $pass = trim($_POST['pass']);
        if ($name === '' || $surname === '' || $login === '' || $pass === '') {
            $error = 'Одно из полей пустое. Обязательно заполните все поля';
        } elseif (iconv_strlen($name) > 30) {
            $error = 'Слишком длинное имя!';
        } elseif (iconv_strlen($surname) > 50) {
            $error = 'Слишком длинная фамилия!';
        } elseif (iconv_strlen($last_name) > 50) {
            $error = 'Слишком длинное отчество!';
        } elseif (iconv_strlen($login) < 3 || iconv_strlen($login) > 15) {
            $error = 'Длина логина может быть от 3 до 15 символов!';
        } elseif (iconv_strlen($pass) < 6 || iconv_strlen($pass) > 20) {
            $error = 'Длина пароля должна быть от 6 до 20 символов!';
        } else {
            $check_login_student = selectOne('students', ['login' => $login]);
            $check_login_teacher = selectOne('teachers', ['login' => $login]);
            $check_login_admin = selectOne('admins', ['login' => $login]);
            if (!$check_login_student == '') {
                $error = 'Такой пользователь уже существует (учащийся)';
            } elseif (!$check_login_teacher == '') {
                $error = 'Такой пользователь уже существует (преподаватель)';
            } elseif (!$check_login_admin == '') {
                $error = 'Такой пользователь уже существует (админ)';
            } else {
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $post = [
                    'name' => $name,
                    'surname' => $surname,
                    'last_name' => $last_name,
                    'login' => $login,
                    'password' => $pass,
                ];
                $id = insertRow($table, $post);
                header('location: ' . 'index.php');
            }
        }
    }
    if ($table === 'teachers') {
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $last_name = trim($_POST['last_name']);
        $login = trim($_POST['login']);
        $pass = trim($_POST['pass']);
        $phone = str_replace([' ', '(', ')', '-',], '', trim($_POST['phone']));
        if ($name === '' || $surname === '' || $login === '' || $pass === '') {
            $error = 'Одно из полей пустое. Обязательно заполните все поля со звёздочкой';
        } elseif (iconv_strlen($name) > 30) {
            $error = 'Слишком длинное имя!';
        } elseif (iconv_strlen($surname) > 50) {
            $error = 'Слишком длинная фамилия!';
        } elseif (iconv_strlen($last_name) > 50) {
            $error = 'Слишком длинное отчество!';
        } elseif (iconv_strlen($login) < 3 || iconv_strlen($login) > 15) {
            $error = 'Длина логина может быть от 3 до 15 символов!';
        } elseif (iconv_strlen($pass) < 6 || iconv_strlen($pass) > 20) {
            $error = 'Длина пароля должна быть от 6 до 20 символов!';
        } elseif (!preg_match($preg_phone, $phone) && !$phone == '') {
            $error = 'Введите верный телефон';
        } else {
            $check_login_student = selectOne('students', ['login' => $login]);
            $check_login_teacher = selectOne('teachers', ['login' => $login]);
            $check_login_admin = selectOne('admins', ['login' => $login]);
            if (!$check_login_student == '') {
                $error = 'Такой пользователь уже существует (учащийся)';
            } elseif (!$check_login_teacher == '') {
                $error = 'Такой пользователь уже существует (преподаватель)';
            } elseif (!$check_login_admin == '') {
                $error = 'Такой пользователь уже существует (админ)';
            } else {
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $post = [
                    'name' => $name,
                    'surname' => $surname,
                    'last_name' => $last_name,
                    'login' => $login,
                    'password' => $pass,
                    'phone' => $phone,
                ];
                $id = insertRow($table, $post);
                header('location: ' . 'index.php');
            }
        }
    }
    if ($table === 'courses') {
        $name = trim($_POST['name']);
        $price = trim($_POST['price']);
        if ($name === '' || $price === '') {
            $error = 'Одно из полей пустое. Обязательно заполните все поля';
        } elseif (iconv_strlen($name) > 30) {
            $error = 'Слишком длинное имя!';
        } elseif (iconv_strlen($price) > 3) {
            $error = 'Слишком большая цена';
        } else {
            $check_name = selectOne($table, ['name' => $name]);
            if ($check_name['name'] === $name) {
                $error = 'Такое название уже существует';
            } else {
                $post = [
                    'name' => $name,
                    'price' => $price,
                ];
                $id = insertRow($table, $post);
                header('location: ' . 'index.php');
            }
        }
    }
    if ($table === 'groups') {
        $number = trim($_POST['number']);
        $course = trim($_POST['id_course']);
        $teacher = trim($_POST['id_teacher']);
        if ($number === '' || $course === '' || $teacher === '') {
            $error = 'Одно из полей пустое. Обязательно заполните поля';
        } elseif (iconv_strlen($number) > 5) {
            $error = 'Слишком длинный номер группы!';
        } else {
            $check_number = selectOne($table, ['number' => $number]);
            if ($check_number['number'] === $number) {
                $error = 'Такая группа уже существует';
            } else {
                $post = [
                    'number' => $number,
                    'id_course' => $course,
                    'id_teacher' => $teacher,
                ];
                $id = insertRow($table, $post);
                header('location: ' . 'index.php');
            }
        }
    }
    if ($table === 'pay') {
        $number = trim($_POST['number']);
        $summary = trim($_POST['summary']);
        $today = date("Y-n-j");
        if ($number === '' || $summary === '') {
            $error = 'Одно из полей пустое. Обязательно заполните поля';
        } elseif (iconv_strlen($summary) > 3) {
            $error = 'Слишком большая сумма';
        } elseif (iconv_strlen($number) > 15) {
            $error = 'Слишком длинный номер документа';
        } else {
            $check_number = selectOne('pay', ['number_doc' => $number]);
            if ($check_number['number_doc'] === $number) {
                $error = 'Такой документ уже существует';
            } else {
                $post = [
                    'id_student' => $_GET['id_student_pay'],
                    'number_doc' => $number,
                    'summary' => $summary,
                    'date' => $today,
                ];
                $id = insertRow($table, $post);
                header('location: ' . 'index.php');
            }
        }
    }
    if ($table === 'accounting') {
        $group = trim($_POST['id_group']);
        if ($group === '') {
            $error = 'Одно из полей пустое. Обязательно заполните поля';
        } else {
            $post = [
                'id_student' => $_GET['id_student'],
                'id_group' => $group,
            ];
            $id = insertRow($table, $post);
            header('location: ' . 'index.php');
        }
    }
    if ($table === 'lessons') {
        $group = trim($_POST['id_group']);
        $date = trim($_POST['date']);
        $time_start = trim($_POST['time_start']);
        $time_end = trim($_POST['time_end']);
        if ($group === '' || $time_start === '' || $date == '') {
            $error = 'Одно из полей пустое. Обязательно заполните поля';
        } else {
            $post = [
                'date' => $date,
                'time_start' => $time_start,
                'time_end' => $time_end,
                'id_group' => $group,
            ];
            $id = insertRow($table, $post);
            header('location: ' . 'index.php');
        }
    }

}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-back'])) {
    header('location: ' . 'index.php');
}