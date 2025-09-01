<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
</head>
<body>
    <h1>Profile</h1>
    <?php
        if (isset($_SESSION['login']) && $_SESSION['login'] === true) 
		{
            echo "Logged in!";
        } 
		else 
		{
            echo "You are not logged in!";
        }
		
    ?>
	<p><a href="homepage.html">Home</a></p>
	<p><a href="logout.php">Logout</a></p>
</body>
</html>