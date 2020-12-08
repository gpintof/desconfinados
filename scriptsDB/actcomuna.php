<?php
#obtencion de información y actualización de base de datos sobre casos activos por comuna
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
# Trunca tabla
mysqli_query($conn, "TRUNCATE TABLE actcomuna");
# Llenado de la tabla
$HANDLE = fopen("https://raw.githubusercontent.com/MinCiencia/Datos-COVID19/master/output/producto19/CasosActivosPorComuna.csv", "r");
while(($data = fgetcsv($HANDLE, 1000,",")) !== FALSE) {
    $last = end($data);
    $sql = "INSERT INTO actcomuna VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$last')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
mysqli_close($conn);
?>
