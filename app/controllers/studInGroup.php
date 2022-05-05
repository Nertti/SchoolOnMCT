<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_group'])) {
    $group = selectOne('groups', ['id_group' => $_GET['id_group']]);
    $course = selectOne('courses', ['id_course' => $group['id_course']]);
    $stud_in_group = callProc('selectStudInG',$_GET['id_group']);
    $stud_in_not_group = callProc('selectStudInNotG',$_GET['id_group']);
}

