<?php
#obtencion de información y actualización de base de datos sobre situacion nacional.
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
mysqli_query($conn, "TRUNCATE TABLE totalesnacionales");
# Llenado de la tabla
$HANDLE = fopen("https://raw.githubusercontent.com/MinCiencia/Datos-COVID19/master/output/producto5/TotalesNacionales.csv", "r");
while(($data = fgetcsv($HANDLE, 10000,",")) !== FALSE) {
    $last = end($data);
    $sql = "INSERT INTO totalesnacionales VALUES ('$data[0]', '$last')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
mysqli_close($conn);
?>
