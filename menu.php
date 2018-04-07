<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
    <div id="navbar">
        <ul class="navbar">
            <li><a class="active" href="index.php">Home</a></li>
            <!-- <li><a href="#news">News</a></li> -->
            <?php
              session_start();
              if(isset($_SESSION["idUtente"])) {
                echo "<li class='login'><a href='logout.php'>Esci</a></li>
                      <li class='login'><a href='account.php'>Account</a></li>";
              }
              else {
                echo "<li class='singup'><a href='register.php'>Registrati</a></li>
                      <li class='login'><a href='login.php'>Login</a></li>";
              }
            ?>
        </ul>
    </div>
  </body>
</html>
