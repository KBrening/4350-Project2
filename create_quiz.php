<?php
//Writen By: Keelan Brening
//File: create_quiz.php
//
//Purpose:
//  This page will allow the Admin/Teacher to create a quiz with a max of 50 questions
?>

<html>
    <head>
        <title>Create Quiz - Quiz Taker</title>
        <link rel="stylesheet" href="home.css">
        <script scr="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
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
    $quizname = $_POST['qname'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $mult1 = $_POST['mult1'];
    $mult2 = $_POST['mult2'];
    $mult3 = $_POST['mult3'];
    $mult4 = $_POST['mult4'];
    $err = 0;
    $count = count($question);
    $quizname = htmlentities(strip_tags($quizname), ENT_QUOTES);
    
    for($i = 0; $i < $count; $i++) {
        $question[$i] = htmlentities(strip_tags($question[$i]), ENT_QUOTES);
        $answer[$i]   = htmlentities(strip_tags($answer[$i])  , ENT_QUOTES);
        $mult1[$i]    = htmlentities(strip_tags($mult1[$i])   , ENT_QUOTES);
        $mult2[$i]    = htmlentities(strip_tags($mult2[$i])   , ENT_QUOTES);
        $mult3[$i]    = htmlentities(strip_tags($mult3[$i])   , ENT_QUOTES);
        $mult4[$i]    = htmlentities(strip_tags($mult4[$i])   , ENT_QUOTES);
    }

    for($i = 0; $i < $count; $i++) {
        if(empty($quizname) || empty($question[$i]) || empty($answer[$i]) || empty($mult1[$i]) || 
           empty($mult2[$i]) || empty($mult3[$i]) || empty($mult4[$i])) {
            $err++;
        }
    }

    if(isset($_POST['qname']) && isset($_POST['question']) && isset($_POST['answer']) && isset($_POST['mult1']) 
        && isset($_POST['mult2']) && isset($_POST['mult3']) && isset($_POST['mult4']) && !empty($_POST['qname']) 
        && !empty($_POST['question']) && !empty($_POST['answer']) && !empty($_POST['mult1']) && 
        !empty($_POST['mult2']) && !empty($_POST['mult3']) && !empty($_POST['mult4']) && $err == 0) {
        echo "<script>alert('YES');</script>";
    } else {
  
    //if($db->connect_error) {
    //    exit("Bad Connection");
    //} else {
    
    //}
?>
    <h4>How to use the page</h4>
    <p>
        Enter in the name of the quiz <br>
        Then type the Question 1 out and the 4 answers to it<br>
        Click add more to add another Question<br>
        Click remove to remove that question<br>
    </p>

    <form action='create_quiz.php' method='post' style="text-align:center">
        <label for='qname'>Quiz Name</label><br>
        <input type='text' name='qname'>
        <p>------------------------------------------------------</p>
        <div class='parent'>
            <div class='child'>
                <label for='question'>Question</label><br>
                <input type='test' name='question[0]'><br>
                    
                <label>Answers for Question</label><br>            
                <input type='radio' value='1' name='answer[0]'>
                <input type='text' name='mult1[0]'><br>
                <input type='radio' value='2' name='answer[0]'>
                <input type='text' name='mult2[0]'><br>
                <input type='radio' value='3' name='answer[0]'>
                <input type='text' name='mult3[0]'><br>
                <input type='radio' value='4' name='answer[0]'>
                <input type='text' name='mult4[0]'><br>
            </div>
        </div>
        <button type='button' class='addService'>Add Question</button>
        <button type='button' class='removeService'>Remove Question</button><br><br>
        <input type='submit' value='submit'><br>
    </form>
<?php
    }
} else {
    header("Location: home.php");
}

?>
<script>
var counter = 1;

$(document).on('click', '.addService', function() {

    if(counter > 9) {
        alert("Max 10 question");
        return false;
    }

    var html = "<div class='child'><label for='question'>Question</label><br>" +
        "<input type='text' name='question["+counter+"]'><br>" +
        "<label>Answers for Question</label><br>" +            
        "<input type='radio' name='answer["+counter+"]'>" +
        "<input type='text' name='mult1["+counter+"]'><br>" +
        "<input type='radio' name='answer["+counter+"]'>" +
        "<input type='text' name='mult2["+counter+"]'><br>" +
        "<input type='radio' name='answer["+counter+"]'>" +
        "<input type='text' name='mult3["+counter+"]'><br>" +
        "<input type='radio' name='answer["+counter+"]'>" +
        "<input type='text' name='mult4["+counter+"]'><br></div>";
    //$(this).parent().prepend(html);
    $('.parent').append(html);
    counter++;
});
$(document).on('click', '.removeService', function() {

    if(counter == 1) {
        alert("Cannot remove anymore");
        return false;
    }

    $('.parent').find("div:last").remove();
    counter--;
});

</script>
<html>
