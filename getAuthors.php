<?php
  include("conn.php");

  /*Suggestion for the autors*/
  $sugg = $_GET["sugg"];

  $conn->query("SET NAMES 'utf8'");

  $sql = "SELECT name
          FROM author
          WHERE name LIKE '%".$sugg."%'";

  $result = $conn->query($sql);

  $options = array();
  while($data = mysqli_fetch_array($result)) {
    array_push($options, $data['name']);
  }

  echo json_encode($options);
?>
