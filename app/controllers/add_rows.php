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
        $time = trim($_POST['id_time_work']);
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
                    'id_time_work' => $time,
                ];
                $id = insertRow($table, $post);
                header('location: ' . 'index.php');
            }
        }
    }
    if ($table === 'courses') {
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
            if ($check_name['name'] === $name) {
                $error = 'Такое название уже существует';
            } else {
                $post = [
                    'name' => $name,
                    'description' => $description,
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
        if ($number === '' || $course === '') {
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
        $teacher = trim($_POST['id_teacher']);
        $date = trim($_POST['date']);
        $timetable = trim($_POST['id_timetable']);
//        $time_start = trim($_POST['time_start']);
//        $time_end = date("H:i", strtotime('+60 minutes', strtotime($time_start)));
//        $time_end = trim($_POST['time_end']);

        $lessons_on_teach = callProc('selectLessonsTeachInWeek',
            $teacher . ', "' .
            date('Y-m-d', strtotime('monday this week', strtotime($date))) . '","' .
            date('Y-m-d', strtotime('saturday this week', strtotime($date))) . '", ' .
            $timetable
        );
        $time = callProc('selectTimeTeacher', $teacher);
        $timeOne = $time['0'];
        $this_lesson_group = selectOne('lessons', [
            'id_group' => $group,
            'date' => $date,
            'id_timetable' => $timetable,
            ]);
        $this_lesson_teacher = selectOne('lessons', [
            'id_teacher' => $teacher,
            'date' => $date,
            'id_timetable' => $timetable,
        ]);
        $this_lesson = selectOne('lessons', [
            'date' => $date,
            'id_timetable' => $timetable,
        ]);
        if (count($lessons_on_teach) >= $timeOne['time']) {
            $error = 'Количество часов в неделю преподавателя превышено';
        } elseif ($group === '' || $timetable === '' || $date == '') {
            $error = 'Одно из полей пустое. Обязательно заполните поля';
        } elseif (!$this_lesson_group == '') {
            $error = 'Урок у этой группы в это время уже есть';
        } elseif (!$this_lesson_teacher == '') {
            $error = 'Урок у этого учителя в это время уже есть';
        } elseif (!$this_lesson == '') {
            $error = 'Урок в это время уже есть';
        }  elseif ($date <= date('Y-m-d')) {
            $error = 'Нельзя назначить урок в предыдущую дату';
        } else {
            $post = [
                'date' => $date,
                'id_timetable' => $timetable,
                'id_group' => $group,
                'id_teacher' => $teacher,
            ];
            $id = insertRow($table, $post);
            header('location: ' . 'index.php');
        }
    }

}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-back'])) {
    header('location: ' . 'index.php');
}