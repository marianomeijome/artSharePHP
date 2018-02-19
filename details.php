<?php
/**
 * Author: Group 10
 * Date: June 14, 2016
 * File: details.php
 *  Description: This script displays details of a particular project.
 */
$page_title = "Project Details";
require_once ('includes/header.php');
require ('includes/database.php');

//if project id cannot be retrieved, terminate
if(!isset($_GET['id'])){
    $error = "Your request cannot be processed since there was a problem retrieving project id.";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

//retrieve project id from a query string variable
$id = $_GET['id'];

//select statement
$sql = "SELECT * FROM $tblProject, $tblCategory WHERE id=$id AND $tblProject.category_id = $tblCategory.category_id";

//execute the query
$query = $conn->query($sql);

//handle errors
if (!$query){
    $error = "Selection failed: " .$conn->error;
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

$row = $query->fetch_assoc();

if(!$row){
    $error = "Project not found";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

//variables for a users login, name, and role
if(isset($_SESSION['login']) AND isset($_SESSION['name']) AND isset($_SESSION['role'])){
  $login = $_SESSION['login'];
  $name = $_SESSION['name'];
  $role = $_SESSION['role'];
}

?>

<h2 class="projectheader"><?= $row['title'] . " by <small id='artistname'>" . $row['artist'] . "</small>" ?> </h2>
<div class="mainpiece">
	<!-- display project image -->
	<img src="<?= $row['image']?>" alt="">
</div>
<table id="projectview" class="projectview">
    <tr class="info">
        <td class="col2">
            <h4>Category:</h4>
            <h4>Description:</h4>
            <h4>Add to Favorites:</h4>
        </td>
        <td class="col3">
			<!-- display project details -->
            <p> <?= $row['category'] ?> </p>
            <p> <?= $row['description'] ?> </p>
            <?php
                if($role == 1 OR $role == 2){
                    echo "<p class='fav'><a href='addtocart.php?id=$id' class='fa fa-heart fa-3x' ></a></p>";
            }else{
                echo "<p>You must <a href='login.php'>Login</a> to favorite this piece.</p>";
            }
            ?>
        </td>
        
    </tr>
</table>
<?php
$confirm = "";
if(isset($_GET['m'])){
    if($_GET['m'] == "insert"){
        $confirm = "You have succesfully added a new project.";
    }
    else if($_GET['m'] == "update"){
        $confirm = "Your project has been successfully updated.";
    }
}
?>
<?php
if($name == $row['artist'] OR $role == 1){
    echo "<div class='project-button'>",
        "<a href='edit.php?id=" .$id. "'><input type='button' value='Edit'></a>",
        "<a href='delete.php?id=" .$id. "'><input type='button' value='Delete'></a>",
        "<a href='projects.php'><input type='button' value='Cancel'></a>",
        "<div style='color:red; display: inline-block;'><?= $confirm ?></div>",
        "</div>";
}
?>

<?php
require_once ('includes/footer.php');
?>
