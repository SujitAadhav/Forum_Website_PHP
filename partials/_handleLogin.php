<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
    include '_dbconnect.php';
    $login = false;
    $showErr = false;
    $exists = false;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE `user_name` = '$username'";
    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

    if($num==1){
        while($row=mysqli_fetch_assoc($result)){
            if(password_verify($password, $row['password'])){
                $username = $row['user_name'];
                $user_id = $row['user_id'];
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['userid'] = $user_id;
                header('location: /forum/index.php');
            }
            else{
                $showErr = "Invalid Credentials";
            }
        }
    }
    else{
        $exists = "Duplicate username";
    }
}

?>