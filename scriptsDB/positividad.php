<?php
#obtencion de información y actualización de base de datos sobre pruebas pcr y positividad a nivel nacional
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
mysqli_query($conn, "TRUNCATE TABLE positividad");
# Llenado de la tabla
$HANDLE = fopen("https://raw.githubusercontent.com/MinCiencia/Datos-COVID19/master/output/producto49/Positividad_Diaria_Media.csv", "r");
while(($data = fgetcsv($HANDLE, 10000,",")) !== FALSE) {
    $last = end($data);
    $sql = "INSERT INTO positividad VALUES ('$data[0]', '$last')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
mysqli_close($conn);
?>
