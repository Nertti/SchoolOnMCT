<?php
if (!$_SESSION["id_teacher"]){
    header('location: '. SITE_ROOT . 'index.php');
}