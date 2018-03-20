<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jokes :: Categoria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="styles/category.css"/>
  </head>
  <body>
    <div class="header">
        <div class="img">
            <p>Jokes</p>
        </div>
        <div id="navbar">
            <ul class="navbar">
                <li><a class="active" href="#home">Home</a></li>
                <li><a href="#news">News</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="#about">About</a></li>
            </ul>
        </div>
    </div>
    <div class="sidebar">
        <table class="categoriestable">
            <tr><td class="categoriestitle">Categorie</td></tr>
            <?php
                include("conn.php");

                $sql = "SELECT name
                        FROM category";

                if($result = $conn->query($sql)) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row['name']."</td></tr>";
                    }
                }
            ?>
        </table>
    </div>
    <div class="content">
        <table class="jokestable">
        <?php
            $sql = "SELECT j.joketext, j.jokedate , a.name
                    FROM joke j, author a, jokecategory jc, category c
                    WHERE c.name = '".$_GET["category"]."'
                    AND j.idauthor = a.id
                    AND j.id = jc.jokeid
                    AND jc.categoryid = c.id";

            if($result = $conn->query($sql)) {
                while ($row = $result->fetch_assoc()) {
                    $newDate = date("d-m-Y", strtotime($row['jokedate']));

                    echo "<tr><td style='border-left:5px solid rgb(".
                        rand(0,255).",".rand(0,255).",".rand(0,255).
                        ")'><p class='text'>".
                        $row['joketext'].
                        "</p><br><p class='author'>Creata da ".
                        $row['name']." il ". $newDate.
                        "</p></td></tr>";
                }
            }
        ?>
        </table>
    </div>
    <div class="footer"></div>
  </body>
</html>
