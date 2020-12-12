<!DOCTYPE html>
<html>
    <script src="./js/jquery-3.5.1.min.js"></script>
    <script src="./js/pagina.js"></script>
    <head>
        <title>Desconfinados</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
    </head>
    <body>
    <body background="https://statics-cuidateplus.marca.com/sites/default/files/styles/natural/public/sars-cov-2.jpg?itok=pkWpE08d">
    <div style="color:#FF0000" id="central"> 
    </div>
</br>
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
    $fecha = mysqli_fetch_row(mysqli_query($conn,"SELECT info FROM totalesnacionales WHERE data='fecha'" ));
    $total = mysqli_fetch_row(mysqli_query($conn,"SELECT info FROM totalesnacionales WHERE data='Casos totales'" ));
    $total = number_format($total[0]);
    $nuevos = mysqli_fetch_row(mysqli_query($conn,"SELECT info FROM totalesnacionales WHERE data='Casos nuevos totales'" ));
    $nuevos = number_format($nuevos[0]);
    $fallecidos = mysqli_fetch_row(mysqli_query($conn,"SELECT info FROM totalesnacionales WHERE data='fallecidos'" ));
    $fallecidos = number_format($fallecidos[0]);
    $pcr = mysqli_fetch_row(mysqli_query($conn,"SELECT info FROM positividad WHERE item='pcr'" ));
    $pcr = number_format($pcr[0]);
    $positividad = mysqli_fetch_row(mysqli_query($conn,"SELECT info FROM positividad WHERE item='positividad'" ));
    $positividad = round($positividad[0] * 100, 1);
    ?>
    <div id="casillero">
        <h1>Datos</h1>
        <!-- formulario del menu de cascada para ingreso de comuna -->
        <form method="POST" name ="formulario" id=menu action= >
            Región <br>
            <select name = "sel-reg" id = "sel-reg">
                <option value="" selected>Seleccione Región</option>
            </select>
            <br><br>
            Comuna <br>
            <select name = "sel-com" id = "sel-com">
                <option value="" selected>Debe elegir Región</option>
            </select>
            <br><br>
            <button id="boton" type="button">Buscar</button>
        </form>
        
                <!-- 
                   -----menu ingreso comuna manual----
        <p>Ingresa comuna: <input id="comuna" type="text"></p>
        <button id="boton" role="button">Buscar</button>

            ---- menu para seleccionar comuna v2 ----
            </optgroup>
        </select>
        <select name ="Comuna">
            <optgroup label = "doble">
                <option value="1">Comuna</option>

            </optgroup>
        </select>
    --> 
        <!-- div para mostrar datos de la comuna -->
        <div id = "comuna-data">
            <p id= text-paso></p>
            <p id= text-etapa></p>
            <p id= text-activos></p>
            <p id= text-pobla></p>
            <p id= text-confT></p>
            <p id= text-fallecidos></p>
        </div>

    </div>
    
    </br>
    <!-- div para info nacional -->
    <div id="nacional">
        <h1>Reporte Nacional</h1>
        <?php echo "Casos nuevos hoy: $nuevos <br> examenes pcr hoy: $pcr <br> positividad hoy: $positividad% <br> total fallecidos: $fallecidos <br> total casos confirmados: $total <br> informacion actualizada al $fecha[0]"?>
        <br>
        <br>
    </div>
    </br>
    <!-- div para links -->
    <div id="info">
        <h1>Links de interés</h1>
        <a href="https://www.gob.cl/coronavirus/plandeaccion/" target="_blank">Plan de Acción Minsal</a>
        </br>
        </br>
        <a href="https://www.gob.cl/coronavirus/pasoapaso/" target="_blank">Plan paso a paso</a>
        </br>
        </br>
        <a href="https://www.minciencia.gob.cl/covid19" target="_blank">Base de datos COVID Min. Ciencia</a>
        </br>
        </br>
        <a href="https://www.gob.cl/coronavirus/documentos/" target="_blank">Documentos e Instructivos Minsal</a>
        </br>
        </br>
    </div>

    </body>
</html>

