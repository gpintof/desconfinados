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
mysqli_query($conn, "TRUNCATE TABLE historico_comunal_activos");
# Llenado de la tabla
$HANDLE = fopen("https://raw.githubusercontent.com/MinCiencia/Datos-COVID19/master/output/producto19/CasosActivosPorComuna_T.csv", "r");
while(($data = fgetcsv($HANDLE, 10000,",")) !== FALSE) {
    //interesa desde el [55] al [92]
    $sql ="INSERT INTO historico_comunal_activos VALUES ('$data[0]', ";
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