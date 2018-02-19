<?php
ob_start();
if (session_status() == PHP_SESSION_NONE){
    session_start();
  }
$page_title = "Login";
$message = "Not registered? <a href='register.php'>Create an account</a>";
//variable for login status
$login_status ='';
if(isset($_SESSION['login_status'])){
  $login_status = $_SESSION['login_status'];
}

//check if login/register succeeded or failed
//Users last login attempt succeeded
if($login_status==1){
  $message= "<p>You are logged in as " . $_SESSION['login'] . ".</p>";
  echo  "<head><link type='text/css' rel='stylesheet' href='www/css/loginstyle.css' /></head>",
        "<body>",
        "<div class='login-page'><div class='form'>",
        "<a href='index.php'><img src='www/img/iupuilogo.gif' alt='Gallery' height='116' width='200'></a>",
        "<p class='message'>$message</p>",
        "<a href='index.php'><button type='submit'>Continue</button></a><br/>",
        "<h6 style='color:red'>You will be redirected in a few seconds..</h6>",
        "</div></div>",
        "</body>";
  header('Refresh: 2; URL=index.php');
  exit();
}

//Users just registered so log him in automatically
if($login_status==3){
  $message= "<p>Thank you for registering with us. You are logged in as " . $_SESSION['login'] . ".</p>";
  echo  "<head><link type='text/css' rel='stylesheet' href='www/css/loginstyle.css' /></head>",
        "<body>",
        "<div class='login-page'><div class='form'>",
        "<a href='index.php'><img src='www/img/iupuilogo.gif' alt='Gallery' height='116' width='200'></a>",
        "<p class='message'>$message</p>",
        "<a href='index.php'><button type='submit'>Continue</button></a>",
        "</div></div>",
        "</body>";
  header('Refresh: 2; URL=index.php');
  exit();
}

//Users login attempt failed
if($login_status==2){
  $message = "<strong style='color:red;'>Username or password invalid. Please try again.</strong><br/><br/>Not registered? <a href='register.php'>Create an account</a>";
}
 ob_end_flush();
?>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="www/css/loginstyle.css" />
    </head>
    <body>
        <div class="login-page">
          <div class="form">
            <form action="login_check.php" method="post">
              <a href="index.php"><img src="www/img/iupuilogo.gif" alt="Gallery" height="116" width="200"></a>
              <input type="text" name="username" placeholder="Username"/>
              <input type="password" name="password" placeholder="Password"/>
              <button type="submit">Login</button>
              <p class="message"><?php echo $message; ?></p>

            </form>
          </div>
        </div>
    </body>
</html>
