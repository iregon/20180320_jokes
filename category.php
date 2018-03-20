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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
                <li><a href="#contact">Contact</a></li>
                <li><a href="#about">About</a></li>
            </ul>
        </div>
    </div>
    <div class="sidebar">
        <table class="categoriestable">
            <tr><td class="categoriestitle">Barzellette su...</td></tr>
            <?php
                include("conn.php");
                header("Content-Type: text/html;charset=utf-8");

                $conn->query("SET NAMES 'utf8'");

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
            $sql = "SELECT j.id, j.joketext, j.jokedate , a.name, j.like, j.unlike
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
                        rand(50,255).",".rand(50,255).",".rand(50,255).
                        ")'>
                        <p class='text'>".
                        str_replace("\n", "<br>", $row['joketext']).
                        "</p>
                        <p class='author'>Creata da ".
                        $row['name']." il ". $newDate.
                        "</p><br>
                        <div class='jokeinfo'>
                        <div class='info'>
                        <a href='detail.php?id=".
                        $row['id'].
                        "'><i class='material-icons'>&#xE5C8;</i></a>
                        </div>
                        <span class='unlike'>".
                        $row['unlike'].
                        "</span>
                        <img src='img/unlike.png' class='unlike'>
                        <span class='like'>".
                        $row['like'].
                        "</span>
                        <img src='img/like.png' class='like'>
                        </div></td></tr><tr><td class='spacer'></td></tr>";
                }
            }
        ?>
        </table>
    </div>
    <div class="footer"></div>
  </body>
</html>
