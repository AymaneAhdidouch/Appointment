<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-5.1.3-dist/js/bootstrap.min.js">
    <style>
        body{
            background-image: linear-gradient(to right,#39a275, white, #7fb5ff, #7fb5ff);
        }

        .container{
            position: absolute;
            top: 65%;
            left: 50%;
            transform: translate(-50%, -65%);
        }
        .rightImg{
            background-image: url(img/rightImg.jpg);
            background-position-x: right;
            background-size: cover;
            border-radius: 0px 15px 15px 0px;
            background-repeat: no-repeat;
            opacity: 0.6;
        }
    </style>
    <title>Sign up</title>
</head>
<body>
    <?php
        
        if ( isset($_GET['error']) ) {
            $error = $_GET['error'];

            if ( $error == 'invalidNum' ) {
                echo "<div class='alert alert-danger col-9 mt-5 m-auto'>Invalid N° de Carte Nationale!</div>";
            }elseif( $error == 'passwordcheck' ) {
                echo "<div class='alert alert-danger col-9 mt-5 m-auto'>Votre mot de passe ne correspond pas!</div>";
            }elseif( $error == 'invalidSignup' ) {
                echo "<div class='alert alert-danger col-9 mt-5 m-auto'>Quelque chose s'est mal passé essaie encore!</div>";
            }
        }elseif( isset($_GET['signup']) ) {
            echo "<div class='alert alert-success col-9 m-auto mt-5'>Inscription réussie!</div>";
        }
        
    ?>
    <div class="container w-75 h-75 d-flex">
        <form action="signupTr.php" method="POST" class="was-validated p-3 col-5 text-center h-100 shadow">
            <h1><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-hospital" viewBox="0 0 16 16">
            <path d="M8.5 5.034v1.1l.953-.55.5.867L9 7l.953.55-.5.866-.953-.55v1.1h-1v-1.1l-.953.55-.5-.866L7 7l-.953-.55.5-.866.953.55v-1.1h1ZM13.25 9a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5ZM13 11.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5Zm.25 1.75a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5Zm-11-4a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5A.25.25 0 0 0 3 9.75v-.5A.25.25 0 0 0 2.75 9h-.5Zm0 2a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5ZM2 13.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5Z"/>
            <path d="M5 1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1a1 1 0 0 1 1 1v4h3a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h3V3a1 1 0 0 1 1-1V1Zm2 14h2v-3H7v3Zm3 0h1V3H5v12h1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3Zm0-14H6v1h4V1Zm2 7v7h3V8h-3Zm-8 7V8H1v7h3Z"/>
            </svg> Sign up</h1>
            <div class="mb-1 mt-3 text-start">
                <label class="form-label w-100 ">Ton N°: <input type="text" class="form-control mt-1" placeholder="Exemple: RB64964" name="num" value="<?php if(isset($_GET['num'])){ echo $_GET['num'];}?>" required></label>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="mb-1 mt-1 text-start">
                <label class="form-label w-100 ">Ton Email: <input type="email" class="form-control mt-1" placeholder="Entre Email" name="email" value="<?php if(isset($_GET['email'])){ echo $_GET['email'];}?>" required></label>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="mb-1 text-start">
                <label class="form-label w-100">Ton Mot de passe: <input type="password" class="form-control mt-1"  placeholder="Entre Mot de passe" name="password" required></label>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="mb-1 text-start">
                <label class="form-label w-100">Repeat le Mot de passe: <input type="password" class="form-control mt-1"  placeholder="Re-Entre Mot de passe" name="re-password" required></label>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <button type="submit" name="signup" class="btn btn-primary w-50 mt-3">Sign Up</button>
            <p class="text-start mt-4 w-75">Déja inscrit? <a href="login.php" class="text-decoration-none">Connectez-vous ></a></p>
        </form>
        <div class="rightImg h-100 col-7"></div>
    </div>
</body>
</html>