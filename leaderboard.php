
<?php
session_start();
$i=0;
$server="localhost";
$username="root";
$pwd="1234";
$db="practice";

$conn=mysqli_connect($server,$username,$pwd,$db);

if(!$conn){
    die("error".mysqli_error($conn));
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $game=$_POST['game'];
    if($game=="Memory game"){
        $query="SELECT * FROM MEMORY;";
        $result=mysqli_query($conn,$query);
        
        echo "<table border=5 cellpadding=5>
        <tr>
        <th>NAME</th><th>FLIPS</th><th>TIME</th></tr>";
        while($i=mysqli_fetch_assoc($result)){
            echo "<tr>
            <td>".$i['name']."</td><td>".$i['flips']."</td><td>".$i['time']."</td></tr>";
        }echo "</table>";
    }
    if($game=="Hangman"){
        $query="SELECT * FROM HANGMAN;";
        $result=mysqli_query($conn,$query);
        
        echo "<table border=5 cellpadding=5>
        <tr>
        <th>NAME</th><th>SCORE</th></tr>";
        while($i=mysqli_fetch_assoc($result)){
            echo "<tr>
            <td>".$i['name']."</td><td>".$i['score']."</td></tr>";
        }echo "</table>";
    }
    if($game=="RPS"){
        $query="SELECT * FROM RPS_SCORE;";
        $result=mysqli_query($conn,$query);
        
        echo "<table border=5 cellpadding=5>
        <tr>
        <th>NAME</th><th>WINNER</th></tr>";
        while($i=mysqli_fetch_assoc($result)){
            echo "<tr>
            <td>".$i['name']."</td><td>".$i['winner']."</td></tr>";
        }
        echo "</table>";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            overflow: hidden;
            background: linear-gradient(120deg,rgb(119, 237, 8),rgb(29, 132, 228));
        }
        table{
            position: absolute;
            top: 10%;
            left: 50%;
            font-size: 3em;
            padding: 20px;
            border: 5px dotted blue;
            text-align: center;
        }

        .select-game{
            position: absolute;
            top: 10%;
            left: 10%;
            display: flex;
            flex-direction: column;
        }

        h1{
            font-size: 3em;
        }

        select{
            border: none;
            border-bottom: 2px solid orange;
            background: rgba(255,255,255,0.7);
            font-size: 2em;
        }
    </style>
</head>
<body>
<div style="position: fixed; top: 20px;right: 30px" class="home">
            <button class="homebutton"><a href="start.html"><img src="tic-tac-toe/home.svg" alt="home icon" height="60px" width="40px"></a></button>
        </div>
    <h1>GAME LOG</h1>
    <div class="select-game">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post"> 
        <select id="game" oninput="check()" name="game">
            <option value="None" selected disabled hidden>Select the game</option>
            <option value="Memory game">Think and link</option>
            <option value="Hangman">Hangman</option>
            <option value="RPS">Rock Paper Scissors</option>
        </select>
        <button type="submit" disabled id="btn" value="submit" name="submit">SHOW LOG</button>
</form>
    </div>
    <script>
        function check(){
            if(document.getElementById('game').value!=="None"){
                document.getElementById("btn").disabled=false
            }else{
                document.getElementById("btn").disabled=true
            }
        }
    </script>
</body>
</html>