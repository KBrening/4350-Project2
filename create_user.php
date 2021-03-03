<!doctype HTML>
<html>
    <head>
        <title>Create User</title>
    </head>
    <body>
<?php 
session_start();

include('nav.php');
include('config.php');

if(isset($_SESSION['userlogged']) && $_SESSION['userlogged'] == true) {
    header("Location: home.php");
} else if (isset($_SESSION['adminlogged']) && $_SESSION['adminlogged'] == true) {
    if(isset($_POST['fname'])  && isset($_POST['lname']) && isset($_POST['pass']) &&
        !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['pass'])){
        
        $fname = htmlentities(strip_tags($_POST['fname']), ENT_QUOTES);
        $lname = htmlentities(strip_tags($_POST['lname']), ENT_QUOTES);
        $pass = htmlentities(strip_tags($_POST['pass']), ENT_QUOTES);
        
        if($db->connect_error) {
            exit("Connection Failed");
        } else {
            $sql = "SELECT C_id FROM Student WHERE C_fname='{$fname}'";
            if($res = $db->query($sql)) {
                if($res->num_rows != 0) {
                    echo "<script>alert('Account already created'); 
                          window.location='create_user.php';</script>";
                } else {
                    $tid = $_SESSION['tid'];
                    $insert = "INSERT INTO Student (T_id, C_fname, C_lname, C_password, C_isnew)
                        VALUES ('{$tid}', '{$fname}', '{$lname}', '{$pass}', 1)";

                    if($db->query($insert) === TRUE) {
                        echo "<script>alert('User $fname created successfully');
                              window.location='create_user.php';</script>";
                    } else {
                        echo "<script>alert('Error: Account could not be created');
                              window.location='create_user.php';</script>";
                    }
                }
            }
        }
    } else {
?>
    <form action='create_user.php' method='post'>
        <label for='fname'>First Name</label><br>
        <input type='text' value='' name='fname'><br>
        <label for='lname'>Last Name</label><br>
        <input type='text' value='' name='lname'><br>
        <label for='pass'>Password</label><br>
        <input type='password' value='' name='pass'><br>
        <input type='submit' value="Submit">
    </form> 
<?php
    }
} else {
    header("Location: home.php");
}

?>
    </body>
</html>
