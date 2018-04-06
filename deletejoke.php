<?php
  include("conn.php");

  $id = $_POST["id"];

  $sql = "DELETE FROM joke
          WHERE id = ".$id;
  if($result = $conn->query($sql)) {
    echo "string";
  }

  header("Location: account.php")
?>
