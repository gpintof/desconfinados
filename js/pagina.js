$(function() {
  var regiones = {
    "Región Metropolitana" : ["Alhue", "Buin", "Calera de Tango", "Cerrillos", "Cerro Navia", "Colina", "Conchali", "Curacavi", "El Bosque", "El Monte", "Estacion Central", "Huechuraba", "Independencia", "Isla de Maipo", "La Cisterna", "La Florida", "La Granja", "La Pintana", "La Reina", "Lampa", "Las Condes", "Lo Barnechea", "Lo Espejo", "Lo Prado", "Macul", "Maipu", "Maria Pinto", "Melipilla", "Nuñoa", "Padre Hurtado", "Paine", "Pedro Aguirre Cerda", "Peñaflor", "Peñalolen", "Pirque", "Providencia", "Pudahuel", "Puente Alto", "Quilicura", "Quinta Normal", "Recoleta", "Renca", "San Bernardo", "San Joaquin", "San José de Maipo", "San Miguel", "San Pedro", "San Ramon", "Santiago", "Talagante", "Tiltil", "Vitacura"],
    "Valparaiso" : ["Algarrobo", "Cabildo", "Calera", "Calle Larga", "Cartagena", "Casablanca", "Catemu", "Concon", "El Quisco", "El Tabo", "Hijuelas", "Isla de Pascua", "Juan Fernandez", "La Cruz", "La Ligua", "Limache", "Llaillay", "Los Andes", "Nogales", "Olmue", "Panquehue", "Papudo", "Petorca", "Puchuncavi", "Putaendo", "Quillota", "Quilpue", "Quintero" , "Rinconada", "San Antonio", "San Esteban", "San Felipe", "Santa Maria", "Santo Domingo", "Valparaiso", "Villa Alemana", "Vina del Mar", "Zapallar"],
    "Coquimbo" : ["Andacollo", "Canela" ,"Combarbala" ,"Coquimbo" ,"Illapel", "La Higuera", "La Serena", "Los Vilos", "Monte Patria", "Ovalle", "Paiguano", "Punitaqui", "Rio Hurtado", "Salamanca", "Vicuña"]
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
    var comuna = $("#sel-com").val();
    $.post("consultas.php",
    {
      comuna: comuna
    },
    function(data){
        var datos = data.split(",");
        $("#text-paso").text("Esta comuna esta en paso: " + datos[0]);
        $("#text-etapa").text("Etapa: " + datos[1]);
        $("#text-activos").text("Casos activos: " + datos[2]);
        $("#text-pobla").text("Población: " + datos[3]);
        $("#text-confT").text("Total casos confirmados: " + datos[4]);
        $("#text-fallecidos").text("Total fallecidos: " + datos[5]);
    });
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