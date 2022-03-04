<?php
session_start();

    include("connection.php");
    include("functions.php");

 
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {

            //save to database 
            $user_id = random_num(20);
            $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

            mysqli_query($con, $query);

            header("Location: login.php");
            die;

        }else
        {
            echo "Please enter some valid information!"; 
        }
    }

?> 


<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>

<style type="text/css">

    #text{

        height: 25px;
        border-radius: 5px;
        padding: 4px;
        border: solid thin #aaa;
        width: 100%;
    }

    #button{

        padding: 10px;
        width: 100px;
        color: black;
        background-color: lightblue;
        border: none;
    }

    #box{

        background-color: lightgrey;
        margin: auto;
        width: 300px;
        padding: 20px;
        border:  14px ridge #0c107a;
    }

</style>
<center>
<img src="https://play-lh.googleusercontent.com/vO2ZhuemEOzb7aKeJ2UWGKQdDp48VbXwLtmXQibhPvv92-NcRtCqdKjPtW0TPxV3JQ" width="450" height="200" />
</center>

<div id="box">

    <form method="post">
       <center> <div style="font-size: 20px;margin: 10px;color: Black;">Signup</div></center>

        <input id="text" type="text" name="user_name" required><br><br>
        <input id="text" type="password" name="password" required><br><br>

       <center> <input id="button" type="submit" value="Signup"><br><br></center>

        <a href="login.php">Click to Login</a><br><br>
    </form>

</div>

</body>
</html>
