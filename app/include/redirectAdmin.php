<?php
if (!$_SESSION["id_admin"]){
    header('location: '. BASE_URL . 'index.php');
}