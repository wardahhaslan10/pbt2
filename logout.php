<?php
/*
Course Code : DFP50193 Web Programming
Assessment  : Problem Based Task 2
Name        : WARDAH BINTI HASLAN
Matrik      : 18DDT23F1099
*/

session_start();
$_SESSION = [];
session_destroy();
header("Location: index.php");
exit();
?>