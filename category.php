<?php
  include("conn.php");
  if($_POST) {

    $info = explode("-", $_POST["action"]);

    if(empty($_COOKIE["counter_like"])) {
      setcookie("counter_like", "", 0, "/");
      // echo "Cookie creato";
    }

    $id_list = explode("-", $_COOKIE["counter_like"], -1);

    $is_break = false;
    foreach ($id_list as $id) {
        if($info[0] == $id) {
            $is_break = true;
            break;
        }
    }

    if(!$is_break) {
      $cookie = $_COOKIE["counter_like"];
      setcookie("counter_like", $cookie.$info[0]."-", 0, "/");

      if($info[1] == 'like')
      {
        echo "string";
          $update = "likeCounter=likeCounter+1";
      }
      if($info[1] == 'unlike')
      {
        echo "string";
          $update = "unlikeCounter=unlikeCounter+1";
      }

      $query = "UPDATE joke SET ".$update." WHERE id=".$info[0];

      $result = $conn->query($query);

      header("Location: ".$_SERVER["PHP_SELF"]."?category=".$info[2]);
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Jokes :: Categoria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="styles/joketable.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="styles/category.css"/>
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
    <div class="sidebar">
        <table class="categoriestable">
            <tr><td class="categoriestitle">Barzellette su...</td></tr>
            <?php
                include("conn.php");

                $sql = "SELECT name
                        FROM category";

                if($result = $conn->query($sql)) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td class='categoriesname'><a href='category.php?category=".
                          $row['name']."'>".
                          $row['name'].
                          "</a></td></tr>";
                    }
                }
            ?>
        </table>
    </div>
    <div class="content">
        <h2 class="categoryname"><?php echo $_GET["category"]; ?></h2>
        <table class="jokestable">
        <?php

            $sql = "SELECT j.id, j.joketext, j.jokedate , a.name, j.likeCounter, j.unlikeCounter
                    FROM joke j, author a, jokecategory jc, category c
                    WHERE c.name = '".$_GET["category"]."'
                    AND j.idauthor = a.id
                    AND j.id = jc.jokeid
                    AND jc.categoryid = c.id";

            if($result = $conn->query($sql)) {
                while ($row = $result->fetch_assoc()) {
                    $newDate = date("d-m-Y", strtotime($row['jokedate']));

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
                        <p class='author'>Creata da ".
                        $row['name']." il ". $newDate.
                        "</p><br>
                        <div class='jokeinfo'>
                        <div class='info float'>
                          <a href='detail.php?id=".
                          $row['id'].
                          "'>
                            <i class='fa fa-arrow-right'></i>
                          </a>
                        </div>

                        <form action='".$_SERVER["PHP_SELF"]."?category=".$_GET["category"]."' method='POST'>
                            <button type='submit' name='action' value='".$row['id']."-unlike-".$_GET["category"]."' class='floatWithText unlike'>
                              <i class='fa fa-thumbs-down my-float unlike'>
                              <span class='unlike'>".
                              $row['unlikeCounter'].
                              "</span>
                              </i>
                            </button>
                        </form>

                        <form action='".$_SERVER["PHP_SELF"]."?category=".$_GET["category"]."' method='POST'>
                            <button type='submit' name='action' value='".$row['id']."-like-".$_GET["category"]."' class='floatWithText like'>
                              <i class='fa fa-thumbs-up my-float like'>
                              <span class='like'>".
                              $row['likeCounter'].
                              "</span>
                              </i>
                            </button>
                        </form>
                        </div></td></tr><tr><td class='spacer'></td></tr>";
                }
            }
        ?>
        </table>
    </div>
    <div class="footer">
      <?php include("footer.php"); ?>
    </div>
  </body>
</html>
