<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_group'])) {
    $group = $_GET['id_group'];

    $stud_in_group = callProc('selectStudInG',$group);
    $teach_in_group = callProc('selectTeacherGroup',$group);


}
