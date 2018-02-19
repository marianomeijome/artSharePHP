<?php
//Do not proceed if there are no post data
if(!$_POST) {
    $error = "The service is currently unavailable. Please try again later.";
    header("Location: error.php?m=$error");
    die();
}

//include code from header.php and database.php
require_once('includes/database.php');

/* Retrieve user inputs from the form.
 * For security purpose, call the built-in function real_escape_string to
 * escape special characters in a string for use in SQL statement.
 */
$firstname = $conn->real_escape_string(trim($_POST['firstname']));
$lastname = $conn->real_escape_string(trim($_POST['lastname']));
$username = $conn->real_escape_string(trim($_POST['username']));
$password = $conn->real_escape_string(trim($_POST['password']));

//set user's role
$role = 2;  //regular user

//insert statement. The id field is an auto field.
$sql = "INSERT INTO users VALUES (NULL, '$firstname', '$lastname', '$username', '$password', '$role')";

//execut the insert query
$query = @$conn->query($sql);

//Handle insertion errors
if (!$query) {
    $error = "Insertion failed: $error = $conn->error.";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

$conn->close();

//start session if it has not already started
if(session_status() == PHP_SESSION_NONE){
  session_start();
}
//create session variables
$_SESSION['login'] = $username;
$_SESSION['name'] = "$firstname $lastname";
$_SESSION['role'] = 2;
//set login status to 3 since this is a new user.
$_SESSION['login_status'] = 3;
//redirect the user to the loginform.php page
header("Location: login.php");

 ?>
