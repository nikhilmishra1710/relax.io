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
        $score=$_POST['score'];
        echo $score;
        $query="CREATE TABLE IF NOT EXISTS HANGMAN(name varchar(100),score varchar(20))";
        $result=mysqli_query($conn,$query);

        $query="INSERT INTO HANGMAN VALUES('$uname','$score')";
        $result=mysqli_query($conn,$query);
        
        header("Location: start.html");
}
?> 
