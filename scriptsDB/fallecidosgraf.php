<?php
#obtencion de información y actualización de base de datos sobre casos confirmados por comuna
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
echo "Connected successfully";
# Trunca tabla
mysqli_query($conn, "TRUNCATE TABLE incremental_comunal_fallecidos");
# Llenado de la tabla
$HANDLE = fopen("https://raw.githubusercontent.com/MinCiencia/Datos-COVID19/master/output/producto38/CasosFallecidosPorComuna_T.csv", "r");
while(($data = fgetcsv($HANDLE, 10000,",")) !== FALSE) {
    //interesa desde el [55] al [92]
    $sql ="INSERT INTO incremental_comunal_fallecidos VALUES ('$data[0]', ";
    for ($i = 55; $i < 92; $i++) {
        $sql = $sql . "'" . $data[$i] . "'" . ", ";
    }
    $sql = $sql . "'" . $data[$i] . "'" . ")";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>