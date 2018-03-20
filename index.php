<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta http-equiv="Content-Type" content="text/HTML; charset=ISO-8859-1" />   -->
    <title>Jokes :: Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="styles/home.css"/>
    <!-- <script src="main.js"></script> -->
</head>
<body>
    <div class="header">
        <div class="img">
            Jokes
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
                    FROM joke j, author a
                    WHERE j.idauthor = a.id";

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