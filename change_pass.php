<!doctype html>
<html>
    <head>
        <title>Change Password</title>
    </head>
    <body>
<?php
    include('config.php');
    include('config.php');

    if(isset($_SESSION['userlogged'] && $_SESSION['userlogged'] == true) {
        if(isset($_POST['pass1']) && isset($_POST['pass2']) &&
           !empty($_POST['pass1']) && !empty($_POST['pass2'])) {
            
            $pass1 = htmlentities(strip_tags($_POST['pass1']), ENT_QUOTES);
            $pass2 = htmlentities(strip_tags($_POST['pass2']), ENT_QUOTES);
            $fname = $_SESSION['fname'];

            if($db->connect_error){
                exit("Bad Connection");
            } else {
                $collect = "SELECT C_id FROM Student WHERE C_fname='{$fname}'";
                if($res = $db->query($collect)) {
                    if($res->num_rows != 0) {
                        $isnewpassValid = ($pass1 == $pass2);

                        if($isnewpassValid == true) {
                            $db->query("UPDATE Student
                                        SET C_password = '{$pass1}'
                                        WHERE C_fname = '{$fname}'");
                        } else {
                            echo "<script>alert('Passwords did not match');
                                  windows.location('change_pass.php');</script>";
                        }
                    } else {
                        echo "<script>alert('User not created, Cannot change password');
                               windows.location('change_pass.php');</script>";
                
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
    }
?>
    </body>
</html>
