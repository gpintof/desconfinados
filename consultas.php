<?php 
$servername = "localhost";
$database = "desconfinados";
$username = "desconfinados";
$password = "XqxsodQm9Y0iLJK0";
# Crear conexión
$conn = mysqli_connect($servername, $username, $password, $database);
# Verificar conexión
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}  
    $comuna = $_POST["comuna"];
    $searchpap = mysqli_fetch_row(mysqli_query($conn,"SELECT paso, etapa FROM pasoapaso WHERE comuna='$comuna'" ));
    $paso = $searchpap[0];
    $etapa = $searchpap[1];
    $activos = mysqli_fetch_row(mysqli_query($conn,"SELECT `Casos Activos` FROM actcomuna WHERE comuna='$comuna'" ));
    $searchpob = mysqli_fetch_row(mysqli_query($conn,"SELECT Población, `Confirmados Totales` FROM conftotales WHERE comuna='$comuna'" ));
    $pobla = $searchpob[0];
    $confT= $searchpob[1];
    $fallecidos = mysqli_fetch_row(mysqli_query($conn,"SELECT `Fallecidos Totales` FROM fallecomuna WHERE comuna='$comuna'" ));
    $activos = intval($activos[0]);
    $pobla = intval($pobla);
    $confT = intval($confT);
    $fallecidos = intval($fallecidos[0]);
    echo "$paso, $etapa, $activos, $pobla, $confT, $fallecidos";

    /*
    metodo con problemas por diferente codificación de caracteres
    //$variables = array();
    //array_push($variables, $paso, $etapa, $activos[0], $pobla, $confT, $fallecidos[0]);
    //print json_encode($variables);

    //echo "$paso, $etapa, $activos[0], $pobla, $confT, $fallecidos[0]";
    
    //echo "estas en paso: $paso \n la etapa es: $etapa \n casos activos: $activos[0] \n población: $pobla \n contagiados totales: $confT \n fallecidos totales: $fallecidos[0]";
    */
?>