<?php

/*
 * Author: Group 10
 * Date: Jun 14, 2016
 * File: update.php
 * Description: this script updates project details in the database.
 *
 */
 
//Do not proceed if there is no post data
if (!$_POST) {
    $error = "Direct access to this script is not allowed.";
    header("Location: error.php?m=$error");
    die();
}

//retrieve project id. Do not proceed if id was not found.
if (!isset($_POST['id'])) {
    $error = "There was a problem retrieving project id.";
    header("Location: error.php?m=$error");
    die();
}

$id = $_POST['id'];

//include code from the database.php file
require_once('includes/database.php');

/* Proceed since id was successfully retrieved. 
 * Retrieve project details. 
 * For security purpose, call the built-in function real_escape_string to 
 * escape special characters in a string for use in SQL statement.
 */
$title = $conn->real_escape_string(trim($_POST['title']));
$artist = $conn->real_escape_string(trim($_POST['artist']));
$category = $conn->real_escape_string(trim($_POST['category']));
$image = $conn->real_escape_string(trim($_POST['image']));
$description = $conn->real_escape_string($_POST['description']);



//define mysql insert statement
$sql = "UPDATE $tblProject SET " .
		"title='$title', " .
		"artist='$artist', " .
		"image='$image', " .
		"description='$description', " .
		"category_id='$category' " .
		"WHERE id ='$id'";

//execute query
$query = @$conn->query($sql);

//Handle potential errors
if(!query) {
	$error = "Update failed: " . $conn->error;
	$conn->close();
	header("Location: error.php?m=$error");
	die();
}

//close connection
$conn->close();
header("Location: details.php?id=$id&m=update");