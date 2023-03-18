<?php
$showAlert = false;
$signup = 'false';
$showErr = false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    include '_dbconnect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if($password==$cpassword){
        // check whether user name exists
        $existsSql = "SELECT * FROM `users` WHERE `user_name` = '$username'";
        $result = mysqli_query($conn, $existsSql);
        $num = mysqli_num_rows($result);
        if($num>0){
            $showErr = "Email already in use.";
            header('location: /forum/index.php');
        }
        else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_name`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = "Your account has been created successfully.";
                header('location: /forum/index.php?signupsuccess=true');
            }
            else{
                $showErr = "Your account is not created. Please try again!";
                header('location: /forum/index.php?signupsuccess='.$signup.'');
            }
        }
    }
    else{
        $showAlert = "Passwords do not match";
    }
}

?>