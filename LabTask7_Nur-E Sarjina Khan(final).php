<?php
$name=$_POST["name"];
$email=$_POST["email"];
$website=$_POST["website"];
$comment=$_POST["comment"];
$gender=$_POST["gender"];
$file=$_FILES["file"];
$errors = 0;
if($name==""||$email==""||$gender=="")
{
	echo("Field is required.<br>");
}
if (!($name >= 'A' && $name <= 'Z') && !($name >= 'a' && $name <= 'z') && !($name == " "))
{
	echo("Name should contain only letters and whitespace<br>");
	$errors++;
}

if (strpos($email, "@") === false || strpos($email, ".") === false) 
{

	echo("Email formet is not correct<br>");
	$errors++;
}
if (!filter_var($website, FILTER_VALIDATE_URL))
{
	echo("URl formet is not correct or valid<br>");
	$errors++;
}
$fileType=$file['type'];
$fileSize=$file['size'];

 if ($fileType != "image/jpeg" && $fileType  != "image/png" && $fileType  != "application/pdf" ) 
 {
        echo "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed.<br>";
		$errors++;
        
    }
	 if ($fileSize > 2000000) 
	 {  
                echo "Sorry, your file is too large. Maximum size is 2MB.<br>";
				$errors++;
      }
if ($errors==0) {
    echo "Form submission successful!<br>";
}
 
 
?>
