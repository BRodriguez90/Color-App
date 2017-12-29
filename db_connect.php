<?php
	$server = "localhost";
	$username = "be132744";
	$password = "Swissdevelopment9@";
	$database = "be132744";
	
	$connection = mysqli_connect($server , $username , $password, $database) or die(mysql_error());  //(host,username,password,database) Connects to mysql server. Throws error if it cannot connect. 
?>