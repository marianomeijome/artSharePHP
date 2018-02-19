<?php
/*
 * Author: group 10
 * Date: Jun 10, 2016
 * File: favorites.php
 *
 */

$page_title = "My Profile";
require_once ('includes/header.php');
require_once('includes/database.php');

//variables for a users login, name, and role
if(isset($_SESSION['login']) AND isset($_SESSION['name']) AND isset($_SESSION['role'])){
  $login = $_SESSION['login'];
  $name = $_SESSION['name'];
  $role = $_SESSION['role'];
  
}
//get username
if(isset($_SESSION['name'])){
  $username = $_SESSION['name'];
}
?>


<?php
//construct SELECT statement
$usersql = "SELECT id, artist, image
        FROM $tblProject
        WHERE '$username'=projects.artist";

//execute the query on the MySQL server
$userquery = @$conn -> query($usersql);

//if query returns false (!)
    if(!$userquery){
    	$error = "Selection failed: " . $conn->error;
    	$conn->close();
    	header("Location: error.php?m=$error");
    	die();

    }
?>
<ul id="projects" class="projects">
<h2>My Projects</h2>
    <?php
    while ($row = $userquery->fetch_assoc()){
    	echo "<li><a href='details.php?id=", $row['id'], "'><div class='projectimg'><img src=" . $row['image'], "></div> </a></li>";
    }
    ?>
  </ul>
<?php
if (!isset($_SESSION['cart']) || !$_SESSION['cart']) {
    //echo "<div style='clear:both'>Go favorite some <a href='projects.php'>artwork</a>.<br><br></div>";
    include ('includes/footer.php');
    exit();
}

//proceed since the cart is not empty
$cart = $_SESSION['cart'];
?>
<ul style="clear:both" class="projects">
  <h2>My Favorites</h2>

    <?php
    //insert code to display the shopping cart content

    //select statement
    $sql = "SELECT id, title, image, artist FROM projects WHERE 0";

    foreach (array_keys($cart) as $id){
        $sql .= " OR id=$id";
    }

    //execute the query
    $query = @$conn->query($sql);

    //feth books and display them in a table
    while ($row = $query->fetch_assoc()) {
        $id = $row['id'];
        $title = $row['title'];
        $image = $row['image'];
        $qty = $cart[$id];
        $total = $qty * $price;
        echo "<li><a href='details.php?id=", $row['id'], "'><div class='projectimg'><img src=" . $row['image'], "></div> </a></li>";
    }

    ?>
</ul>
<?php
require 'includes/footer.php';
