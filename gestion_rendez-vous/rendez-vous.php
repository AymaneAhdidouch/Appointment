<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-5.1.3-dist/js/bootstrap.min.js">
    <title>Rendez-vous</title>
    <style>
        form{
            width: 44%;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button{
            -webkit-appearance: none;
        }
    </style>
</head>
<body>

    <?php

        if ( isset($_SESSION['numPatient']) ) {

            include 'connect.php';

            $req = "SELECT nom_mc FROM medecin";
            $resultat = mysqli_query($cnx, $req);

            echo '<div class="container w-75 mt-1">
                    <header class="d-flex justify-content-between p-4 shadow-lg bg-light rounded">
                        <div class="d-flex w-50">
                            <img src="img/hospital.svg" alt="icon hospital!" class="ms-2 h-75">
                            <h1 class="ms-2">HospitalX</h1>
                        </div>
                        <ul class="nav">
                            <li class="nav-item me-4">
                                <a class="nav-link text-white mt-2 btn btn-dark" href="index.html">Actualités</a>
                            </li>
                            <li class="nav-item">
                                <form action="logoutTr.php" method="POST">
                                    <button type="submit" name="logout" class="nav-link text-white btn btn-dark mt-2 pe-4 ps-4">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </header>
                    <div class="d-flex justify-content-around">
                        <form action="rendez-vousTr.php" method="POST" class="was-validated p-2 pb-3 pt-5 text-center">';

                        if ( isset($_GET['error']) ) {

                            $error = $_GET['error'];

                            if( $error === 'noWork' ) {
                                echo "<div class='alert alert-danger m-auto mt-1 mb-2'>Ne travaille pas le dimanche!</div>";
                            }elseif( $error === 'dateInvalide' ) {
                                echo "<div class='alert alert-danger m-auto mt-1 mb-2'>Votre Date est invalide! Date d'aujourd'hui est: ". date('d-m-Y', time()) ."</div>";
                            }elseif( $error === 'timeNotAvailable' ) {
                                echo "<div class='alert alert-danger m-auto mt-1 mb-2'>Nous recevons des patients de 08:00 à 01:00 AM!</div>";
                            }elseif( $error === 'teleExists' ) {
                                echo "<div class='alert alert-danger m-auto mt-1 mb-2'>Votre nombre de téléphone est invalide!</div>";
                            }elseif( $error === 'rdvExists' ) {
                                echo "<div class='alert alert-danger m-auto mt-1 mb-2'>Le rendez-vous est déjà pris!</div>";
                            }elseif( $error === 'alreadyHaveRdv' ) {
                                echo "<div class='alert alert-danger m-auto mt-1 mb-2'>Vous avez déjà un rendez-vous!</div>";                                
                            }

                        }elseif( isset($_GET['rdv']) ) {
                            echo "<div class='alert alert-success m-auto mt-1 mb-2'>Votre rendez-vous a été pris avec succès!</div>";
                        }
       
                        echo '<h1>Prendre un Rendez-vous</h1>
                            <div class="row">
                                <div class="mb-2 mt-4 text-start col">
                                    <label class="form-label w-100 ">Ton Nom: <input type="text" name="nom" class="form-control mt-2" placeholder="Entre Votre Nom" value="'; if(isset($_GET['nom']) && !isset($_GET['rdv']) ){ echo $_GET['nom']; } echo '" required></label>
                                </div>
                                <div class="mb-2 mt-4 text-start col">
                                    <label class="form-label w-100">Ton Prénom: <input type="text" name="prenom" class="form-control mt-2"  placeholder="Entre Votre Prénom" value="'; if(isset($_GET['prenom']) && !isset($_GET['rdv'])){ echo $_GET['prenom']; } echo '" required></label>
                                </div>
                            </div>
                            <div class="mb-2 mt-2 text-start col">
                                <label class="form-label w-100">Ton Téléphone: <input type="number" name="tele" class="form-control mt-2"  placeholder="Ex: 0612345678" value="'; if(isset($_GET['telePatient']) && !isset($_GET['rdv']) ){ echo $_GET['telePatient']; } echo '" required></label>
                            </div>
                            <div class="row">
                                <div class="mb-2 mt-2 text-start col">
                                    <label class="form-label w-100">Heur: <input type="time" name="heur" class="form-control mt-2 without_ampm" min="08:00" max="01:00" value="'; if(isset($_GET['heurDebut']) && !isset($_GET['rdv'])){ echo $_GET['heurDebut']; } echo '" required></label>
                                </div>
                                <div class="mb-2 mt-2 text-start col">
                                    <label class="form-label w-100">Date de Rendez-vous: <input type="date" name="date" class="form-control mt-2" value="'; if(isset($_GET['date']) && !isset($_GET['rdv'])){ echo $_GET['date']; } echo '" required></label>
                                </div>
                            </div>
                            <div class="mb-2 mt-2 text-start">
                                <label class="form-label w-100">Choisissez Votre médecin: <select name="nomMedecin" class="form-select mt-2" required>
                                <option value="" disabled selected>Votre choix</option>';
                                while ( $row = mysqli_fetch_assoc($resultat)) {
                                    echo '<option value="'.$row['nom_mc'].'">Dr. '.$row['nom_mc'].'</option>';
                                }if( isset($_GET['nomMedecin']) && !isset($_GET['rdv'])){
                                    echo '<option value="'; echo $_GET['nomMedecin']; echo '" selected>Dr. '; echo $_GET['nomMedecin']; echo '</option>';
                                }
                            echo '</select></label>
                            </div>
                            <button type="submit" name="réservation" class="btn btn-primary w-50 mt-3">Valider Votre Réservation</button>
                        </form>
                    <div>
                        <div class="alert alert-warning mt-5">
                            <h3 class="mt-2 p-2">Information sur nos Médecins</h3>
                            <ul class="p-4">
                                <li>Dr.Khalid El Hassani est un Médecin Expert De Diagnostic...</li>
                                <li>Dr.Said Chikhi est un Médecin Expert Cardiologue...</li>
                                <li>Dr.Soumia Elmelhaoui est un Médecine Expert De Pédiatre...</li>
                                <li>Dr.Jamal El Moussoui est un Médecin Expert Generaliste...</li>
                                <li>Dr.Saad Essadiki est un Médecin Expert Chirurgie Médecine...</li>
                                <li>Dr.Mohamed El Khayri est un Médecin Expert De Médecin Interniste...</li>
                            </ul>
                        </div>
                        <div class="m-2 p-3">';
                            if( isset($_GET['error']) == 'rdvExists' ) {
                                $nomMedecin = $_GET['nomMedecin'];
                                $date = $_GET['date'];
                                $req4 = "SELECT hour_fin from rdv
                                        WHERE hour_fin NOT IN 
                                        (SELECT hour_debut from rdv inner join medecin on rdv.id_medecin = medecin.id_mc WHERE nom_mc = '$nomMedecin')
                                        AND date_rdv = '$date';";
                                $resultatHeurAvailable = mysqli_query($cnx, $req4);
                                if (mysqli_num_rows($resultatHeurAvailable) > 0) {
                                    echo "<h5>Quelques heures Non pris en $date! avec $nomMedecin</h5>";
                                    echo "<ul class='p-2'>";
                                    while( $row = mysqli_fetch_assoc($resultatHeurAvailable) ) {
                                        echo "<li>".$row['hour_fin']."</li>";
                                    }
                                    echo "</ul>";
                                }
                            }
                    echo '</div>
                    </div>
                    </div>
                </div>';
        }else {
            header('location: login.php');
            exit();
        }
    ?>

</body>
</html>