<?php
/**
 * Author: Group 10
 * Date: June 14, 2016
 * File: remove.php
 */
if (session_status() == PHP_SESSION_NONE){
    session_start();
}
/*
 * Author: Group 10
 * Date: Jun 14, 2016
 * File: remove.php
 * Description: this script deletes a project from the database.
 *
 */
$page_title = "Delete Project";
require_once 'includes/header.php';
require_once('includes/database.php');

//get users role
if(isset($_SESSION['role'])){
  $role = $_SESSION['role'];
}
//get username
if(isset($_SESSION['name'])){
  $username = $_SESSION['name'];
}
$artist = $_GET['artist'];


//if project id cannot retrieved, terminate the script.
if (!isset($_GET['id'])) {
    $error = "Your request cannot be processed since there was a problem retrieving project id.";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}


//retrieve project id from a query string variable.
$id = $_GET['id'];

//define sql delete statement
$sql = "DELETE FROM $tblProject WHERE id=$id";

//execute query and handle errors
//kick user out if not admin or own post
if($username = $artist OR $role = 1){
  $query = @$conn->query($sql);
}
else if (!$query){
    $error = "Deletion failed: " .$conn->error;
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

echo "<p> The project has been successfully deleted from the database </p>";

//close connection
$conn->close();

require_once 'includes/footer.php';