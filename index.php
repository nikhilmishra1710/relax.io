<?php
session_start();
if($_SESSION['bad'])  echo "<script>alert('Bad credentials')</script>";
if($_SESSION['wrong'])  echo "<script>alert('Some error occured try again')</script>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Quicksand';
        }
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #000;
        }
        section{
            position: absolute;
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2px;
            flex-wrap: wrap;
            overflow: hidden;
        }
        section::before{
            content:' ';
            position: absolute;
            top: -10%;
            width: 100%;
            height: 20%;
            box-shadow: 
            inset -10px 0 50px rgba(0,0,0,1),
            inset 10px 0 50px rgba(0,0,0,1),
            inset -10px 0 10px rgba(255,255,255,0.25),
            inset 10px 0 10px rgba(255,255,255,0.25),
            0 0 50px rgba(0,0,0,1);
            background-image: linear-gradient(120deg,green,aqua);
            animation: animate 10s linear infinite;
        }
        @keyframes animate{
            0%{
                top: -10%;
            }
            100%{
                top: 100%;
            }
        }
        section span{
            position: relative;
            display: block;
            width: calc(6.25vw - 2px);
            height: calc(6.25vw - 2px);
            background: #181818;
            z-index: 2;
            transition: 1.5s;
        }
        section span:hover{
            background: #0f0;
            transition: 0s;
        }
         .container{
            position: absolute;
            width: 400px;
            background: #222;
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            border-radius: 4px;
            box-shadow: 0 15px 35px;
            transition: 2s cubic-bezier(0.075, 0.82, 0.165, 1);
        }
         .container .content{
            position: relative;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 40px;
        }
         .container .content h2{
            font-size:2em;
            color:#0f0;
            text-transform: uppercase;
        }
         .container .content .form{
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 25px;
        }
         .container .content .form .inputBox{
            position: relative;
            width: 100%;
        }
         .container .content .form .inputBox input{
            position: relative;
            width: 100%;
            background: #333;
            border: none;
            outline: none;
            padding: 25px 10px 7.5px;
            border-radius: 4px;
            color: #fff;
            font-weight: 500;
            font-size: 1em;
        }
         .container .content .form .inputBox i{
            position: absolute;
            left: 0;
            padding: 15px 10px;
            font-style: normal;
            color: #aaa;
            transition: 0.5s;
            pointer-events: none;
        }

        .container .content .form .inputBox input:focus~i,
        .container .content .form .inputBox input:valid~i{
            transform: translateY(-7.5px);
            font-size: 0.8em;
            color: #fff;
        }
        .container .content .form .links{
            position: relative;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        .container .content .form .links a{
            color: #fff;
            text-decoration: none;
        }
        .container .content .form .links a:nth-child(2){
            color: #0f0;
            font-weight: 600;
        }
         .container .content .form .inputBox input[type="submit"]{
           padding: 10px;
           background: #0f0;
           color: #000;
           font-weight: 600;
           font-size: 1.35em;

        }
        p{
            color: #0f0;
        }
    </style>
</head>
<body>
    <section class="bg">
        
    </section>
    <div class="container signup">
        <div class="content">
            <h2>LogIn</h2>
            <form class="form" action="login-signup.php" method="POST">
                <div class="inputBox">
                    <input name='uname' type="text" required>
                    <i>Username</i>
                </div>
                <div class="inputBox">
                    <input name='pwd' type="password" required>
                    <i>Password</i>
                </div>
                <div class="links">
                    <p>New here? Signup first</p>zz
                    <a onclick="change()">Signup</a>
                </div>
                <div class="inputBox">
                    <input type="submit" name="login" value="login">
                </div>
            </form>
        </div>
    </div>
    <div class="container login">
        <div class="content">
            <h2>Sign Up</h2>
            <form class="form" name="signup" method="post" action="./login-signup.php" onsubmit='return validateform()' >
                <div class="inputBox">
                    <input name="name" id="name" type="text" required>
                    <i>Your name</i>
                </div>
                <div class="inputBox">
                    <input name="email_id" id="email_id" type="email" required>
                    <i>Email</i>
                </div>
                <div class="inputBox">
                    <input name="uname" id="uname" type="text" required>
                    <i>Username</i>
                </div>
                <div class="inputBox">
                    <input name="pwd" id="pwd" type="password" required>
                    <i>Password</i>
                </div>
                <div class="inputBox">
                    <input name="cpwd" id="cpwd" type="password" required>
                    <i>Confirm Password</i>
                </div>
                <div class="links">
                    <p>Have an account? Login</p>zz
                    <a onclick="change()">Login</a>
                </div>
                <div class="inputBox">
                    <input type="submit" name="signup" value="signup">
                </div>
            </form>
        </div>
    </div>
    <script>
        window.onload=func();
        function func(){
            const sect=document.querySelector('.bg');
            var i;
            for(i=0;i<260;i++){
                sect.innerHTML='<span></span>'+sect.innerHTML;
            }
        }
        var toggle=true
        function change(){
            if(toggle){
                document.querySelector('.login').style="opacity:0;z-index:-1;"
                document.querySelector('.signup').style="opacity:1;zindex: 1"
                toggle=false
            }else{
                document.querySelector('.login').style="opacity:1;zindex: 1"
                document.querySelector('.signup').style="opacity:0;z-index:-1;"
                toggle=true    
            }
        }
        let name=/^[a-z A-Z]+$/i
        let num=/^[0-9]+$/i
        let alphanum=/^[a-zA-Z0-9]+$/i
        function validateform(){
                let fname=document.signup.name.value
                let uname=document.signup.uname.value
                let email=document.signup.email_id.value
                let pwd=document.signup.pwd.value
                let cpwd=document.signup.cpwd.value
                
                if(fname.length===0|| !name.test(fname)){
                    alert("invalid name");
                    return false
                }
                if(uname.length===0 || !alphanum.test(uname)){
                    alert("invalid username")
                    return false
                }
                if(email.length===0 || email.indexOf('@')<1 || email.indexOf(".")<email.indexOf('@') || email.indexOf(".")+2>=email.length){
                    alert("Enter a valid email id");
                    return false
                }
                if(pwd.length===0 || !alphanum.test(pwd) || pwd.length<6 || pwd.length>15){
                    alert("Enter a valid password of 6-15 alphanumeric characters")
                    return false
                }
                if(cpwd!==pwd){
                    alert("Password do not match")
                    return false
                }
                return true
        }

    </script>
</body>
</html>