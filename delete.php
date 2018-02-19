<?php
/**
 * Author: Group 10
 * Date: June 14, 2016
 * File: delete.php
 * Description: This script confirms deletion of project.
 */
$page_title = "Confirm Project Deletion";
require_once ('includes/header.php');
require_once('includes/database.php');

//if project id cannot retrieved, terminate the script.
if (!isset($_GET['id'])) {
    $error = "Your request cannot be processed since there was a problem retrieving project id.";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

//retrieve project id from a query string variable.
$id = $_GET['id'];

//MySQL SELECT statement
$sql = "SELECT * FROM $tblProject, $tblCategory WHERE projects.category_id = categories.category_id AND id=$id";

//execute the query
$query = @$conn->query($sql);

//Handle errors
if (!$query) {
    $error = "Selection failed: " . $conn->error;
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

$row = $query->fetch_assoc();
if (!$row) {
    $error = "Project not found";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}
//get users role
if(isset($_SESSION['role'])){
  $role = $_SESSION['role'];
}
//get username
if(isset($_SESSION['name'])){
  $username = $_SESSION['name'];
}
//kick user out if not admin or own post
if($username != $row['artist'] AND $role != 1){
  $error = "You cannot delete other people's work unless admin.";
  header("Location: error.php?m=$error");
  exit();
}
?>

<h2>Project Details</h2>
<table id="projects" class="projects">
    <tr>
        <td class="col1">
            <!-- display project image -->
            <img src="<?php echo $row['image'] ?>" alt="" width="150" />
        </td>
        <td class="col2">
            <h4>Title:</h4>
            <h4>Artist:</h4>
            <h4>Category:</h4>
            <h4>Image:</h4>
            <h4>Description:</h4>
        </td>
        <td class="col3">
            <!-- display project details -->
            <p><?= $row['title'] ?></p>
            <p><?= $row['artist'] ?></p>
            <p><?= $row['category'] ?></p>
            <p><?= $row['image'] ?></p>
            <p><?= $row['description'] ?></p>
        </td>
    </tr>
</table>
<div class="project-button">
    <input type="button" value="Delete"
           onclick="window.location.href = 'remove.php?id=<?= $id ?>'">
    <input type="button" value="Cancel" 
           onclick="window.location.href = 'details.php?id=<?= $id ?>'">
    <div style="color: red; display: inline-block;">Are you sure you want to delete the project?</div>
</div>
<?php
require_once ('includes/footer.php');
