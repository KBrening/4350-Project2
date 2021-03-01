<html>
    <head>
        <title>Quiz Taker</title>
        <link rel="stylesheet" href="home.css"> 
    </head>
    <body>
        <?php session_start(); ?>
        <?php include('nav.php');?>
<?php
if(isset($_SESSION['userlogged']) && $_SESSION['userlogged'] == true) {
    $user = $_SESSION['fname'];
    echo "<br><br><h1> Welcome $user </h1><br><br>";
    echo "<h4>Please navigate to take your quiz</h4>";
} else if(isset($_SESSION['adminlogged']) && $_SESSION['adminlogged'] == true) {
    $user = $_SESSION['fname'];
    echo "<h1>Welcom $user to the website</h1>";
} else {
    echo "<h1>Welcome Guest to Quiz Taker</h2><br><br>";
    echo "<h4>Please Sign in to view the site</h4>";
}      
?>
    </body>
</html>
