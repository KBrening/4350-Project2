<?php
//Writen By: Keelan Brening
//File: Change_Password.php
//
//Purpose:
//  The purpose of this file is to force the user to change there password if they
//      log in for the first time. This allows for the user to create there own password
//      which will make it more secure.
?>

<!doctype html>
<html>
    <head>
        <title>Change Password</title>
    </head>
    <body>
<?php
    session_start();
    include('nav.php');
    include('config.php');
    
    //Only User are allow to change there password Currently
    //This check $_SESSION to see if one is logged in
    
    if(isset($_SESSION['userlogged']) && $_SESSION['userlogged'] == true) {

        //Grabs the POST request of the website and checks if they have something and
        //is not empty

        if(isset($_POST['pass1']) && isset($_POST['pass2']) &&
           !empty($_POST['pass1']) && !empty($_POST['pass2'])) {

            //Strips the HTML tages on the POST request to actual usable data

            $pass1 = htmlentities(strip_tags($_POST['pass1']), ENT_QUOTES);
            $pass2 = htmlentities(strip_tags($_POST['pass2']), ENT_QUOTES);
            $fname = $_SESSION['fname'];

            if($db->connect_error){
                exit("Bad Connection");
            } else {
                //Selects the id from the User First name and take the data
                
                $collect = "SELECT C_id FROM Student WHERE C_fname='{$fname}'";

                if($res = $db->query($collect)) {

                    //This checks to see if the User was created by seeing if theres no value
                    if($res->num_rows != 0) {
                        $isnewpassValid = ($pass1 == $pass2);

                        if($isnewpassValid == true) {

                            //If the passwords are correct it will update the password
                            //on the databse
                            
                            $update = "UPDATE Student
                                      SET C_password = '{$pass1}'
                                      WHERE C_fname = '{$fname}'";
                            if($db->query($update)) {
                                echo "<script>alert('Passwords changed');
                                    window.location='home.php';</script>";
                            } else {
                                echo "<script>alert('Error with updating password');
                                    window.location='change_pass.php';</script>";
                            }
                        } else {
                            echo "<script>alert('Passwords did not match');
                                  window.location='change_pass.php';</script>";
                        }
                    } else {
                        echo "<script>alert('User not created, Cannot change password');
                               window.location='change_pass.php';</script>";
                
                    }
                }
            }
    } else {

?>
    <form action='change_pass.php' method='post'>
        <h3>Change Password</h3>
        <label for='pass1'>New Password</label><br>
        <input type='password' name='pass1'><br>
        <label for='pass2'>Retype Password</label><br>
        <input type='password' name='pass2'><br>
        <input type='submit' value='Submit'>
    </form>
<?php
        }
    } else { 
        header("Location: home.php");
    }
?>
    </body>
</html>
