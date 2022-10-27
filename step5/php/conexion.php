<?php
    $host = "localhost";
    $user = "root";
    $clave = "";
    $bd = "weather";
    $conectar = mysqli_connect($host,$user,$clave,$bd);
    mysqli_set_charset($conectar,'utf8');
?>