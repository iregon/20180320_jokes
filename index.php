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
    <!-- Material icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script type="text/javascript">
      function loadAuthors() {
        var dataList = document.getElementById('json-datalist');

        // Clean datalist options
        dataList.innerHTML = "";

        var sugg = document.getElementById("author").value;
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
<body onload="loadAuthors()">
    <div class="header">
        <div class="img">
            <p>Jokes</p>
        </div>
        <div id="navbar">
            <ul class="navbar">
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="#news">News</a></li>
                <li class="singup"><a href="register.php">Registrati</a></li>
                <li class="login"><a href="login.php">Login</a></li>
                <li class="searchbar">
                    <form action="">
                        <input type="text" placeholder="Cerca un autore"
                          id="author" list="json-datalist">
                        <datalist id="json-datalist"></datalist>
                    </form>
                </li>
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
    <div class="footer">
      <p>Testo a caso nel footer</p>
    </div>
</body>
</html>
