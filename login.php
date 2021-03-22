<?php
//Writen by: Keelan Brening
//File: login.php
//
//Purpose:
//  The purpose of this file is to handle the login for all users, admin and users. 
?>
<!doctype html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="home.css"> 
    </head>
    <body>
<?php session_start(); ?>
    <div id='nav'>
        <?php include('nav.php');?>
    </div>
<?php
//session_start();

include('config.php');

//Will redirect the user or admin out if they are already logged in

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

        if($db->connect_error){
            exit("Bad Connection");
            echo "<script>alert('Bad Connection')</script>"; 
            
        } else {
            
            //Will preform 2 querys, 1 to check if they belong in the Student table and 1
            //to check if they are in the Teacher table.

            $sres = $db -> query("SELECT * FROM Student WHERE C_fname = '{$fname}'");
            $tres = $db -> query("SELECT * FROM Teacher WHERE T_fname = '{$fname}'");
            
            //Student

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
                        $isnew = $row['C_isnew'];

                        //Check if user logs in for the first time. If they are then they will
                        //be redirected to change there password, if not they they will go to 
                        //the home page
                        
                        if($isnew != 0) {
                            $update = "UPDATE Student
                                                SET C_isnew = 0
                                                WHERE C_fname = '{$fname}'";
                            if($db->query($update)){
                                echo "<script>alert('New login: Redirecting to change password');
                                      window.location='change_pass.php'</script>";
                            } else {
                                echo "<script>alert('Error with new login');
                                      window.location='login.php';</script>";
                            }
                        } else {
                            header("Location: home.php");
                        }
                    } else {
                        echo "<script>alert('User Not Found');
                               window.location='login.php';</script>";
                    }

                }

            //Teacher

            if($tres) 
                if($row = $tres->fetch_assoc()){
                    
                    $isfnameValid = ($fname == $row['T_fname']);
                    $ispassValid = ($pass == $row['T_password']);

                    //Cheeck if the Teacher account has valid credentials 

                    if($isfnameValid == true && $ispassValid == true) {
                        $_SESSION['adminlogged'] = true;
                        $_SESSION['fname'] = $row['T_fname'];
                        $_SESSION['lname'] = $row['T_lname'];
                        $_SESSION['tid'] = $row['T_id'];
                        header("Location: home.php");
                    } else {
                        echo "<script>alert('Teacher Not Found');
                               window.location='login.php';</script>";
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
