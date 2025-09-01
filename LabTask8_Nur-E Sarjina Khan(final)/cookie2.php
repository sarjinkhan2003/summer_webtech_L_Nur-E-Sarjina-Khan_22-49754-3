<!DOCTYPE html>
<html>
<head>
    <title>Cookie Check</title>
</head>
<body>
    <h1>Cookie Value</h1>
    <?php 
        $name = isset($_COOKIE["Fav_Chocolate"]) ? $_COOKIE["Fav_Chocolate"] : "Not Found";
        echo $name; 
    ?>
</body>
</html>