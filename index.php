<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jokes :: Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/main.css" />
    <!-- <script src="main.js"></script> -->
</head>
<body>
    <?php
        include("conn.php");

        $sql = "SELECT j.joketext, j.jokedate , a.name
                FROM joke j, author a
                WHERE j.idauthor = a.id";

        echo "<table>";
        if($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row['joketext']."</td></tr>";
            }
        }
        echo "</table>";
    ?>
</body>
</html>