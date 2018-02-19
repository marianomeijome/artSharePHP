<?php
/*
 * Author: Group 10
 * Date: June 14, 2016
 * File: upload.php
 * Description: This script displays a form to accept a new project's details.
 *
 */

//Make sure user has proper credentials
if (session_status() == PHP_SESSION_NONE){
     session_start();
}

//get users role
if(isset($_SESSION['role'])){
  $role = $_SESSION['role'];
}

//get username
if(isset($_SESSION['name'])){
  $username = $_SESSION['name'];
}

//if users role is 3, display error
if($role !=1 AND $role !=2){
  $error = "You must be logged in to upload. <a href='login.php'>Log In/Register</a>";
  header("Location: error.php?m=$error");
  exit();
}


$page_title = "Student Art Gallery Add Project";
require_once 'includes/header.php';
?>

<h2>Upload New Project</h2>
<form action="insert.php" method="post" class="uploadform">
    <table class ="uploadform" cellspacing="0" cellpadding="3" style="padding-top:10px;">
        <tr>

            <td class="formlabel"><input name="title" placeholder="Title" type="text" size="100" required /></td>
        </tr>
        <tr>
            <td class="formlabel" style="color:red;"><input name="artist" value="<?php echo $username ?>" type="text" size="40" readonly /></td>
        </tr>
        <tr>
            <td>
                <select name="category" required>
                    <option value="1">3D Digital Art</option>
                    <option value="2">Graphic Design</option>
                    <option value="3">Traditional Art</option>
                    <option value="4">Videography</option>
                </select>
            </td>
        </tr>

        <tr>
            <td class="formlabel"><input name="image" type="text" placeholder="Image" size="100" required /></td>
        </tr>
        <tr>
            <td><textarea name="description" placeholder="This cool painting was made in photoshop." rows="6" cols="65"></textarea></td>
        </tr>
    </table>
    <div class="project-button">
        <input type="submit" value="Add Project" />
        <input type="button" value="Cancel" onclick="window.location.href='projects.php'" />
    </div>
</form>

<?php
require_once 'includes/footer.php';
