<?php
/**
 * Author: Group 10
 * Date: June 14, 2016
 * File: projects.php
 * Description: this script lists all projects from the projects table.
 *
 */
$page_title = "Student Projects";
require 'includes/header.php';
require 'includes/database.php';

//construct SELECT statement
$sql = "SELECT id, title, artist, category, image
        FROM $tblProject, $tblCategory
        WHERE projects.category_id = categories.category_id";

//execute the query on the MySQL server
$query = @$conn -> query($sql);

//if query returns false (!)
    if(!$query){
    	$error = "Selection failed: " . $conn->error;
    	$conn->close();
    	header("Location: error.php?m=$error");
    	die();

    }
?>

<h2>Student Projects</h2>
  <ul id="projects" class="projects">
    <?php
    while ($row = $query->fetch_assoc()){
    	echo "<li><a href='details.php?id=", $row['id'], "'><div class='projectimg'><img src=" . $row['image'], "></div> </a></li>";
    }
    ?>
  </ul>
<?php
require 'includes/footer.php';
