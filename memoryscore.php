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
        $score=$_POST['flips'];
        $time=$_POST['time'];
        echo $score.$time;
        $query="CREATE TABLE IF NOT EXISTS MEMORY(name varchar(100),flips int,time int)";
        $result=mysqli_query($conn,$query);

        $query="INSERT INTO MEMORY VALUES('$uname','$score','$time')";
        $result=mysqli_query($conn,$query);
        
        header("Location: start.html");
}
?> 
