<?php
//Writen By: Keelan Brening
//File: take_quiz.php
//
//Purpose:
//  The purpose of this page is to List all created Quizzes on the database and allow the user to select the
//      one they want to take.
?>

<html>
    <head>
        <title>Take Quiz - Quiz Taker</title>
        <link rel="stylesheet" href="home.css"> 
    </head>
    <body>
        <?php session_start(); ?>
        <?php include('config.php');?>
        <?php include('nav.php');?>
<?php

//This handles the landing page for everyone, User, Admin and Guest.

if(isset($_SESSION['userlogged']) && $_SESSION['userlogged'] == true) {

    if(isset($_POST['quiz']) && !empty($_POST['quiz'])) {

    } else {
        
        echo "<br><br><h1>Quizzes Available</h1><br><br>";

        if($db->connect_error) {
            exit("Bad Connection");
        } else {
            $select = "SELECT Quiz_id, T_id, Quiz_name, Quiz_date FROM Quiz";
            $stmt = $db->prepare($select);

            if($stmt->execute()) {
                $stmt->bind_result($q_id, $t_id, $q_name, $q_date);
                echo "<form action='take_quiz.php' method='post'>";
                while($stmt->fetch()){
                    if($t_id == $_SESSION['tid']) {
                        echo "<input type='radio' name='quiz' value='{$q_id}'>";
                        echo "<label>&nbsp;$q_name &nbsp&nbsp Date Create: $q_date </label><br>";
                    }   
                }
                echo "<input type='submit' value='submit'>";
                echo "</form>";
            }
        }
    }

} else if(isset($_SESSION['adminlogged']) && $_SESSION['adminlogged'] == true) {
    header("Location: home.php");
} else {
    header("Location: home.php");
}      
?>
    </body>
</html>
