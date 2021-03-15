<?php
//Writen By: Keelan Brening
//File: user_score.php
//
//Purpose:
//  The purpose of this page is to display the scores of all quiz taken
?>

<html>
    <head>
        <title>Quiz Taker</title>
        <link rel="stylesheet" href="home.css"> 
    </head>
    <body>
        <?php session_start(); ?>
        <?php include('config.php');?>
        <?php include('nav.php');?>
<?php

//This handles the landing page for everyone, User, Admin and Guest.

if(isset($_SESSION['userlogged']) && $_SESSION['userlogged'] == true) {
    //View only the user scores by quiz
    $cid = $_SESSION['cid'];

    if($db->connect_error) {
        exit("Bad Connection");
    } else {
        $select = "SELECT Scores.S_Score, Scores.Quiz_id, Quiz.Quiz_name
                   FROM Scores, Quiz 
                   WHERE C_id = $cid AND Scores.Quiz_id = Quiz.Quiz_id";
        $stmt = $db->prepare($select);
        echo "<h3>Scores for all Quizzes taken</h3><br>";
            
        if($stmt->execute()) {
            $stmt->bind_result($scr, $q_id, $qname);
            echo "<table style='width:60%'>";
            echo "<tr>";
            echo "<th>Quiz ID</th>";
            echo "<th>Quiz Name</th>";
            echo "<th>Quiz Score</th>";
            echo "</tr>";
            while($stmt->fetch()){ 
                echo "<tr>";
                echo "<td>$q_id</td>";
                echo "<td>$qname</td>";
                echo "<td>$scr%</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
         
    }

} else if(isset($_SESSION['adminlogged']) && $_SESSION['adminlogged'] == true) {
    //View all User scored seperated by quiz
    $tid = $_SESSION['tid'];

    if($db->connect_error) {
        exit("Bad Connection");
    } else {
        $select = "SELECT Scores.S_Score, Scores.Quiz_id, Quiz.Quiz_name, Student.C_fname
                   FROM Scores, Quiz, Student
                   WHERE Quiz.T_id = $tid AND Scores.Quiz_id = Quiz.Quiz_id AND 
                         Student.T_id = $tid AND Scores.C_id = Student.C_id
                   ORDER BY Quiz.Quiz_id ASC, Scores.S_Score DESC";
        $stmt = $db->prepare($select);
        echo "<h3>Scores for all Students</h3><br>";
            
        if($stmt->execute()) {
            $stmt->bind_result($scr, $q_id, $qname, $fname);
            echo "<table style='width:60%'>";
            echo "<tr>";
            echo "<th>Quiz ID</th>";
            echo "<th>Student Name</th>";
            echo "<th>Quiz Name</th>";
            echo "<th>Quiz Score</th>";
            echo "</tr>";
            while($stmt->fetch()){ 
                echo "<tr>";
                echo "<td>$q_id</td>";
                echo "<td>$fname</td>";
                echo "<td>$qname</td>";
                echo "<td>$scr%</td>";
                echo "</tr>";
               
            }
            echo "</table>";
        }
         
    }

} else {
}      
?>
    </body>
</html>
