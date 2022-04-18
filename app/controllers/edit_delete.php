<?php
$id = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $table = $_GET['table'];
    if ($table === 'students') {
        $id = 'id_student = ' . $_GET['del_id'];
    } elseif ($table === 'teachers') {
        $id = 'id_teacher = ' . $_GET['del_id'];
    } elseif ($table === 'courses') {
        $id = 'id_course = ' . $_GET['del_id'];
    } elseif ($table === 'groups') {
        $id = 'id_group = ' . $_GET['del_id'];
    } elseif ($table === 'lessons') {
        $id = 'id_lesson = ' . $_GET['del_id'];
    }
    deleteRow($table, $id);
    header('location: ' . 'index.php');
}

if (isset($_GET['id_edit'])) {
    $id = $_GET['id_edit'];
    $table = $_GET['table'];
    if ($table === 'students') {
        $student = selectOne($table, ['id_student' => $id]);
    } elseif ($table === 'teachers') {
        $teacher = selectOne($table, ['id_teacher' => $id]);
    } elseif ($table === 'courses') {
        $course = selectOne($table, ['id_course' => $id]);
    } elseif ($table === 'groups') {
        $group = selectOne($table, ['id_group' => $id]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-update'])) {

    $table = trim($_POST['btn-update']);
    if ($table === 'students') {
        $id = 'id_student = ' . $_GET['id_edit'];
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $last_name = trim($_POST['last_name']);
        $login = trim($_POST['login']);
        $email = trim($_POST['email']);
        $phone = str_replace([' ', '(', ')','-',], '', trim($_POST['phone']));
        if ($name === '' || $surname === '' || $login === '') {
            $error = 'Одно из полей пустое. Обязательно заполните все поля';
        } elseif (iconv_strlen($name) > 30) {
            $error = 'Слишком длинное имя!';
        } elseif (iconv_strlen($surname) > 50) {
            $error = 'Слишком длинная фамилия!';
        } elseif (iconv_strlen($last_name) > 50) {
            $error = 'Слишком длинное отчество!';
        } elseif (iconv_strlen($email) > 50) {
            $error = 'Длина почты может быть до 50 символов!';
        } elseif (iconv_strlen($phone) > 13) {
            $error = 'Длина логина может быть до 13 символов!';
        } elseif (iconv_strlen($login) < 3 || iconv_strlen($login) > 15) {
            $error = 'Длина логина может быть от 3 до 15 символов!';
        } else {
            $post = [
                'name' => $name,
                'surname' => $surname,
                'last_name' => $last_name,
                'login' => $login,
                'mail' => $email,
                'phone' => $phone,
            ];
            updateRow('students', $id, $post);
            header('location: ' . 'index.php');
        }

    }
    if ($table === 'teachers') {
        $id = 'id_teacher = ' . $_GET['id_edit'];
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $last_name = trim($_POST['last_name']);
        $login = trim($_POST['login']);
        $phone = str_replace([' ', '(', ')','-',], '', trim($_POST['phone']));
        if ($name === '' || $surname === '' || $login === '') {
            $error = 'Одно из полей пустое. Обязательно заполните все поля';
        } elseif (iconv_strlen($name) > 30) {
            $error = 'Слишком длинное имя!';
        } elseif (iconv_strlen($surname) > 50) {
            $error = 'Слишком длинная фамилия!';
        } elseif (iconv_strlen($last_name) > 50) {
            $error = 'Слишком длинное отчество!';
        } elseif (iconv_strlen($phone) > 13) {
            $error = 'Длина логина может быть до 13 символов!';
        } elseif (iconv_strlen($login) < 3 || iconv_strlen($login) > 15) {
            $error = 'Длина логина может быть от 3 до 15 символов!';
        } else {
            $post = [
                'name' => $name,
                'surname' => $surname,
                'last_name' => $last_name,
                'login' => $login,
                'phone' => $phone,
            ];
            updateRow('teachers', $id, $post);
            header('location: ' . 'index.php');
        }

    }
    if ($table === 'courses') {
        $id = 'id_course = ' . $_GET['id_edit'];
        $name = trim($_POST['name']);
        $price = trim($_POST['price']);
        if ($name === '' || $price === '') {
            $error = 'Одно из полей пустое. Обязательно заполните все поля';
        } elseif (iconv_strlen($name) > 30) {
            $error = 'Слишком длинное имя!';
        } elseif (iconv_strlen($price) > 3) {
            $error = 'Слишком большая цена';
        } else {
                $post = [
                    'name' => $name,
                    'price' => $price,
                ];
            updateRow('courses', $id, $post);
            header('location: ' . 'index.php');
            }
        }
}

if (isset($_GET['id_student_pay'])) {
    $id = $_GET['id_student_pay'];
    $student = selectOne('students', ['id_student' => $id]);
}
