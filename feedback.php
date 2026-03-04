<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "practice";
 
// Create connection
$conn = new mysqli($servername,$username, $password, $dbname);
 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: "
        . $conn->connect_error);
}

$sqlquery="CREATE TABLE IF NOT EXISTS feedback (GAME_RATING INT,INTERFACE INT,OVERALL INT,COMMENT VARCHAR(1024));";
$conn->query($sqlquery);




$grate=$_POST["game-rating"];
$inter=$_POST["interface"];
$over=$_POST["overall"];
$comment=$_POST["comments"];


$sqlquery = "INSERT INTO feedback VALUES('$grate','$inter','$over','$comment');";
    
if($conn->query($sqlquery) === TRUE) {
    header("Location: start.html");
    exit();
} else {
    echo "Error: " . $sqlquery . "<br>" . $conn->error;
}
?>