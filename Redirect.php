<?php
if (isset($_SESSION['id_admin'])) {
    header('location: ' . 'admin/admin.php');
    echo 'cdcas';
} else if (isset($_SESSION['id_student'])) {
    header('location: ' . 'user/user.php');
    echo 'qqqqqqqqqqqqq';

} else if ($_SESSION($user['id_teacher'])) {
    header('location: ' . 'index.php');
    echo 'ccccccccc';

}