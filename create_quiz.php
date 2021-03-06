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

    <form style="text-align:center">
        <label for='qname'>Quiz Name</label><br>
        <input type='text' name='qname'>
        <p>------------------------------------------------------</p>
        <label for='question'>Question</label><br>
        <input type='test' name='question'><br>
            
        <label>Answers for Question</label><br>            
        <input type='radio' name='answer'>
        <input type='test' name='qans'><br>
        <input type='radio' name='answer'>
        <input type='test' name='qans'><br>
        <input type='radio' name='answer'>
        <input type='test' name='qans'><br>
        <input type='radio' name='answer'>
        <input type='test' name='qans'><br>

        <input type='submit' value='submit'><br>
    </form>
<?php

} else {
    header("Location: home.php");
}

?>
<script>
</script>
<html>
