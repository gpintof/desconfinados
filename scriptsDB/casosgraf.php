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
mysqli_query($conn, "TRUNCATE TABLE incremental_comunal_casos");
# Llenado de la tabla
$HANDLE = fopen("https://raw.githubusercontent.com/MinCiencia/Datos-COVID19/master/output/producto1/Covid-19_T.csv", "r");
while(($data = fgetcsv($HANDLE, 10000,",")) !== FALSE) {
    //interesa desde el [50] al [87]
    $sql ="INSERT INTO incremental_comunal_casos VALUES ('$data[0]', ";
    for ($i = 50; $i < 87; $i++) {
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