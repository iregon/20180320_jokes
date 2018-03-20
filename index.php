<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jokes :: Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="styles/home.css"/>
    <!-- <script src="main.js"></script> -->
</head>
<body>
    <div class="header"></div>
    <div class="sidebar">
        <table class="categoriestable">
            <tr><th>Categorie</th></tr>
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
                    echo "<tr><td>".$row['joketext']."</td></tr>";
                }
            }
        ?>
        </table>
    </div>
    <div class="footer"></div>
</body>
</html>