<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-add'])) {
    $table = trim($_POST['btn-add']);
    if ($table === 'students') {
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $last_name = trim($_POST['last_name']);
        $login = trim($_POST['login']);
        $pass = trim($_POST['pass']);
        if ($name === '' || $surname === '' || $login === '' || $pass === '') {
            $error = 'Одно из полей пустое. Обязательно заполните все поля со звёздочкой';
        } else {
            $check_login = selectOne($table, ['login' => $login]);
            if ($check_login['login'] === $login) {
                $error = 'Такой пользователь уже существует';
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
        $phone = trim($_POST['phone']);
        if ($name === '' || $surname === '' || $login === '' || $pass === '') {
            $error = 'Одно из полей пустое. Обязательно заполните все поля со звёздочкой';
        } else {
            $check_login = selectOne($table, ['login' => $login]);
            if ($check_login['login'] === $login) {
                $error = 'Такой пользователь уже существует';
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
        }elseif (iconv_strlen($summary) > 3){
            $error = 'Слишком большая сумма';
        } elseif (iconv_strlen($number) > 15){
            $error = 'Слишком длинный номер документа';
        } else {
            $check_number = selectOne('pay', ['number_doc' => $number]);
            if ($check_number['number_doc'] === $number) {
                $error = 'Такой номер уже существует';
//                tt($_GET);
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

}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-back'])) {
    header('location: ' . 'index.php');
}