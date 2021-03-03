<!doctype html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
<?php session_start(); ?>
    <div id='nav'>
        <?php include('nav.php');?>
    </div>
<?php
//session_start();

include('config.php');

if(isset($_SESSION['userlogged']) && $_SESSION['userlogged'] == true) {
    //redirect to home.php. nop need for login when you are logged i
    echo "<script>alert('User is logged in')</script>";
    header("Location: home.php");
} else if(isset($_SESSION['adminlogged']) && $_SESSION['adminlogged'] == true) {
    header("Location: home.php");
} else {
    if(isset($_POST['fname']) && isset($_POST['pass']) && !empty($_POST['fname']) && !empty($_POST['pass'])){

        $fname = htmlentities(strip_tags($_POST['fname']), ENT_QUOTES);
        $pass = htmlentities(strip_tags($_POST['pass']), ENT_QUOTES);

        echo "<script>alert('$fname & $pass')</script>";

        if($db->connect_error){
            exit("Bad Connection");
            echo "<script>alert('Bad Connection')</script>"; 
            
        } else {
            $sres = $db -> query("SELECT * FROM Student WHERE C_fname = '{$fname}'");
            $tres = $db -> query("SELECT * FROM Teacher WHERE T_fname = '{$fname}'");

            if($sres) 
                if($row = $sres->fetch_assoc()){
                    
                    $isfnameValid = ($fname == $row['C_fname']);
                    $ispassValid = ($pass == $row['C_password']);

                    if($isfnameValid == true && $ispassValid == true) {
                        $_SESSION['userlogged'] = true;
                        $_SESSION['fname'] = $row['C_fname'];
                        $_SESSION['lname'] = $row['C_lname'];
                        $_SESSION['cid'] = $row['C_id'];
                        $_SESSION['tid'] = $row['T_id'];
                        //$_SESSION['isnew'] = $row['C_isnew'];
                        header("Location: home.php");
                    } else {
                        header("Location: login.php");
                        session_destroy();
                    }

                }
            if($tres) 
                if($row = $tres->fetch_assoc()){
                    
                    $isfnameValid = ($fname == $row['T_fname']);
                    $ispassValid = ($pass == $row['T_password']);

                    if($isfnameValid == true && $ispassValid == true) {
                        $_SESSION['adminlogged'] = true;
                        $_SESSION['fname'] = $row['T_fname'];
                        $_SESSION['lname'] = $row['T_lname'];
                        $_SESSION['tid'] = $row['T_id'];
                        header("Location: home.php");
                    } else {
                        header("Location: login.php");
                        session_destroy();
                    }

                }
        }


    } else {
?>
    
    <div class=border>
        <form action='login.php' method='post'>
            <label for="fname">First Name</label><br>
            <input type='text' name="fname"><br>
            <label for="pass">Password</label><br>
            <input type='password' name="pass">
            <br><input type='submit' value='Submit'>
        </form>
    </div>
    <!--<br><a href='createlogin.php'>Create Login</a>";-->
<?php
    }
}
?>
    </body>
</html>
