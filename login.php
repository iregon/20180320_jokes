<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jokes :: Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="styles/login.css"/>
    <!-- Material icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body onload="loadAuthors()">
    <div class="header">
        <?php include("header.php"); ?>
        <?php include("menu.php"); ?>
    </div>
    <div class="content" style="width:100%;text-align:center">
      <h2>Login</h2>
      <?php
        include("conn.php");
        if($_POST) {
          if(isset($_POST["email"]) && isset($_POST["pass"])) {
            $pass = hash("sha256", $_POST["pass"], false);
            $sql = "SELECT *
                    FROM users
                    WHERE email='".$_POST["email"]."'
                    AND pass='".$pass."'";

            if($result = $conn->query($sql)) {
              if($result->num_rows == 1) {
                $info = $result->fetch_array();
                $_SESSION["idUtente"] = $info["idUtente"];
                $_SESSION["nomeUtente"] = $info["nome"];
                $_SESSION["cognomeUtente"] = $info["cognome"];
                $_SESSION["emailUtente"] = $info["email"];
                // echo $info["idUtente"]." - Login effettuato";
                header("Location: account.php");
              }
              else if ($result->num_rows > 1) {
                echo "<p class='error_msg'>ERRORE: risultati multipli</p>";
              }
              else {
                echo "<p class='error_msg'>E-mail e/o password errati</p>";
              }
            }
            else {
              echo "<p class='error_msg'>ERRORE: impossibile contattare il database</p>";
            }
          }
          else {
            echo "<p class='error_msg'>ERRORE: campi necessari non ricevuti</p>";
          }
        }
      ?>
      <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
        E-mail<input type="text" name="email"><br>
        Password<input type="password" name="pass"><br>
        <input type="submit" name="submit" value="ENTRA">
      </form>
    </div>
    <div class="footer">
      <?php include("footer.php"); ?>
    </div>
</body>
</html>
