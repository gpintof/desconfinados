<?php
#obtencion de información y actualización de base de datos sobre casos confirmados por comuna
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
mysqli_query($conn, "TRUNCATE TABLE conftotales");
# Llenado de la tabla
$HANDLE = fopen("https://raw.githubusercontent.com/MinCiencia/Datos-COVID19/master/output/producto2/2020-12-04-CasosConfirmados.csv", "r");
while(($data = fgetcsv($HANDLE, 1000,",")) !== FALSE) {
    $last = end($data);
    $sql = "INSERT INTO conftotales VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$last')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
$sobrante = '"Comuna"';
mysqli_query($conn,"DELETE FROM ConfTotales WHERE Comuna=$sobrante");
mysqli_close($conn);
?>
