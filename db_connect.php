<?php
//Conexão com o banco de dados

$servername = "mysqlbd.csegyy4s2xv4.us-east-1.rds.amazonaws.com";
$username = "admin";
$password = "senha123";
$db_name = "anazon";

$connect = mysqli_connect($servername, $username, $password, $db_name);


if(mysqli_connect_error()):
    echo "Falha na conexão:".mysqli_connect_error();
endif;

?>