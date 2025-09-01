<?php 
    setcookie("Fav_Chocolate", "Dairy Milk Silk", time() + 20); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cookie Practice</title>
</head>
<body>
    <h1>Set Cookie!</h1>
    <?php 
        $name = isset($_COOKIE["Fav_Chocolate"]) ? $_COOKIE["Fav_Chocolate"] : "Not Found";
        echo $name; 
    ?>
    <p><a href="cookie2.php">Check Cookie</a></p>  
</body>
</html>