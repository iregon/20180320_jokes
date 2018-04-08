
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jokes :: Nuova barzelletta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="styles/login.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="styles/newjoke.css"/>
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
      <?php
        if(!isset($_SESSION["idUtente"])) {
          header("Location: login.php");
        }
      ?>
      <h2>Nuova barzelletta</h2>
      <?php
        include("conn.php");
        if(isset($_POST["text"])) {
          $text = htmlspecialchars($_POST["text"], ENT_QUOTES, "UTF-8");
          $sql = "INSERT INTO joke (joketext, jokedate, idauthor, likeCounter, unlikeCounter)
                  VALUES ('".$text."', NOW(), ".$_SESSION["idAutore"].", 0, 0)";

          if($result = $conn->query($sql)) {
            echo "joke aggiunta";
            $sql = "SELECT id
                    FROM joke
                    WHERE joketext = '".$text."'";

            if($result = $conn->query($sql)) {
              echo "id prelevato";
              $jokeid = $result->fetch_assoc()["id"];
              $categoryid = $_POST["category"];
              $sql = "INSERT INTO jokecategory (jokeid, categoryid)
                      VALUES (".$jokeid.", ".$categoryid.")";
              if($result = $conn->query($sql)) {
                header("Location: account.php");
              }
            }
          }
          else {
            echo "<p class='error_msg'>ERRORE: impossibile contattare il database</p>";
          }
        }
      ?>
      <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
        Testo della barzelletta<br>
        <textarea rows="4" cols="50" name="text" placeholder="Inserisci qui il testo della barzelletta..." required></textarea><br>
        Categoria <select name="category">
          <?php
            $sql = "SELECT id, name
                  FROM category
                  ORDER BY name";

            if($result = $conn->query($sql)) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
                }
            }
          ?>
        </select><br>
        <input type="submit" name="submit" value="INVIA">
      </form>
    </div>
    <div class="footer">
      <?php include("footer.php"); ?>
    </div>
</body>
</html>
