<?php
if (session_status() == PHP_SESSION_NONE){
    session_start();
}
//create variable to store number of favorites in cart
$count=0;

//retrieve cart content
if(isset($_SESSION['cart'])){
  $cart = $_SESSION['cart'];

  if($cart){
      $count = array_sum($cart);
  }
}

//set shopping cart image
$shoppingcart_img = (!$count) ? "shoppingcart_empty.gif" : "shoppingcart_full.gif";

//variables for a users login, name, and role
if(isset($_SESSION['login']) AND isset($_SESSION['name']) AND isset($_SESSION['role'])){
  $login = $_SESSION['login'];
  $name = $_SESSION['name'];
  $role = $_SESSION['role'];
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" rel="stylesheet" href="www/css/style.css" />
        <script src="https://use.fontawesome.com/d9f31559e3.js"></script>
        <title><?php echo $page_title; ?></title>
    </head>
    <body>
      <div class="header">
        <nav class="shift">
          <a href="#" id="menu-icon"></a>
          <ul class="navul">
            <li><a href="index.php" class="navlogo"><img src="www/img/trident-large.png" alt="Gallery" width="44px;">Home</a></li>
            <li><a href="projects.php">Gallery</a></li>
            <li><a href="search.php">Search</a></li>
            <?php
                if($role == 1 OR $role == 2){
                  echo "<li><a href='upload.php'>Upload</a></li>";
                }
                if(empty($login)){
                  echo "<li><a href='login.php'>Login/Register</a></li>";
                }
                else{
                  echo "<li><a href='logout.php'>Log Out</a></li>";
                }
                 ?>
          </ul>
        </nav>
      </div>
        <div id="wrapper">
            <table id="banner" class="full-width">
                <tr>
                    <td>
                        <a href="index.php" alt="Home Page"><img src="www/img/trident-large.png" alt="Gallery"></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="maintitle">
                          <span data-shadow-text="MAS STUDENT WORK">MAS STUDENT WORK</span>
                          </div>
                        <div id="subtitle">View classmate's artwork or upload your own.</div>
                        <?php
                        if($role == 1 OR $role == 2){
                  echo "<div class='user project-button'><a href='favorites.php'><input type='button' value='Hey, $name!'></a></div>";
                }
                        ?>
                    <!--<hr class="style-two">-->
                    </td>
                    

                </tr>
            </table>
            <!-- main content body starts -->
            <div id="mainbody">
