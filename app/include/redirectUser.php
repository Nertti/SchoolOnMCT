<?php
if (!$_SESSION["id_student"]){
    header('location: '. SITE_ROOT . 'index.php');
}