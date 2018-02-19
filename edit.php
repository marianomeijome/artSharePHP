<?php
/**
 * Author: Group 10
 * Date: June 14, 2016
 * File: edit.php
 *  Description: This script displays details of a particular project in a form.
 */
$page_title = "Edit Project Details";
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

//variables for a users login, name, and role
if(isset($_SESSION['login']) AND isset($_SESSION['name']) AND isset($_SESSION['role'])){
  $login = $_SESSION['login'];
  $name = $_SESSION['name'];
  $role = $_SESSION['role'];
}
//kick user out if not admin or own post
if($username != $artist AND $role != 1){
  $error = "You cannot edit other people's work unless admin.";
  header("Location: error.php?m=$error");
  exit();
}
?>

<h2>Edit Book Details</h2>
<form action="update.php" method="post">
    <table class="uploadform">
        <tr>
            <td class="formlabel">Title: </td>
            <td><input name="title" type="text" value="<?php echo $row['title'] ?>" required></td>
        </tr>
        <tr>
            <td class="formlabel">Artist: </td>
            <td><input name="artist" type="text" value="<?php echo $row['artist'] ?>" readonly></td>
        </tr>
        <tr>
            <td class="formlabel">Category: </td>
            <td><select name="category">
                    <option value="1" <?= $row['category'] == '3d Digital Art' ? 'selected' : ''; ?>>3d Digital Art</option>
                    <option value="2" <?= $row['category'] == 'Graphic Design' ? 'selected' : ''; ?>>Graphic Design</option>
                    <option value="3" <?= $row['category'] == 'Traditional Art' ? 'selected' : ''; ?>>Traditional Art</option>
                    <option value="4" <?= $row['category'] == 'Videography' ? 'selected' : ''; ?>>Videography</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="formlabel">Image: </td>
            <td><input name="image" type="text" value="<?php echo $row['image'] ?>" required></td>
        </tr>
        <tr>
            <td class="formlabel" style="vertical-align:top;">Description: </td>
            <td><textarea name="description" rows="6" cols="65"><?php echo $row['description'] ?></textarea></td>
        </tr>
    </table>
    <div class="project-button">
        <input type="hidden" name="id" value="<?php echo $id ?>" />
        <input type="submit" value=" Update " />
        <input type="button" value="Cancel" onclick="window.location.href = 'details.php?id=<?= $id ?>'" />
    </div>
</form>
<?php
// close the connection.
$conn->close();
require_once 'includes/footer.php';
