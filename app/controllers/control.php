<?php
$error = '';
$name = '';
$surname = '';
$last_name = '';
$login = '';
$phone = '';
$number = '';
$find_sql = '';
$check_login = '';
$description = '';
$date = '';

include SITE_ROOT . '/app/db/db.php';
include SITE_ROOT . '/app/controllers/registry.php';
include SITE_ROOT . '/app/controllers/sort_find.php';
include SITE_ROOT . '/app/controllers/add_rows.php';
include SITE_ROOT . '/app/controllers/edit_delete.php';
include SITE_ROOT . '/app/controllers/studInGroup.php';
include SITE_ROOT . '/app/PHPExcel/PHPExcel.php';
include SITE_ROOT . '/app/controllers/PHPExcel_control.php';
