<?php
//регистрация пользователя в какую либо из таблиц(учащиеся)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-registry'])) {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $last_name = trim($_POST['last_name']);
    $login = trim($_POST['login']);
    $pass = trim($_POST['pass']);
    $check_pass = trim($_POST['check_pass']);
    if ($name === '' || $surname === '' || $pass === '') {
        $error = 'Одно из полей пустое';
    } else {
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $post = [
            'name' => $name,
            'surname' => $surname,
            'last_name' => $last_name,
            'login' => $login,
            'password' => $pass,
        ];
        $id = insertRow('students', $post);
        header('location: ' . 'index.php');
    }
}
//авторизация созданного пользователя
function userAuth($user)
{
    $_SESSION['name'] = $user['name'];
    $_SESSION['surname'] = $user['surname'];
    $_SESSION['last_name'] = $user['last_name'];
    $_SESSION['login'] = $user['login'];
    $_SESSION['pass'] = $user['password'];
    if (isset($user['id_admin'])) {
        $_SESSION['id_admin'] = $user['id_admin'];

        header('location: ' . 'admin/admin.php');

    } else if (isset($user['id_student'])) {
        $_SESSION['id_student'] = $user['id_student'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['mail'] = $user['mail'];
        $_SESSION['balance'] = $user['balance'];

        header('location: ' . 'user/user.php');

    } else if (isset($user['id_teacher'])) {
        $_SESSION['id_teacher'] = $user['id_teacher'];

        header('location: ' . 'teacher/teacher.php');

    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-sign'])) {
    $login = trim($_POST['login']);
    $pass = trim($_POST['pass']);
    if ($login === '' || $pass === '') {
        $error = 'Одно из полей незаполнено!';
    } else {
        $students = selectOne('students', ['login' => $login]);
        $teachers = selectOne('teachers', ['login' => $login]);
        $admins = selectOne('admins', ['login' => $login]);
        if ($students && password_verify($pass, $students['password'])) {
            echo 'good';
            userAuth($students);
        } else if ($teachers && password_verify($pass, $teachers['password'])) {
            echo 'good';
            userAuth($teachers);
        } else if ($admins && password_verify($pass, $admins['password'])) {
            echo 'good';
            userAuth($admins);
        } else {
            $error = 'Неверный логин или пароль';
        }
    }
}
