$(function() {
  var fechas = [];
  var casos_totales = [];
  var fallecidos_totales = [];
  var activos_comunal = [];
  var cgraf1 = document.getElementById("grafico1");
  var cgraf2 = document.getElementById("grafico2");
  var regiones = {
    "Región Metropolitana" : ["Alhué", "Buin", "Calera de Tango", "Cerrillos", "Cerro Navia", "Colina", "Conchalí", "Curacaví", "El Bosque", "El Monte", "Estación Central", "Huechuraba", "Independencia", "Isla de Maipo", "La Cisterna", "La Florida", "La Granja", "La Pintana", "La Reina", "Lampa", "Las Condes", "Lo Barnechea", "Lo Espejo", "Lo Prado", "Macul", "Maipu", "Maria Pinto", "Melipilla", "Ñuñoa", "Padre Hurtado", "Paine", "Pedro Aguirre Cerda", "Peñaflor", "Peñalolén", "Pirque", "Providencia", "Pudahuel", "Puente Alto", "Quilicura", "Quinta Normal", "Recoleta", "Renca", "San Bernardo", "San Joaquín", "San José de Maipo", "San Miguel", "San Pedro", "San Ramón", "Santiago", "Talagante", "Tiltil", "Vitacura"],
    "Arica y Parinacota" : ["Arica","Camarones","General Lagos","Putre"],
    "Tarapacá" : ["Alto Hospicio", "Camiña", "Colchane", "Huara", "Iquique", "Pica", "Pozo Almonte"],
    "Antofagasta" : ["Antofagasta", "Calama", "Maria Elena", "Mejillones", "Ollagüe", "San Pedro de Atacama", "Sierra Gorda", "Taltal", "Tocopilla"],
    "Atacama" : ["Alto del Carmen", "Caldera", "Chañaral", "Copiapó", "Diego de Almagro", "Freirina", "Huasco", "Tierra Amarilla", "Vallenar"],
    "Coquimbo" : ["Andacollo", "Canela" ,"Combarbalá" ,"Coquimbo" ,"Illapel", "La Higuera", "La Serena", "Los Vilos", "Monte Patria", "Ovalle", "Paiguano", "Punitaqui", "Río Hurtado", "Salamanca", "Vicuña"],
    "Valparaíso" : ["Algarrobo", "Cabildo", "Calera", "Calle Larga", "Cartagena", "Casablanca", "Catemu", "Concon", "El Quisco", "El Tabo", "Hijuelas", "Isla de Pascua", "Juan Fernández", "La Cruz", "La Ligua", "Limache", "Llaillay", "Los Andes", "Nogales", "Olmué", "Panquehue", "Papudo", "Petorca", "Puchuncaví", "Putaendo", "Quillota", "Quilpue", "Quintero" , "Rinconada", "San Antonio", "San Esteban", "San Felipe", "Santa Maria", "Santo Domingo", "Valparaiso", "Villa Alemana", "Vina del Mar", "Zapallar"],
    //falta validar comunas de aqui en adelante
    "O'Higgins" : ["Chepica", "Chimbarongo", "Codegua", "Coinco", "Coltauco", "Donihue", "Graneros", "La Estrella", "Las Cabras", "Litueche", "Lolol", "Machali", "Malloa", "Marchihue", "Mostazal", "Nancagua", "Navidad", "Olivar", "Palmilla", "Paredones", "Peralillo", "Peumo", "Pichidegua", "Pichilemu", "Placilla", "Pumanque", "Quinta de Tilcoco", "Rancagua", "Rengo", "Requinoa", "San Fernando", "San Vicente", "Santa Cruz"],
    "Maule" : ["Cauquenes", "Chanco", "Colbun", "Constitucion", "Curepto", "Curico", "Empedrado", "Hualane", "Licanten", "Linares", "Longavi", "Maule", "Molina", "Parral", "Pelarco", "Pelluhue", "Pencahue", "Rauco", "Retiro", "Rio Claro", "Romeral", "Sagrada Familia", "San Clemente", "San Javier", "San Rafael", "Talca", "Teno", "Vichuquen", "Villa Alegre", "Yerbas Buenas"],
    "Nuble" : ["Bulnes", "Chillan", "Chillan Viejo", "Cobquecura", "Coelemu", "Coihueco", "El Carmen", "Ninhue", "Niquen", "Pemuco", "Pinto", "Portezuelo", "Quillon", "Quirihue", "Ranquil", "San Carlos", "San Fabian", "San Ignacio", "San Nicolas", "Treguaco", "Yungay"],
    "Biobío" : ["Alto Biobio", "Antuco", "Arauco", "Cabrero", "Canete", "Chiguayante", "Concepcion", "Contulmo", "Coronel", "Curanilahue", "Florida", "Hualpen", "Hualqui", "Laja", "Lebu", "Los Alamos", "Los Angeles", "Lota", "Mulchen", "Nacimiento", "Negrete", "Penco", "Quilaco", "Quilleco", "San Pedro de la Paz", "San Rosendo", "Santa Barbara", "Santa Juana", "Talcahuano", "Tirua", "Tome", "Tucapel", "Yumbel"],
    "Araucanía" : ["Angol", "Carahue", "Cholchol", "Collipulli", "Cunco", "Curacautin", "Curarrehue", "Ercilla", "Freire", "Galvarino", "Gorbea", "Lautaro", "Loncoche", "Lonquimay", "Los Sauces", "Lumaco", "Melipeuco", "Nueva Imperial", "Padre Las Casas", "Perquenco", "Pitrufquen", "Pucon", "Puren", "Renaico", "Saavedra", "Temuco", "Teodoro Schmidt", "Tolten", "Traiguen", "Victoria", "Vilcun", "Villarrica"],
    "Los Ríos" : ["Corral", "Futrono", "La Union", "Lago Ranco", "Lanco", "Los Lagos", "Mafil", "Mariquina", "Paillaco", "Panguipulli", "Rio Bueno", "Valdivia"],
    "Los Lagos" : ["Ancud", "Calbuco", "Castro", "Chaiten", "Chonchi", "Cochamo", "Curaco de Velez", "Dalcahue", "Fresia", "Frutillar", "Futaleufu", "Hualaihue", "Llanquihue", "Los Muermos", "Maullin", "Osorno", "Palena", "Puerto Montt", "Puerto Octay", "Puerto Varas", "Puqueldon", "Purranque", "Puyehue", "Queilen", "Quellon", "Quemchi", "Quinchao", "Rio Negro", "San Juan de la Costa", "San Pablo"],
    "Aysén" : ["Aysen", "Chile Chico", "Cisnes", "Cochrane", "Coyhaique", "Guaitecas", "Lago Verde", "OHiggins", "Rio Ibanez", "Tortel"],
    "Magallanes" : ["Cabo de Hornos", "Laguna Blanca", "Natales", "Porvenir", "Primavera", "Punta Arenas", "Rio Verde", "San Gregorio", "Timaukel", "Torres del Paine"]
    }
  window.onload = function()  {
    var regionsel = document.getElementById("sel-reg");
    var comunasel = document.getElementById("sel-com");
    for (var reg in regiones) {
      regionsel.options[regionsel.options.length] = new Option(reg, reg);
    }
  regionsel.onchange = function() {
    comunasel.length = 1;
    var com = regiones[this.value];
    for (var i = 0; i < com.length; i++) {
      comunasel.options[comunasel.options.length] = new Option(com[i], com[i]);
      }
   }
  }
  $("#boton").click(function() {
    if (($("#sel-com").val()) != "") {
      var comuna = $("#sel-com").val();
      $.post("consultas.php",
      {
        comuna: comuna
      },
      function(data){
          var datos = data.split(",");
          if (datos[0] == 1) {
            $("#text-paso").text("Paso 1. Se requiere permiso obtenido en comisaria virtual para poder salir de casa y solo dentro de la misma comuna");
          }
          if (datos[0] == 2) {
            $("#text-paso").text("Paso 2. Se requiere permiso individual correspondiente obtenido en comisaria virtual (uno semanal) para poder salir de casa los fines de semana y feriados, en la semana no rige la cuarentena ");
          }
          if (datos[0] == 3) {
            $("#text-paso").text("Paso 3. No requiere permisos para movilizarse por la comuna o entre comunas en mismo paso o superior, en caso de viajes interregionales se requiere Pasaporte Sanitario");
          }
          if (datos[0] == 4) {
            $("#text-paso").text("Paso 4. No requiere permisos para movilizarse por la comuna o entre comunas en paso 3, 4 y 5, en caso de tratarse de viajes interregionales se requiere Pasaporte Sanitario");
          }
          if (datos[0] == 5) {
            $("#text-paso").text("Paso 5. No requiere permisos para movilizarse por la comuna o entre comunas en paso 3, 4 y 5, en caso de tratarse de viajes interregionales se requiere Pasaporte Sanitario");
          }
          $("#text-etapa").text("Etapa: " + datos[1]);
          $("#text-poblacion").text("Población: " + datos[2]);
          //Dado que se muetran en graficos, estos datos no son necesario mostrarlos.
          //$("#text-activos").text("Casos activos: " + datos[3]);
          //$("#text-confT").text("Total casos confirmados: " + datos[4]);
          //$("#text-fallecidos").text("Total fallecidos: " + datos[5]);
      });
      $.post("consulta_grafs.php",
      {
        comuna: comuna
      },
      function(data){
          var datos = data.split(",");
          for (var i = 0; i < 28; i++) {
            if (i < 7) {
              fechas[i] = datos[i];
            } else if (i < 14) {
              casos_totales[i - 7] = parseInt(datos[i]);
            } else if (i < 21) {
              activos_comunal.push(parseInt(datos[i]));
            } else {
              fallecidos_totales[i - 21] = parseInt(datos[i]);
            }
          }   
          var firstgraf = document.getElementById("grafico1");

          Chart.defaults.global.defaultFontFamily = "Lato";
          Chart.defaults.global.defaultFontSize = 18;
          
          var dataFirst = {
              label: "Casos Confirmados Totales",
              data: casos_totales,
              lineTension: 0,
              fill: false,
              borderColor: 'blue'
            };
      
          var dataSecond = {
              label: "Fallecidos Totales",
              data: fallecidos_totales,
              lineTension: 0,
              fill: false,
            borderColor: 'red'
            };
      
          var fechaData = {
            labels: fechas,
            datasets: [dataFirst, dataSecond]
          };
      
          var chartOptions1 = {
            legend: {
              display: true,
              position: 'top',
              labels: {
                boxWidth: 80,
                fontColor: 'black'
              }
            }
          };
      
          var lineChart1 = new Chart(firstgraf, {
            type: 'line',
            data: fechaData,
            options: chartOptions1
          });
          var secondgraf = document.getElementById("grafico2");

          var activos = {
            label: "Casos activos",
            data: activos_comunal,
            lineTension: 0,
            fill: false,
            borderColor: 'green'
          };

          var fechaData = {
            labels: fechas,
            datasets: [activos]
          };

          var chartOptions2 = {
            legend: {
              display: true,
              position: 'top',
              labels: {
                boxWidth: 80,
                fontColor: 'black'
              }
            }
          };

          var lineChart2 = new Chart(secondgraf, {
            type: 'line',
            data: fechaData,
            options: chartOptions2
          });

      });
    }
    else alert ("Debe seleccionar una comuna");
    

  });
  
});
  
  
  
  
  /*  
          ---problemas resolviendo compatibilidad de codificacion de caracteres---
             
            //quitar los corchetes de los extremos, eliminar las comillas y volver un arreglo.
            var info = data.slice(1,-1).replace(/"/g, '').split(",");
            info[1] = info[1].replace(/u00f3/, "ó");
            $("#text-paso").text("Esta comuna esta en paso: " + info[0]);
            $("#text-etapa").text("Etapa: " + info[1]);
            $("#text-activos").text("Casos activos: " + info[2]);
            $("#text-pobla").text("Población: " + info[3]);
            $("#text-confT").text("Total casos confirmados: " + info[4]);
            $("#text-fallecidos").text("Total fallecidos: " + info[5]);
            
        });
      });
});
*/