<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Verification</title>
</head>
<body>
    <h1>Login Verification!</h1>
    <?php 
        
            $uname = $_POST['uname'];
            $pass = $_POST['pass'];

            
            echo "Entered Username: " . $uname . "<br>";
            echo "Entered Password: " . $pass . "<br>";

            if ($uname == "sarjin" && $pass == "sarjin") 
			{
                $_SESSION['uname'] = $uname; 
                $_SESSION['login'] = true; 
                echo "Logged in successfully!<br>";
            } 
			else 
			{                
                echo "Login failed.<br>";                
            }
        
    ?>
    <p><a href="profile.php">Check Profile</a></p>  
</body>
</html>