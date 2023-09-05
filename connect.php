<?php
$username ="root";
$servername="localhost";
$password = "";
$dbName="D_kiganjani";

$conn =  mysqli_connect($servername, $username, $password, $dbName);

if(!$conn){
    echo "Connection failed";
}


?>