<?php
    $servername = "localhost";
	$username = "root";
    $password = "";
    $dbname = "joketables";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error)
    {
    	die("connessione fallita: ".$conn->connect_error);
    }

    $conn->query("SET NAMES 'utf8'");
?>
