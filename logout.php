<?php 
session_start();
SESSION_unset();
session_destroy();
header('LOCATION:login.php');
?>