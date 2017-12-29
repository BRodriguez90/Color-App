<?php
$name = $_POST['name'];
$email = $_POST['email'];
$subject = "subject";
$message = $_POST['message'];
$recipient = "youremail@here.com";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $email, $mailheader) or die("Error!");
echo "Thank You!";
?>