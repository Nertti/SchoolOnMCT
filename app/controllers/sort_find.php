<?php
$time_work = selectALL('time_work');
$students = selectALL('students');
$teachers = selectALL('teachers');
$admins = selectALL('admins');
$courses = selectALL('courses');
$groups = selectALL('groups');
//$lessons = selectALL('selectlessons');
$lessons = selectOrder('selectlessons', 'date, name_l');
$lessonsVisits = selectOrder('selectlessons', 'date, name_l', [date("Y-m-d") => 'date']);
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
$day_of_week = [
    'Понедельник',
    'Вторник',
    'Среда',
    'Четверг',
    'Пятница',
    'Суббота',
];

$period = new DatePeriod(
    new DateTime(date('Y-m-d', strtotime('monday this week'))),
    new DateInterval('P1D'),
    (new DateTime(date('Y-m-d', strtotime('saturday this week'))))->modify('+1 day') // +1 day нужен так как конец не входит в интервал
);
$week = [];
foreach( $period as $date) {
    $week[] = $date->format('d.m');
}
$next_period = new DatePeriod(
    new DateTime(date('Y-m-d', strtotime('monday next week'))),
    new DateInterval('P1D'),
    (new DateTime(date('Y-m-d', strtotime('saturday next week'))))->modify('+1 day') // +1 day нужен так как конец не входит в интервал
);
$next_week = [];
foreach( $next_period as $date) {
    $next_week[] = $date->format('d.m');
}
for ($i = 1; $i <= 6; $i++){
   ${'lessons'.$i} = selectOrder('selectlessons', 'date', [
       $i  => 'name_l',
       date('Y-m-d', strtotime('monday this week')) => 'date',
       date('Y-m-d', strtotime('saturday this week')) => 'date'
   ]);
    ${'lessons'.$i.'_next'} = selectOrder('selectlessons', 'date', [
        $i => 'name_l',
        date('Y-m-d', strtotime('monday next week')) => 'date',
        date('Y-m-d', strtotime('saturday next week')) => 'date'
    ]);
}
if (isset($_POST['find_timetable_group']) && isset($_POST['id_group'])) {
    $week_time = $_POST['find_timetable'];
    $group = $_POST['id_group'];

    for ($i = 1; $i <= 6; $i++){
        ${'lessons'.$i} = callProc('selectLessonsGroupInWeek', $group . ', "' .
            date('Y-m-d', strtotime('monday this week')) . '", "' .
            date('Y-m-d', strtotime('saturday this week')) . '", ' . $i
        );
    }
    for ($i = 1; $i <= 6; $i++){
        ${'lessons'.$i.'_next'} = callProc('selectLessonsGroupInWeek', $group . ', "' .
            date('Y-m-d', strtotime('monday next week')) . '", "' .
            date('Y-m-d', strtotime('saturday next week')) . '", ' . $i
        );
    }
}

if (isset($_POST['find_timetable_teacher']) && isset($_POST['id_teacher'])) {
    $week_time = $_POST['find_timetable'];
    $teacher = $_POST['id_teacher'];

    for ($i = 1; $i <= 6; $i++){
        ${'lessons'.$i} = callProc('selectLessonsTeachInWeek', $teacher . ', "' .
            date('Y-m-d', strtotime('monday this week')) . '", "' .
            date('Y-m-d', strtotime('saturday this week')) . '", ' . $i
        );
    }
    for ($i = 1; $i <= 6; $i++){
        ${'lessons'.$i.'_next'} = callProc('selectLessonsTeachInWeek', $teacher . ', "' .
            date('Y-m-d', strtotime('monday next week')) . '", "' .
            date('Y-m-d', strtotime('saturday next week')) . '", ' . $i
        );
    }
}

if (isset($_GET['timetable_teacher']) && isset($_SESSION['id_teacher'])) {
    $teacher = $_SESSION['id_teacher'];

    for ($i = 1; $i <= 6; $i++){
        ${'lessons'.$i} = callProc('selectLessonsTeachInWeek', $teacher . ', "' .
            date('Y-m-d', strtotime('monday this week')) . '", "' .
            date('Y-m-d', strtotime('saturday this week')) . '", ' . $i
        );
    }
    for ($i = 1; $i <= 6; $i++){
        ${'lessons'.$i.'_next'} = callProc('selectLessonsTeachInWeek', $teacher . ', "' .
            date('Y-m-d', strtotime('monday next week')) . '", "' .
            date('Y-m-d', strtotime('saturday next week')) . '", ' . $i
        );
    }
}

