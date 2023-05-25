<?php
require_once 'connection.php';

session_unset();
session_destroy();
include 'login.php';
//include 'home.php';
exit();
?>