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
//$server = 'localhost';
//$user = 'kbrening';
//$password = '1234';
//$database = 'kbrening';
//$db = new mysqli($server, $user, $password, $database);

include('config.php');

if(isset($_SESSION['userlogged']) && $_SESSION['userlogged'] == true) {
    //redirect to home.php. nop need for login when you are logged i
    header("Location: home.php");
} else if(isset($_SESSION['adminlogged']) && $_SESSION['adminlogged'] == true) {
    header("Location: home.php");
} else {
    if(isset($_POST['fname']) && isset($_POST['pass']) && !empty($_POST['fname']) && !empty($_POST['pass'])){

        $fname = htmlentities(strip_tags($_POST['fname']), ENT_QUOTES);
        $tpass = htmlentities(strip_tags($_POST['pass']), ENT_QUOTES);
        $pass = password_hash($tpass, PASSWORD_BCRYPT);

        if($db->connect_error){
            exit("Bad Connection");
        } else {
            $res = $db -> query("SELECT * FROM Student WHERE C_fname = '{$fname}'");

            if($res)
                if($row = $res->fetch_assoc()){
                    
                    $isfnameValid = ($fname == $row['C_fname']);
                    $ispassValid = ($pass == $row['C_password']);
                    
                    if($isfnameValid == true && $ispassValid == true) {
                        $_SESSION['userlogged'] = true;
                        $_SESSION['fname'] = $row['C_fname'];
                        $_SESSION['id'] = $row['C_id'];
                        header("Location: home.php");
                        //echo "correct info";
                    //need to check for admin/Teacher
                    /*} else if($isemailValid == true && $ispassValid == true ) {
                        $_SESSION['userlogged'] = true;
                        $_SESSION['fname'] = $row['user_fname'];
                        $_SESSION['email'] = $row['user_email'];
                        header("Location: home.php");
                    */
                    } else {
                        header("Location: login.php");
                    }

                }
        }


    } else {
?>
    
    <div class=border>
        <form action='login.php' method='post'>
            <label for='fname'>First Name</label><br>
            <input type='text' value='' name='fname'><br>
            <label for='pass'>Password</label><br>
            <input type='password' value='' name='pass'>
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
