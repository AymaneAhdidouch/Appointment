<?php

if ( isset($_POST['login']) ) {

    include_once 'connect.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $where = $_POST['where'];

    if ($where == 'patient') {
        $req = "SELECT * FROM patient WHERE email_pt = '$email';";
        $result = mysqli_query($cnx, $req);
        if ( $row = mysqli_fetch_assoc($result) ) {
            $pwdCheck = password_verify($password, $row['password_pt']);
            if (!$pwdCheck) {
                header("location: login.php?error=wrongpwd&email=".$email);
                exit();
            }elseif ($pwdCheck) {

                session_start();
                $_SESSION['numPatient'] = $row['num'];
                
                header('location: rendez-vous.php');
                exit();
            }
            
        }else {
            header('location: login.php?login=false');
            exit();
        }
    }else {
        $req = "SELECT * FROM medecin WHERE email_mc = '$email' AND password_mc = '$password';";
        $result = mysqli_query($cnx, $req);
        if ( $row = mysqli_fetch_assoc($result) ) {

            session_start();
            $_SESSION['idMedecin'] = $row['id_mc'];
            $_SESSION['nomMedecin'] = $row['nom_mc'];

            header('location: medecin.php');
            exit();
        }else {
            header('location: login.php?login=false');
            exit();
        }
        
    }

    mysqli_close($cnx);

}else{
    header('location: login.php');
    exit();
}