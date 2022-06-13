<?php

$serverName = 'localhost';
$username = 'root';
$password = '';
$DBname = 'gestion_rendez-vous';

$cnx = mysqli_connect($serverName, $username, $password, $DBname);

if ( !$cnx ) {
    echo 'Error!! '.mysqli_connect_error();
}

