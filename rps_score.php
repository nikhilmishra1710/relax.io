<?php 
session_start();
echo $_SESSION['uname'];

$server="localhost";
$username="root";
$pwd="1234";
$db="practice";

$conn=mysqli_connect($server,$username,$pwd,$db);

if(!$conn){
    die("error".mysqli_error($conn));
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
        $uname=$_SESSION['uname'];
        $score=$_POST['winner'];
        echo $score;
        $query="CREATE TABLE IF NOT EXISTS RPS_SCORE(name varchar(100),winner varchar(20))";
        $result=mysqli_query($conn,$query);

        $query="INSERT INTO RPS_SCORE VALUES('$uname','$score')";
        $result=mysqli_query($conn,$query);
        header("Location: rock-paper-scissor.html");
}
?> 
