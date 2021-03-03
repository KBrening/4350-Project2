<?php
//Writen by: Keelan Breing
//File: logout.phph
//
//Purpose:
//  Destroy the $_SESSION which will log them out of the website


session_start();
session_destroy();
header("Location: home.php");
exit;
?>
