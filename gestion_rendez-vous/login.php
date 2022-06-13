<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-5.1.3-dist/js/bootstrap.min.js">
    <title>Sign in</title>
    <style>
        body{
            background-image: linear-gradient(to right, #7fb5ff, white, #39a275);
        }

        .container{
            position: absolute;
            top: 65%;
            left: 50%;
            transform: translate(-50%, -65%);
        }
    </style>
</head>
<body>
    <?php

        if ( isset($_GET['login']) ){
            echo "<div class='alert alert-danger w-50 ps-4 m-auto mt-5'>Nous Trouvé pas Votre compte!</div>";
        }elseif( isset($_GET['error']) ) {
            echo "<div class='alert alert-danger w-50 ps-4 m-auto mt-5'>Mauvais mot de passe, Veuillez réessayer!</div>";
        }elseif( isset($_GET['logout']) ) {
            echo "<div class='alert alert-info w-50 m-auto ps-4 mt-5'>Déconnecté avec succès!</div>";
        }
        
    ?> 
    <div class="container w-50 h-75 d-flex">
        <img src="img/leftImg.jpg" alt="une image!" class="img-fluid rounded-3 w-50 float-start">
        <form action="loginTr.php" method="POST" class="was-validated p-3 w-50 pt-5 text-center h-100 shadow">
            <h1 class="h1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hospital" viewBox="0 0 16 16">
            <path d="M8.5 5.034v1.1l.953-.55.5.867L9 7l.953.55-.5.866-.953-.55v1.1h-1v-1.1l-.953.55-.5-.866L7 7l-.953-.55.5-.866.953.55v-1.1h1ZM13.25 9a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5ZM13 11.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5Zm.25 1.75a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5Zm-11-4a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5A.25.25 0 0 0 3 9.75v-.5A.25.25 0 0 0 2.75 9h-.5Zm0 2a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5ZM2 13.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5Z"/>
            <path d="M5 1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1a1 1 0 0 1 1 1v4h3a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h3V3a1 1 0 0 1 1-1V1Zm2 14h2v-3H7v3Zm3 0h1V3H5v12h1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3Zm0-14H6v1h4V1Zm2 7v7h3V8h-3Zm-8 7V8H1v7h3Z"/>
            </svg> Sign in</h1>
            <div class="mb-3 mt-3 text-start">
                <label class="form-label w-100 ">Ton Email: <input type="email" class="form-control mt-2" placeholder="Entre Email" name="email" value="<?php if(isset($_GET['email'])){ echo $_GET['email']; } ?>" required></label>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="mb-3 text-start">
                <label class="form-label w-100">Ton Mot de passe: <input type="password" class="form-control mt-2"  placeholder="Entre Mot de passe" name="password" required></label>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-check mb-3 mt-3 text-start">
                <label class="form-check-label">Médcien <input class="form-check-input" type="radio" name="where" value="medcien" required></label>
                <label class="form-check-label ms-5">Patient <input class="form-check-input" type="radio" name="where" value="patient" required></label>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Check this checkbox to continue.</div>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-50 mt-3">Login</button>
            <p class="text-start mt-5">Nouvelle patient? <a href="signup.php" class="text-decoration-none">S'inscrire maintenant ></a></p>
        </form>
    </div>
</body>
</html>