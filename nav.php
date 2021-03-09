<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
    if(isset($_SESSION['userlogged']) && $_SESSION['userlogged'] == true) {

        echo "<nav class='navbar navbar-expand-sm bg-secondary navbar-dark'>";
        echo "<ul class='navbar-nav'>";
        echo "<li class='nav-item active'>";
        echo "<a class='nav-link' href='home.php'>Home</a>";
        echo "</li>";
        echo "<li class='nav-item active'>";
        echo "<a class='nav-link' href='take_quiz.php'>Take Quiz</a>";
        echo "</li>";
        echo "<li class='nav-item active'>";
        echo "<a class='nav-link' href='*'>Scores</a>";
        echo "</li>";
        echo "<li class='nav-item active'>";
        echo "<a class='nav-link' href='logout.php'>Logout</a>";
        echo "</li>";
        echo "</ul>";
        echo "</nav>";

    } else if(isset($_SESSION['adminlogged']) && $_SESSION['adminlogged'] == true) {

        echo "<nav class='navbar navbar-expand-sm bg-secondary navbar-dark'>";
        echo "<ul class='navbar-nav'>";
        echo "<li class='nav-item active'>";
        echo "<a class='nav-link' href='home.php'>Home</a>";
        echo "</li>";
        echo "<li class='nav-item active'>";
        echo "<a class='nav-link' href='create_user.php'>Create User</a>";
        echo "</li>";
        echo "<li class='nav-item active'>";
        echo "<a class='nav-link' href='tquiz.php'>Create Quiz</a>";
        echo "</li>";
        echo "<li class='nav-item active'>";
        echo "<a class='nav-link' href='*'>View all Scores</a>";
        echo "</li>";
        echo "<li class='nav-item active'>";
        echo "<a class='nav-link' href='logout.php'>Logout</a>";
        echo "</li>";
        echo "</ul>";
        echo "</nav>";


    } else {

        echo "<nav class='navbar navbar-expand-sm bg-secondary navbar-dark'>";
        echo "<ul class='navbar-nav'>";
        echo "<li class='nav-item active'>";
        echo "<a class='nav-link' href='home.php'>Home</a>";
        echo "</li>";
        echo "<li class='nav-item active'>";
        echo "<a class='nav-link' href='login.php'>Login</a>";
        echo "</li>";
        echo "</ul>";
        echo "</nav>";


    }
?>
