<?php
/*
Course Code : DFP50193 Web Programming
Assessment  : Problem Based Task 2
Name        : Wardah binti haslan 
Matrik      : 18ddt23f1099
*/

session_start();
$_SESSION = [];
session_destroy();
header("Location: index.php");
exit();
?>