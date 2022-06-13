<?php

    session_start();

if (isset($_POST['réservation'])) {

    include_once 'connect.php';

    $nomPatient = $_POST['nom'];
    $prenomPatient = $_POST['prenom'];
    $telePatient = $_POST['tele'];
    $heurDebut = $_POST['heur'];
    $date = $_POST['date'];
    $nomMedecin = $_POST['nomMedecin'];
    $numPatient = $_SESSION['numPatient'];

    $req5 = "SELECT * FROM rdv INNER JOIN medecin on rdv.id_medecin = medecin.id_mc WHERE num_patient = '$numPatient' AND nom_mc = '$nomMedecin' AND date_rdv = '$date'"; 
    $req3 = "SELECT * FROM patient WHERE tele_pt = '$telePatient'";
    $resultTele = mysqli_query($cnx, $req3);
    $resultNumPatient = mysqli_query($cnx, $req5);

    $D = explode("-", $date);
    //print_r($D);
    $H = explode(":", $heurDebut);
    //print_r($H);

    $heurFin = date('H:i',mktime($H[0],$H[1] + 15));
    $req2 = "SELECT * FROM rdv INNER JOIN medecin on rdv.id_medecin = medecin.id_mc WHERE hour_debut BETWEEN '$heurDebut' AND '$heurFin' AND nom_mc = '$nomMedecin'";
    $resultHeur = mysqli_query($cnx, $req2);

    //echo date('d-m-Y', $t) > date("d-m-Y", mktime(0,0,0,$D[1],$D[2],$D[0]));

    //echo date("l", mktime(0,0,0,$D[1],$D[2],$D[0]));

    if ( date("l", mktime(0,0,0,$D[1],$D[2],$D[0])) === "Sunday" ) {
        header('location: rendez-vous.php?error=noWork&nom='.$nomPatient.'&prenom='.$prenomPatient.'&telePatient='.$telePatient.'&nomMedecin='.$nomMedecin.'&heurDebut='.$heurDebut);
        exit();
    }elseif( date('d-m-Y', time()) > date("d-m-Y", mktime(0,0,0,$D[1],$D[2],$D[0]))) {
        header('location: rendez-vous.php?error=dateInvalide&nom='.$nomPatient.'&prenom='.$prenomPatient.'&telePatient='.$telePatient.'&nomMedecin='.$nomMedecin.'&heurDebut='.$heurDebut);
        exit();
    }elseif ( (date('h:i',mktime($H[0],$H[1])) > date('h:i',mktime(1,00)) && date('h:i',mktime($H[0],$H[1])) < date('h:i',mktime(8,00))) || $H[0] > 12){
        header('location: rendez-vous.php?error=timeNotAvailable&nom='.$nomPatient.'&prenom='.$prenomPatient.'&telePatient='.$telePatient.'&nomMedecin='.$nomMedecin.'&date='.$date);
        exit();
    }elseif( mysqli_num_rows($resultTele) > 0 ) {
        header('location: rendez-vous.php?error=teleExists&nom='.$nomPatient.'&prenom='.$prenomPatient.'&nomMedecin='.$nomMedecin.'&heurDebut='.$heurDebut.'&date='.$date);
        exit();
    }elseif( mysqli_num_rows($resultHeur) > 0 ) {
        header('location: rendez-vous.php?error=rdvExists&nom='.$nomPatient.'&prenom='.$prenomPatient.'&nomMedecin='.$nomMedecin.'&date='.$date.'&telePatient='.$telePatient);
        exit();
    }elseif( mysqli_num_rows($resultNumPatient) > 0 ) {
        header('location: rendez-vous.php?error=alreadyHaveRdv&nom='.$nomPatient.'&prenom='.$prenomPatient.'&nomMedecin='.$nomMedecin.'&date='.$date.'&telePatient='.$telePatient.'&heurDebut='.$heurDebut);
        exit();
    }else{
        $req1 = "UPDATE patient SET nom_pt = '$nomPatient', prenom_pt = '$prenomPatient', tele_pt = '$telePatient' WHERE num = '$numPatient' ;";
        mysqli_query($cnx, $req1);
        $req0 = "SELECT id_mc FROM medecin WHERE nom_mc = '$nomMedecin'";
        $getIdMedecin = mysqli_query($cnx, $req0);
        $row = mysqli_fetch_assoc($getIdMedecin);
        $req = "INSERT INTO rdv VALUES(null, '$date', '$heurDebut', '$heurFin', '$numPatient', '$row[id_mc]')";
        mysqli_query($cnx, $req);
        header('location: rendez-vous.php?rdv=success');
        exit();
    }

}else {
    header('location: login.php');
    exit();
}