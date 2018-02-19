<html>
    <head>
        <link type="text/css" rel="stylesheet" href="www/css/loginstyle.css" />
    </head>
    <body>
        <div class="login-page">
          <div class="form">
              <form action="register_check.php" method="post">
              <a href="index.php"><img src="www/img/iupuilogo.gif" alt="Gallery" height="116" width="200"></a>
              <input type="text" name="firstname" placeholder="First Name" required/>
              <input type="text" name="lastname" placeholder="Last Name" required/>
              <input type="text" name="username" placeholder="Username" required/>
              <input type="password" name="password" placeholder="Password" required/>
              <button>create</button>
              <p class="message">Already registered? <a href="login.php">Sign In</a></p>
            </form>
          </div>
        </div>
    </body>
</html>
