<?php
require('../app/db/db.php');

$response = [];
function userAuth($user)
{
    $_SESSION['name'] = $user['name'];
    $_SESSION['surname'] = $user['surname'];
    $_SESSION['last_name'] = $user['last_name'];
    $_SESSION['login'] = $user['login'];
    $_SESSION['pass'] = $user['password'];
    if (isset($user['id_admin'])) {
        $_SESSION['id_admin'] = $user['id_admin'];
        $response = [
            "status" => true,
            "user" => 'admin',
        ];
    } else if (isset($user['id_student'])) {
        $_SESSION['id_student'] = $user['id_student'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['mail'] = $user['mail'];
        $_SESSION['balance'] = $user['balance'];
        $response = [
            "status" => true,
            "user" => 'student',
        ];
    } else if (isset($user['id_teacher'])) {
        $_SESSION['id_teacher'] = $user['id_teacher'];
        $response = [
            "status" => true,
            "user" => 'teacher',
        ];
    }
    echo json_encode($response);
    die();
}

$login = trim($_POST['login']);
$pass = trim($_POST['password']);
if ($login === '' || $pass === '') {
    $response = [
        "status" => false,
        "message" => "Одно из полей незаполнено!",
    ];
    echo json_encode($response);
    die();
} else {
    $students = selectOne('students', ['login' => $login]);
    $teachers = selectOne('teachers', ['login' => $login]);
    $admins = selectOne('admins', ['login' => $login]);
    if ($students && password_verify($pass, $students['password'])) {
        userAuth($students);
    } else if ($teachers && password_verify($pass, $teachers['password'])) {
        userAuth($teachers);
    } else if ($admins && password_verify($pass, $admins['password'])) {
        userAuth($admins);
    } else {
        $response = [
            "status" => false,
            "message" => "Неверный логин или пароль!",
        ];
        echo json_encode($response);
        die();
    }
}
