<?php
$time_work = selectALL('time_work');
$students = selectALL('students');
$teachers = selectALL('teachers');
$admins = selectALL('admins');
$courses = selectALL('courses');
$groups = selectALL('groups');
//$lessons = selectALL('selectlessons');
$lessons = selectOrder('selectlessons', 'date, name_l');
$timetables = selectALL('timetable');
//$lessons = selectOrder('selectlessons', 'date, time_start');
//$lessons = selectOrder('selectlessons', 'date, time_start', ['date' => date("Y-m-d"),]);
//$lessons = selectOrder('selectlessons', 'date, time_start', [date('Y-m-d', strtotime('monday this week')) => 'date', date('Y-m-d', strtotime('saturday this week')) => 'date']);

$lessonsDEL = selectALL('lessons');
$sort_list = [
    'id_asc' => 'id_student',
    'id_desc' => 'id_student DESC',
    'surname_asc' => 'surname',
    'surname_desc' => 'surname DESC',
    'balance_asc' => 'balance',
    'balance_desc' => 'balance DESC',
    'name_asc' => 'name',
    'name_desc' => 'name DESC',
    'price_asc' => 'price',
    'price_desc' => 'price DESC',
    'number_asc' => 'number',
    'number_desc' => 'number DESC',
    'count_asc' => 'count',
    'count_desc' => 'count DESC',
    'count_students_asc' => 'count_students',
    'count_students_desc' => 'count_students DESC',
];

$sort = @$_GET['sort'];
$table = @$_GET['table'];
if (array_key_exists($sort, $sort_list)) {
    $sort_sql = $sort_list[$sort];
} else {
    $sort_sql = reset($sort_list);
}
if (isset($_GET['sort'])) {
    if ($table === 'students') {
        $students = selectOrder('students', $sort_sql);
    } elseif ($table === 'teachers') {
        $teachers = selectOrder('teachers', $sort_sql);
    } elseif ($table === 'courses') {
        $courses = selectOrder('courses', $sort_sql);
    } elseif ($table === 'groups') {
        $groups = selectOrder('groups', $sort_sql);
    }
}

if (isset($_POST['find'])) {
    $table = $_POST['find'];
    $find_sql = $_POST['search'];
    if ($table === 'students') {
        $students = selectFind($table, $find_sql, 'surname');
    } elseif ($table === 'courses') {
        $courses = selectFind($table, $find_sql, 'name');
    } elseif ($table === 'teachers') {
        $teachers = selectFind($table, $find_sql, 'surname');
    } elseif ($table === 'groups') {
        $groups = selectFind($table, $find_sql, 'number');
    }
}
if (isset($_POST['reset'])) {
    $table = $_POST['reset'];
    $students = selectALL($table);
    $courses = selectALL($table);
    $teachers = selectALL($table);
    $groups = selectALL($table);
    $find_sql = '';
}
