<?php
session_start();
$_SESSION = array();
header('location: ' . ' index_this.php');
