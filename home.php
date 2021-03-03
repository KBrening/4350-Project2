<?php
//Writen By: Keelan Brening
//File: home.php
//
//Purpose:
//  The purpose of this page is to be the landing page of the website. It is also going to
//      handle all the redirection in the website back to home.php. Since this site is using
//      $_SESSION, every website will look different for each user since they each can only
//      view certain sites.
?>

<html>
    <head>
        <title>Quiz Taker</title>
        <link rel="stylesheet" href="home.css"> 
    </head>
    <body>
        <?php session_start(); ?>
        <?php include('nav.php');?>
<?php

//This handles the landing page for everyone, User, Admin and Guest.

if(isset($_SESSION['userlogged']) && $_SESSION['userlogged'] == true) {
    $user = $_SESSION['fname'];
    echo "<br><br><h1> Welcome $user to Quiz-Taker</h1><br><br>";
    echo "<h4>Please navigate to take your quiz</h4>";
} else if(isset($_SESSION['adminlogged']) && $_SESSION['adminlogged'] == true) {
    $user = $_SESSION['fname'];
    echo "<h1>Welcome $user to Quiz-Taker</h1>";
} else {
    echo "<h1>Welcome Guest to Quiz Taker</h2><br><br>";
    echo "<h4>Please Sign in to view the site</h4>";
}      
?>
    </body>
</html>
