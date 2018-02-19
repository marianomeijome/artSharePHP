<?php

//define parameters
$host = "localhost";
$login = "username";
$password = "password";
$database = "database_name";

//must create these in phpmyadmin
$tblProject = "projects";
$tblCategory = "categories";
$tblUser = "users";
$tblImage = "images";

//connect to mysql server
$conn = @new mysqli($host, $login, $password, $database);

//handle connection errors
if($conn->connect_errno){
	$error = $conn->connect_error;
	header("Location: ../error.php?m=$error");
	die();
}

?>
