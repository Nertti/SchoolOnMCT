<?php
$id = '';
$preg_phone = "/^\+375(25|29|33|44)[0-9]{7}$/";
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
    } elseif ($table === 'accounting') {
        $id = 'id_accounting = ' . $_GET['del_id'];
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
        $number = $group['number'];

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
        $phone = str_replace([' ', '(', ')', '-',], '', trim($_POST['phone']));
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
        } elseif (!preg_match($preg_phone, $phone) && !$phone == '') {
            $error = 'Введите корректный номер телефона';
        } elseif (iconv_strlen($login) < 3 || iconv_strlen($login) > 15) {
            $error = 'Длина логина может быть от 3 до 15 символов!';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !$email == '') {
            $error = 'Введите корректный адрес электронной почты';
        } else {
            $check_login_student = selectOne('students', ['login' => $login]);
            $check_login_teacher = selectOne('teachers', ['login' => $login]);
            $check_login_admin = selectOne('admins', ['login' => $login]);
            if ($check_login_student['id_student'] !== $_GET['id_edit'] && !$check_login_student == '') {
                $error = 'Такой пользователь уже существует (учащийся)';
            } elseif ($check_login_teacher['id_teacher'] !== $_GET['id_edit'] && !$check_login_teacher == '') {
                $error = 'Такой пользователь уже существует (преподаватель)';
            } elseif ($check_login_admin['id_admin'] !== $_GET['id_edit'] && !$check_login_admin == '') {
                $error = 'Такой пользователь уже существует (админ)';
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

    }
    if ($table === 'teachers') {
        $id = 'id_teacher = ' . $_GET['id_edit'];
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $last_name = trim($_POST['last_name']);
        $login = trim($_POST['login']);
        $time = trim($_POST['id_time_work']);
        $phone = str_replace([' ', '(', ')', '-',], '', trim($_POST['phone']));
        if ($name === '' || $surname === '' || $login === '') {
            $error = 'Одно из полей пустое. Обязательно заполните все поля';
        } elseif (iconv_strlen($name) > 30) {
            $error = 'Слишком длинное имя!';
        } elseif (iconv_strlen($surname) > 50) {
            $error = 'Слишком длинная фамилия!';
        } elseif (iconv_strlen($last_name) > 50) {
            $error = 'Слишком длинное отчество!';
        } elseif (!preg_match($preg_phone, $phone) && !$phone == '') {
            $error = 'Введите корректный номер телефона';
        } elseif (iconv_strlen($login) < 3 || iconv_strlen($login) > 15) {
            $error = 'Длина логина может быть от 3 до 15 символов!';
        } else {
            $check_login_student = selectOne('students', ['login' => $login]);
            $check_login_teacher = selectOne('teachers', ['login' => $login]);
            $check_login_admin = selectOne('admins', ['login' => $login]);
            if ($check_login_student['id_student'] !== $_GET['id_edit'] && !$check_login_student == '') {
                $error = 'Такой пользователь уже существует (учащийся)';
            } elseif ($check_login_teacher['id_teacher'] !== $_GET['id_edit'] && !$check_login_teacher == '') {
                $error = 'Такой пользователь уже существует (преподаватель)';
            } elseif ($check_login_admin['id_admin'] !== $_GET['id_edit'] && !$check_login_admin == '') {
                $error = 'Такой пользователь уже существует (админ)';
            } else {
                $post = [
                    'name' => $name,
                    'surname' => $surname,
                    'last_name' => $last_name,
                    'login' => $login,
                    'phone' => $phone,
                    'id_time_work' => $time,

                ];
                updateRow('teachers', $id, $post);
                header('location: ' . 'index.php');
            }
        }
    }
    if ($table === 'courses') {
        $id = 'id_course = ' . $_GET['id_edit'];
        $name = trim($_POST['name']);
        $price = trim($_POST['price']);
        $description = trim($_POST['description']);
        if ($name === '' || $price === '') {
            $error = 'Одно из полей пустое. Обязательно заполните все поля';
        } elseif (iconv_strlen($name) > 30) {
            $error = 'Слишком длинное имя!';
        } elseif (iconv_strlen($description) > 300) {
            $error = 'Слишком длинное описание!';
        } elseif (iconv_strlen($price) > 3) {
            $error = 'Слишком большая цена';
        } else {
            $check_name = selectOne($table, ['name' => $name]);
            if ($check_name['id_course'] !== $_GET['id_edit']) {
                $error = 'Такое название уже существует';
            } else {
                $post = [
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                ];
                updateRow('courses', $id, $post);
                header('location: ' . 'index.php');
            }
        }
    }
    if ($table === 'groups') {
        $id = 'id_group = ' . $_GET['id_edit'];
        $number = trim($_POST['number']);
//        $course = trim($_POST['id_course']);
        if ($number === '') {
            $error = 'Одно из полей пустое. Обязательно заполните поля';
        } elseif (iconv_strlen($number) > 5) {
            $error = 'Слишком длинный номер группы!';
        } else {
            $post = [
                'number' => $number,
            ];
            updateRow('groups', $id, $post);
            header('location: ' . 'index.php');
        }
    }

}
//
if (isset($_GET['id_student_pay'])) {
    $id = $_GET['id_student_pay'];
    $student = selectOne('students', ['id_student' => $id]);
}
//delete stud
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id_accounting'])) {
    $id = 'id_accounting = ' . $_GET['del_id_accounting'];
    deleteRow('accounting', $id);
    header('Location: editStudentInGroup.php?&id_group=' . $_GET['id_group']);
}
//add stud
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['add_id_student'])) {
    $group = selectOne('groups', ['id_group' => $_GET['id_group']]);
    if ($group['count_students'] >= 10) {
        $error = 'Лимит учащихся группы 10';
    } else {
        $post = [
            'id_student' => $_GET['add_id_student'],
            'id_group' => $_GET['id_group'],
        ];
        $id = insertRow('accounting', $post);
        header('Location: editStudentInGroup.php?&id_group=' . $_GET['id_group']);
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['note_student'])) {
    $today = date('Y-m-d');
    $post = [
        'id_student' => $_GET['note_student'],
        'id_lesson' => $_GET['id_lesson'],
        'date' => $today,
    ];
    $id = insertRow('visit', $post);
    header('Location: note.php?id_lesson= ' . $_GET['id_lesson'] . '&id_group=' . $_GET['id_group']);
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['note_student_del'])) {
    $visit = selectOne('visit', ['id_lesson' => $_GET['id_lesson'], 'id_student' => $_GET['note_student_del']]);
    $id = 'id_visit = ' . $visit['id_visit'];

    deleteRow('visit', $id);
    header('Location: note.php?id_lesson= ' . $_GET['id_lesson'] . '&id_group=' . $_GET['id_group']);
}