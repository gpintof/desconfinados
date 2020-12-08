<?php
$servername = "localhost";
$database = "desconfinados";
$username = "desconfinados";
$password = "";
# Crear conexión
$conn = mysqli_connect($servername, $username, $password, $database);
# Verificar conexión
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
#trabajar archivo con datos
$datos = file_get_contents("https://atlas.jifo.co/api/connectors/4a473aa1-701e-4c04-acd2-b425056f5c03");
$datosv2 = explode ("],[", $datos);
$comunas = array();
$pasos = array();
$etapa = array();
for ($i = 0; $i < count($datosv2); ++$i) {
    $temp = explode (",", $datosv2[$i]);
    array_push($comunas, $temp[0]);
    array_push($pasos, $temp[1]);
    array_push($etapa, $temp[2]);
}
#truncar la tabla
mysqli_query($conn, "TRUNCATE TABLE pasoapaso");
#insertar en la base de datos
for ($k = 0; $k < count($comunas); ++$k) {
    $comunas = str_replace('"', '', $comunas);
    $pasos = str_replace('"', '', $pasos);
    $etapa = str_replace('"', '', $etapa);
    $sql = "INSERT INTO pasoapaso VALUES ('$comunas[$k]', '$pasos[$k]', '$etapa[$k]')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
$sobrante = '"Paso"';
mysqli_query($conn,"DELETE FROM pasoapaso WHERE paso=$sobrante");
mysqli_close($conn);
?>
