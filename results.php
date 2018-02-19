<?php
/*
 * Author: Group 10
 * Date: June 14, 2016
 * Name: results.php
 * Description: This script searches for projects that match project titles in the database.
 */
$page_title = "Projects search results";

require_once ('includes/header.php');
require_once('includes/database.php');

//retrieve search term
if(!isset($_GET['q'])){
	$error = "There were no search terms found." . $conn->error;
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

$term = $_GET['q'];

//explode the search terms into an array
$terms = explode(" ", $term);

//select statement using pattern search
$sql = "SELECT id, title, artist, category, image"
       ." FROM $tblProject, $tblCategory"
       ." WHERE projects.category_id = categories.category_id AND 1";
//search one or more terms
foreach ($terms as $term){
    $sql .= " AND title LIKE '%$term%'";
}

//execute the query
$query = $conn->query($sql);

//handle selection errors
    if(!$query){
        $error = "Selection failed: " . $conn->error;
        $conn->close();
        header("Location: error.php?m=$error");
        die();

    }

?>
<h2>Project search results for: '<?= $term ?>'</h2>

<?php
//code to decide whether table shows based on num rows
if($query->num_rows == 0){
    echo "Your search '$term' did not match any projects in our inventory";
    include ('includes/footer.php');
    exit;
}
?>

    <!--display results in a table-->
    <?php
    while (($row = $query->fetch_assoc()) !== NULL){
        echo "<ul class='results'>";
				echo "<li><a href='details.php?id=", $row['id'], "'><div class='projectimg'><img src=" . $row['image'], "></div> </a></li>";
        echo "<li><a href='details.php?id=", $row['id'], "'>", $row['title'],"</a><br/> by ", $row['artist'], "</li>";
        echo "</ul>";
    }
    ?>

	<!-- insert a row into the table for each project -->

<?php
include ('includes/footer.php');
