<?php

if ( isset($_POST['signup']) ) {

    include_once 'connect.php';

    $num = $_POST['num'];
    $email = $_POST['email'];
    $password = $_POST['password'] ;
    $rePassword = $_POST['re-password'];

    $pattern = '/^[A-Z]{1,2}[0-9]{5,6}$/';
    $req = "SELECT * FROM patient WHERE num = '$num'";
    $result = mysqli_query($cnx, $req);

    if ( !preg_match($pattern, $num) || mysqli_num_rows($result) > 0) {
        header('location: signup.php?error=invalidNum&email='.$email);
        exit();
    }elseif ($password !== $rePassword) {
        header("location: signup.php?error=passwordcheck&email=".$email."&num=".$num);
        exit();
    }else{
        
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        
        $req1 = "INSERT INTO `patient` (`num`, `email_pt`, `password_pt`) VALUES('$num', '$email', '$hashedPwd')";
        if ( !mysqli_query($cnx, $req1) ) {
            header("location: signup.php?error=invalidSignup&email=".$email."&num=".$num);
            exit();
        }else {
            header('location: signup.php?signup=success');
            exit();
        }
    }

    mysqli_close($cnx);

}else{
    header('location: signup.php');
    exit();
}

