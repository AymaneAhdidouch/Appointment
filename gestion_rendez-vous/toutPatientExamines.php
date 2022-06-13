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
    <title>Médecin <?php if(isset($_SESSION['nomMedecin'])) { echo $_SESSION['nomMedecin']; } ?></title>
</head>
<body>

    <div class="container mt-2">
        <header class="d-flex justify-content-between p-4 shadow-lg bg-light rounded">
                <div class="d-flex">
                    <img src="img/hospital.svg" alt="icon hospital!" class="ms-2 h-75">
                    <h1 class="ms-2">HospitalX</h1>
                </div>
                <div class="d-flex justify-content-around">
                    <ul class="nav">
                        <li class="nav-item me-3">
                            <a href="medecin.php" class="nav-link text-white mt-2 btn btn-dark">les Rendez-vous D'aujourd'hui</a>
                        </li>
                        <li class="nav-item me-3">
                            <a href="rendez-vousFuturs.php" class="nav-link text-white mt-2 btn btn-dark">Tous les Rendez-vous Futurs</a>
                        </li>
                        <li class="nav-item">
                            <form action="logoutTr.php" method="POST">
                                <button type="submit" name="logout" class="nav-link text-white btn btn-dark mt-2 pe-4 ps-4">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </header>
        <main>
            <form action="" method="POST" class="p-3 w-100 mt-3 shadow d-flex justify-content-around">
                <div class="w-50 mt-2 text-start input-group">
                    <label class="form-label w-100">N° de Patient: <input type="text" class="form-control mt-1 w-75" placeholder="Entre N° de Patient Ex: RB12345" name="num" value="<?php if(isset($_POST['num'])){ echo $_POST['num']; } ?>" required></label>
                </div>
                <div class="w-25 mt-2 text-center">
                    <button type="submit" name="recherch" class="btn btn-primary w-50 h-50 mt-3">Recherch</button>
                </div>
            </form>
        </main>
        <table class="table table-success table-bordered shadow mt-3 text-center">
            <thead>
                <tr class="table-dark">
                    <th>Nombre des Patients</th>
                    <th>Nom de Patient</th>
                    <th>Prénom de Patient</th>
                    <th>Téléphone de Patient</th>
                    <th>Email de Patient</th>
                    <th>Date de Rendez-vous</th>
                    <th>Hour Debut</th>
                    <th>Hour Fin</th>
                    <th>N° de Patient</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                    if( isset($_SESSION['idMedecin']) ) {

                        include_once 'connect.php';

                        $idMedecin = $_SESSION['idMedecin'];
                        $date = date('Y-m-d', time());
                        $heure = date('H:i', time());

                        $req = "SELECT * FROM rdv INNER JOIN medecin ON rdv.id_medecin = medecin.id_mc 
                                INNER JOIN patient ON rdv.num_patient = patient.num WHERE id_mc = '$idMedecin' AND date_rdv < '$date' AND hour_debut <= '$heure' ORDER BY date_rdv, hour_debut";
                        $result = mysqli_query($cnx, $req);

                        $num = 0;

                        if( !isset($_POST['recherch']) ) {
                            while( $row = mysqli_fetch_assoc($result)) {
                                $num++;
                                echo '<tr>';
                                echo "<td>$num</td>";
                                echo "<td>$row[nom_pt]</td>";
                                echo "<td>$row[prenom_pt]</td>";
                                echo "<td>0$row[tele_pt]</td>";
                                echo "<td>$row[email_pt]</td>";
                                echo "<td>$row[date_rdv]</td>";
                                echo "<td>$row[hour_debut]</td>";
                                echo "<td>$row[hour_fin]</td>";
                                echo "<td>$row[num]</td>";
                                echo '</tr>';
                            }
                        }else{
                            $number = $_POST['num'];
                            $req1 = "SELECT * FROM rdv INNER JOIN medecin ON rdv.id_medecin = medecin.id_mc 
                                    INNER JOIN patient ON rdv.num_patient = patient.num WHERE medecin.id_mc = '$idMedecin' AND patient.num = '$number' AND date_rdv < '$date' AND hour_debut <= '$heure' ORDER BY date_rdv, hour_debut";
                            $result1 = mysqli_query($cnx, $req1);
                            if( mysqli_num_rows($result1) > 0 ) {
                                while( $row = mysqli_fetch_assoc($result1)) {
                                    $num++;
                                    echo '<tr>';
                                    echo "<td>$num</td>";
                                    echo "<td>$row[nom_pt]</td>";
                                    echo "<td>$row[prenom_pt]</td>";
                                    echo "<td>0$row[tele_pt]</td>";
                                    echo "<td>$row[email_pt]</td>";
                                    echo "<td>$row[date_rdv]</td>";
                                    echo "<td>$row[hour_debut]</td>";
                                    echo "<td>$row[hour_fin]</td>";
                                    echo "<td>$row[num]</td>";
                                    echo '</tr>';
                                }
                            }
                        }


                    }else{
                        header('location: login.php');
                        exit();
                    }

                ?>
            </tbody>
        </table>
    </div>

</body>
</html>