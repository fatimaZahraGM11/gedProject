<?php
if (isset($_GET["id"]) ) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "gedproject";

    //Create connection
    $connection = new mysqli( $servername, $username , $password , $database);

    $sql ="DELETE FROM clients WHERE id=$id";
    $connection->query($sql);


    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
}
}
header("location: /SAFAEPHP/index.php");
 exit;  

 
    ?>