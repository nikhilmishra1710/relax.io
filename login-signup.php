<?php
session_start();
$server="localhost";
$username="root";
$pwd="1234";
$db="practice";

$conn=mysqli_connect($server,$username,$pwd,$db);

if(!$conn){
    die("error".mysqli_error($conn));
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['login'])){
        echo "login";
        $uname=$_POST['uname'];
        $pwd=$_POST['pwd'];
        $query="SELECT * FROM LOGIN WHERE username='$uname' AND password='$pwd';";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result)>0){
            $_SESSION['uname']=$uname;
            header("Location: start.html");
        }else{
            $_SESSION['bad']=1;
            echo "<script>alert('Bad credentials')</script>";
            header("Location: index.php");
        }
    }
    else{
        echo "signup";
        $name=$_POST['name'];
        $uname=$_POST['uname'];
        $pwd=$_POST['pwd'];
        $email=$_POST['email_id'];

        $query="CREATE TABLE IF NOT EXISTS LOGIN(name varchar(100),username varchar(100),email varchar(100),password varchar(15));";
        $result=mysqli_query($conn,$query);

        $query="INSERT INTO LOGIN VALUES('$name','$uname','$email','$pwd')";
        $result=mysqli_query($conn,$query);
        
        
        if(($result)){
            $_SESSION['uname']=$uname;
            header("Location: start.html");
        }else{

            echo "<script>alert('Some error occured. Try again later')</script>";
            header("Location: index.php");
        }
    }
}
?>