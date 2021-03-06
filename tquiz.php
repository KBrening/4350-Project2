<?php
//Writen By: Keelan Brening
//File: tquiz.php
//
//Purpose:
//  The purpose of this page is to display how many quizzes are created and the names of them.
//      Then this page will give them the option to create a quiz which will redirect them to 
//      another page to create a quiz.
?>

<html>
    <head>
        <title>Quiz - Quiz Taker</title>
        <link rel="stylesheet" href="home.css"> 
    </head>
    <body>
        <?php session_start(); ?>
        <?php include('nav.php');?>
        <?php include('config.php');?>
<?php

//This handles the landing page for everyone, User, Admin and Guest.

if(isset($_SESSION['userlogged']) && $_SESSION['userlogged'] == true) {
    header("Location: home.php");
} else if(isset($_SESSION['adminlogged']) && $_SESSION['adminlogged'] == true) {
    if($db->connect_error) {
        exit("Bad Connection");
    } else {
        $quizzes = "SELECT Quiz_id, Quiz_name, Quiz_date FROM Quiz";
        $stmt = $db->prepare($quizzes);

        if($stmt->execute()) {
            $stmt->bind_result($id, $name, $date);
            echo "<br><h3><b>Quizzes Created</b></h3><br>";
            while($stmt->fetch()){
                echo"<h4>Quiz $id: $name $date</h4><br>";
            }
        }
    }
?>
    <p>-------------------------------------------------------------------------</p>
    <form action='create_quiz.php' method='post'>
        <h4>To create a quiz please press the button below</h4><br>
        <input type='submit' value='Create Quiz'><br>
    </form>

<?php

} else {
    header("Location: home.php");
}      
?>
    </body>
</html>
