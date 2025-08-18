<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php
echo "Hello World!<br>";

$a = array(5, 6, 7);
$sum = 0;

for ($x = 0; $x < count($a); $x++) {
    $sum += $a[$x];
}
echo "The sum of the numbers is: $sum <br>";

sort($a);
$ss = $a[count($a) - 2];
echo "Second largest number: $ss <br>";

echo "Right triangle: ";
for ($i = 0; $i < 5; $i++) {
    for ($j = 0; $j < $i; $j++) {
        echo "*";    
    }
    echo "<br>";
}

$str = "sarjin";
echo "Input string: $str <br>";
$revstr = strrev($str);
echo "Reversed string: $revstr <br>";

$v = "";
$c = "";

for ($x = 0; $x < strlen($str); $x++) {
    if ($str[$x] == 'a' || $str[$x] == 'e' || $str[$x] == 'i' || $str[$x] == 'o' || $str[$x] == 'u' || 
        $str[$x] == 'A' || $str[$x] == 'E' || $str[$x] == 'I' || $str[$x] == 'O' || $str[$x] == 'U') {
        $v .= $str[$x];  
    } else {
        $c .= $str[$x]; 
    }
}

echo "Vowels: $v <br>";
echo "Consonants: $c <br>";

?>

</body>
</html>
