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

      header("Location: ".$_SERVER["PHP_SELF"]);
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jokes :: Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/main.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="styles/joketable.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <script type="text/javascript">
      function loadAuthors() {
        var dataList = document.getElementById('json-datalist');

        // Clean datalist options
        dataList.innerHTML = "";
        
        var sugg = document.getElementById("autocomplete").value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var jsonOptions = JSON.parse(this.responseText);

            jsonOptions.forEach(function(item) {
              // Create a new <option> element.
              var option = document.createElement('option');
              // Set the value using the item in the JSON array.
              option.value = item;
              // Add the <option> element to the <datalist>.
              dataList.appendChild(option);
            });
            // $( "#autocomplete" ).autocomplete({
            //   source: [ "c++", "java", "php", "coldfusion", "javascript", "asp", "ruby" ]
            // });
          }
        };

        // console.log("getAuthors.php?sugg=" + sugg);
        xhttp.open("GET", "getAuthors.php?sugg=" + sugg, true);
        xhttp.send();
      }
    </script>
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
                <li class="searchbar">
                  <input type="text" placeholder="Cerca un autore"
                    id="autocomplete" onkeyup="loadAuthors()"
                    list="json-datalist">
                </li>
                <datalist id="json-datalist">

                </datalist>
            </ul>
        </div>
    </div>
    <div class="sidebar">
      <p id="demo"></p>
        <table class="categoriestable">
            <tr><td class="categoriestitle">Barzellette su...</td></tr>
            <?php
                include("conn.php");
                // header("Content-Type: text/html;charset=utf-8");

                $conn->query("SET NAMES 'utf8'");

                $sql = "SELECT name
                        FROM category
                        ORDER BY name";

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
                    FROM joke j, author a
                    WHERE j.idauthor = a.id";

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
                        $row['unlikeCounter'].
                        "</span>
                        <form action='".$_SERVER["PHP_SELF"]."' method='POST'>
                            <button type='submit' name='action' value='".$row['id']."-unlike'><img src='img/unlike.png' class='unlike'></button>
                        </form>
                        <span class='like'>".
                        $row['likeCounter'].
                        "</span>
                        <form action='".$_SERVER["PHP_SELF"]."' method='POST'>
                            <button type='submit' name='action' value='".$row['id']."-like'><img src='img/like.png' class='like'></button>
                        </form>
                        </div></td></tr><tr><td class='spacer'></td></tr>";
                }
            }
        ?>
        </table>
    </div>
    <div class="footer">
      <p>Testo a caso nel footer</p>
    </div>
</body>
</html>
