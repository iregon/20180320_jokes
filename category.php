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
    <!-- Material icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="header">
        <div class="img">
            <p>Jokes</p>
        </div>
        <div id="navbar">
            <ul class="navbar">
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="#news">News</a></li>
                <li class="singup"><a href="#about">Registrati</a></li>
                <li class="login"><a href="#contact">Login</a></li>
            </ul>
        </div>
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
                        echo "<tr><td><a href='category.php?category=".
                          $row['name']."'>".
                          $row['name'].
                          "</a></td></tr>";
                    }
                }
            ?>
        </table>
    </div>
    <div class="content">
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

                        <form action='".$_SERVER["PHP_SELF"]."' method='POST'>
                            <button type='submit' name='action' value='".$row['id']."-unlike' class='floatWithText unlike'>
                              <i class='fa fa-thumbs-down my-float unlike'>
                              <span class='unlike'>".
                              $row['unlikeCounter'].
                              "</span>
                              </i>
                            </button>
                        </form>

                        <form action='".$_SERVER["PHP_SELF"]."' method='POST'>
                            <button type='submit' name='action' value='".$row['id']."-like' class='floatWithText like'>
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
    <div class="footer">dasffgjdh</div>
  </body>
</html>
