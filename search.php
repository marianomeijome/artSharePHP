<?php
/*
* Author: Group 10
* Date: June 14, 2016
* Name: search.php
* Description: This script displays a search form.
*/
$page_title = "Search projects";

include ('includes/header.php');
?>
<h2>Search projects by Title</h2>
<p>Enter one or more words in project title.</p>
<form action="results.php" method="get">
    <input type="text" placeholder="Concept Painting..." name="q" size="40" required />&nbsp;&nbsp;
    <input type="submit" name="Submit" id="Submit" value="Search Projects" class="searchbutton" />
</form>
<?php
include ('includes/footer.php');
