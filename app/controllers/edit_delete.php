<?php
$id = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $table = $_GET['table'];
    if($table === 'students'){
        $id = 'id_student = ' . $_GET['del_id'];
    }elseif ($table === 'teachers'){
        $id = 'id_teacher = ' . $_GET['del_id'];
    }elseif ($table === 'courses'){
        $id = 'id_course = ' . $_GET['del_id'];
    }elseif ($table === 'groups'){
        $id = 'id_group = ' . $_GET['del_id'];
    }elseif ($table === 'lessons'){
        $id = 'id_lesson = ' . $_GET['del_id'];
    }
    deleteRow($table, $id);
    header('location: ' . 'index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_edit'])) {
    $id = $_GET['id_edit'];
    $table = $_GET['table'];
    if($table === 'students'){
        $student = selectOne($table, ['id_student' => $id]);
    }elseif ($table === 'teachers'){
        $teacher = selectOne($table, ['id_teacher' => $id]);
    }elseif ($table === 'courses'){
        $course = selectOne($table, ['id_course' => $id]);
    }elseif ($table === 'groups'){
        $group = selectOne($table, ['id_group' => $id]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-update'])) {
    $id = 'id_student = ' . $_GET['id_edit'];
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $last_name = trim($_POST['last_name']);
    if ($name === '' || $surname === '' || $last_name === '') {
        $error = 'Не все поля заполнены';
    } elseif (strlen($name) < 2 || strlen($name) > 49) {
        $error = 'Длина имени должна быть больше 1 и меньше 50';
    } elseif (strlen($surname) < 2 || strlen($surname) > 49) {
        $error = 'Длина фамилии должна быть больше 1 и меньше 50';
    } else {
        $post = [
            'name' => $name,
            'surname' => $surname,
            'last_name' => $last_name,
        ];
        updateRow('students', $id, $post);
        header('location: ' . 'index.php');
    }
}

if (isset($_GET['id_student_pay'])) {
    $id = $_GET['id_student_pay'];
    $student = selectOne('students', ['id_student' => $id]);
}
