
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jokes :: Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="styles/account.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="styles/joketable.css"/>
    <!-- Material icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
    <div class="header">
      <?php include("header.php"); ?>
      <?php include("menu.php"); ?>
    </div>
    <div class="content" style="width:100%;text-align:center">
      <?php
        include("conn.php");

        $conn->query("SET NAMES 'utf8'");

        if(isset($_GET["action"]) && $_GET["action"] == "newAuthor") {
          if($_POST["name"] == "") $_POST["name"] = "Anonimo";
          $sql = "INSERT INTO author (name, email, idUtente)
                  VALUES ('".$_POST["name"]."', '".$_SESSION["emailUtente"]."', '".$_SESSION["idUtente"]."')";

          if($result = $conn->query($sql)) {
            echo "<p>".$sql."</p>";
          }

          header("Location: account.php");
        }

        if(isset($_SESSION["idUtente"])) {
          $sql = "SELECT id
                  FROM author a, users u
                  WHERE u.idUtente=".$_SESSION["idUtente"]."
                  AND u.email=a.email";

          if($result = $conn->query($sql)) {
            if($result->num_rows == 1) {

              //L'utente è un autore

              $sql = "SELECT id
                      FROM author
                      WHERE idUtente = ".$_SESSION["idUtente"];

              if($result = $conn->query($sql)) {
                $row = $result->fetch_assoc();
                $_SESSION["idAutore"] = $row["id"];
              }

              $sql = "SELECT j.id, j.joketext, j.jokedate , a.name, j.likeCounter, j.unlikeCounter
                      FROM joke j, author a
                      WHERE j.idauthor = a.id
                      AND a.idUtente = ".$_SESSION["idUtente"];

              if($result = $conn->query($sql)) {
                echo "<table class='jokestable'>
                      <tr><th>Barzellette di ".$_SESSION["nomeUtente"]." ".$_SESSION["cognomeUtente"];
                if($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      $newDate = date("d/m/Y", strtotime($row['jokedate']));

                      $row['joketext'] = str_replace("\n", "<br>", $row['joketext']);

                      // Creazione della scritta "Continua a leggere..." in caso di
                      //stringa troppo lunga
                      if(strlen($row['joketext']) >= 200) {
                        $row['joketext'] = substr($row['joketext'], 0, 200);
                        $row['joketext'] .= "...<br><a href='detail.php?id=".$row['id']."'>Continua a leggere</a> ";
                      }

                      echo "<tr>
                          <td style='border-left:5px solid rgb(".
                          rand(0,255).",".rand(0,255).",".rand(0,255).
                          ")'>
                          <p class='text'>".
                          $row['joketext'].
                          "</p>
                          <p class='author'>Creata il ". $newDate.
                          "</p><br>
                          <div class='jokeinfo'>
                          <div class='info float'>
                            <a href='detail.php?id=".
                            $row['id'].
                            "'>
                              <i class='fa fa-arrow-right'></i>
                            </a>
                          </div>

                          <button type='submit' name='action' value='".$row['id']."-unlike' class='floatWithText unlike'>
                            <i class='fa fa-thumbs-down my-float unlike'>
                            <span class='unlike'>".
                            $row['unlikeCounter'].
                            "</span>
                            </i>
                          </button>

                          <button type='submit' name='action' value='".$row['id']."-like' class='floatWithText like'>
                            <i class='fa fa-thumbs-up my-float like'>
                            <span class='like'>".
                            $row['likeCounter'].
                            "</span>
                            </i>
                          </button>

                          <!--<form action='editjoke.php' method='POST'>
                              <button type='submit' name='action' value='".$row['id']."' class='float edit'>
                                <i class='fa fa-edit my-float edit'></i>
                              </button>
                          </form>-->

                          <form action='deletejoke.php' method='POST'>
                              <button type='submit' name='id' value='".$row['id']."' class='float delete'>
                                <i class='fa fa-trash my-float delete'></i>
                              </button>
                          </form>

                          </div></td></tr><tr><td class='spacer'></td></tr>";
                  }
                  echo "</table>";
                }
                else {
                  echo "</table><p class='nojokes'>Non ci sono barzellette</p>";
                }
                echo "<div class='floatButton'>
                        <form action='newjoke.php' method='post'>
                          <button type='submit' name='button'>
                            <i class='fa fa-plus'></i>
                          </button>
                        </form>
                      </div>";
              }
            }
            else {
      ?>
        <div class="newAuthor">
          <h2>Diventa un autore</h2>
          <form action="<?php $_SERVER["PHP_SELF"] ?>?action=newAuthor" method="post">
            Nome <input type="text" name="name" value="<?php echo $_SESSION["cognomeUtente"]." ".$_SESSION["nomeUtente"] ?>"><br>
            <p><i>(Questo è il nome che verrà visualizzato insieme alla barzelletta, lasciare vuoto se si vuole essere anonimi)</i></p>
            <input type="submit" name="submit" value="INVIA">
          </form>
        </div>
      <?php
            }
          }
        }
        else {
          header("Location: login.php");
        }
      ?>
    </div>
    <div class="footer">
      <?php include("footer.php"); ?>
    </div>
</body>
</html>
