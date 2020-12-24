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
#Obtener comuna seleccionada
$comuna = "`" . $_POST["comuna"] . "`";
//Ejecutar query´s para almacenarlas en arreglos
$fechas = mysqli_fetch_all(mysqli_query($conn,'SELECT fecha FROM incremental_comunal_casos;' ));
$casos_totales = mysqli_fetch_all(mysqli_query($conn,"SELECT $comuna FROM incremental_comunal_casos;" ));
$fallecidos_totales = mysqli_fetch_all(mysqli_query($conn,"SELECT $comuna FROM incremental_comunal_fallecidos;" ));
$activos_comunal = mysqli_fetch_all(mysqli_query($conn,"SELECT $comuna FROM historico_comunal_activos;" ));
//generar string para print
$count_date = count($fechas) - 1;
$count_ct = count($casos_totales) - 1;
$count_ft = count($fallecidos_totales);
$count_ac = count($activos_comunal);
$date = "";
$ct = "";
$ft = "";
$ac = "";
for ($i = $count_date - 7; $i < $count_date; $i++) {
    $date = $date . $fechas[$i][0] . ",";
}
for ($i = $count_ct - 7; $i < $count_ct; $i++) {
    $ct = $ct . $casos_totales[$i][0] . ",";
}
for ($i = $count_ft - 7; $i < $count_ft; $i++) {
    $ft = $ft . $fallecidos_totales[$i][0] . ",";
}
for ($i = $count_ac - 7; $i < $count_ac; $i++ ) {
    $ct = $ct . $activos_comunal[$i][0] . ",";
}

print_r($date . $ct . $ac. $ft );
?>
 
