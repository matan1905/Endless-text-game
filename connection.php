<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="infiniteadventure";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function newNode($pid,$action,$desc,$state,$conn){
$sql = "INSERT INTO node(pid , action , outcome , state) VALUES ($pid,'$action','$desc','$state');
";

return $conn->query($sql);

}











?>