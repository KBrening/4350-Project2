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
    if(isset($_POST['quizid']) && !empty($_POST['answer'])) {
        //will test the select answer with the ones on the server
        //will store Score in Score table
        $quizid = $_POST['quizid'];
        $answer = $_POST['answer'];
        $correct = 0;

        for($i = 0; $i < count($answer); $i++){
            $answer[$i] = htmlentities(strip_tags($answer[$i]), ENT_QUOTES);
            if(empty($answer[$i])) {
                exit("Missing answer");
            }
        }
        if($db->connect_error) {
            exit("Bad Connection");
        } else {
            $select = "SELECT Q_answer FROM Questions WHERE Quiz_id = '{$quizid}'";
            $stmt = $db->prepare($select);

            if($stmt->execute()){
                $stmt->bind_result($ans);
                $j = 0;
                while($stmt->fetch()){
                    if($answer[$j] == $ans){
                        $correct++;
                    }
                    $j++;
                }
                echo "<h4>Score: $correct</h4><br>";
                echo "<br>";
            }
        }

        if($db->connect_error) {
            exit("Bad Conenction");
        } else {
            //Insert the score into Score table
            $insert = "INSERT INTO Scores (C_id, Quiz_id, S_score) 
                VALUES ('{$_SESSION['cid']}', $quizid, $correct);";
            
            if($db->query($insert)) {
                echo "<script>alert('Score Saved');</script>";
            } else {
                exit("ERROR: Score was not saved");
            }
        }
    } else if(isset($_POST['quiz']) && !empty($_POST['quiz'])) {
        //Displays the quiz
        $quiz_id = $_POST['quiz'];
        
        //This section will check if they have already taken the quiz or not
        if($db->connect_error){
            exit("Bad Connection");
        } else {
            $select = "SELECT S_Score FROM Scores WHERE C_id = {$_SESSION['cid']} AND Quiz_id = $quiz_id";

            if($res = $db->query($select)) {
                if($res->num_rows != 0) {
                    echo "<script>alert('You Have Already Taken the Quiz'); 
                          window.location='take_quiz.php';</script>"; 
                }
            }
        }

        $i = 0;
        if($db->connect_error) {
            exit("Bad Connection");
        } else {
            $select = "SELECT T_id, Quiz_id, Q_Question, Q_mult1, Q_mult2, Q_mult3, Q_mult4
                FROM Questions";
            $stmt = $db->prepare($select);

            if($stmt->execute()) {
                $stmt->bind_result($tid, $qid, $question, $mult1, $mult2, $mult3, $mult4);
                echo "<form action='take_quiz.php' method='post'>";
                while($stmt->fetch()){
                    if($quiz_id == $qid) {
                        echo "<br><label>$question</label><br>";
                        echo "<input type='radio' value=1 name='answer[{$i}]'>";
                        echo "<label>$mult1</label><br>";
                        echo "<input type='radio' value=2 name='answer[{$i}]'>";
                        echo "<label>$mult2</label><br>";
                        echo "<input type='radio' value=3 name='answer[{$i}]'>";
                        echo "<label>$mult3</label><br>";
                        echo "<input type='radio' value=4 name='answer[{$i}]'>";
                        echo "<label>$mult4</label><br>";
                        $i++;
                    }   
                }
                echo "<input type='hidden' value='{$quiz_id}' name='quizid'>";
                echo "<input type='submit' value='submit'>";
                echo "</form>";
            }
            
        }
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
