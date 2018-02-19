<?php

/*
 * Author: Group 10
 * Date: Jun 14, 2016
 * File: insert.php
 * Description: This script inserts a new project into the project table
 *
 */

//Do not proceed if there is no post data
if (!$_POST) {
    $error = "Direct access to this script is not allowed.";
    header("Location: error.php?m=$error");
    die();
}

//include code from database.php file
require_once('includes/database.php');

/* Retrieve project details.
 * For security purpose, call the built-in function real_escape_string to
 * escape special characters in a string for use in SQL statement.
 */
$title = $conn->real_escape_string(trim($_POST['title']));
$artist = $conn->real_escape_string(trim($_POST['artist']));
$category = $conn->real_escape_string(trim($_POST['category']));
$image = $conn->real_escape_string(trim($_POST['image']));
$description = $conn->real_escape_string($_POST['description']);


//Define MySQL insert statement
$sql = "INSERT INTO $tblProject VALUES (NULL, '$title', '$artist', '$category', '$image', '$description')";
//execute the query
$query = @$conn->query($sql);

//handle selection errors
if(!$query){
    $error = "Selection failed: " . $conn->error;
    $conn->close();
    header("Location: error.php?m=$error");
    die();

}

//Determine project ID
$id = $conn->insert_id;

//close connection
$conn->close();
header("Location: details.php?id=$id&m=insert");
