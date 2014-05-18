/*Desarrollado por Innodite 
   RIF:  J-40270256-6
    Contacto
       Javier Urbano     0416-583.38.09
       Anthony Filgueira 0426-594.00.45
*/
function buscarCompetencia(){
    var r = send_form("../controladores/ctrReportes.php", "opc=BC&fecha=" + document.getElementById("fecha").value);
    if (r) document.getElementById("competencia").innerHTML = r;
    
}

function mostrarCompetencia(){
     var r = send_form("../controladores/ctrReportes.php", "opc=MD");
    if (r) document.getElementById("competencia").innerHTML = r;
}

$(document).on("ready", function() {
    
    
      $('#IC').on('click', function() {
        var fecha1 = $('#fecha1').val();  
        var fecha2 = $('#fecha2').val();
        var tcomp  = $('#tcomp').val();
        var sts    = $('#sts').val();
        
        var opc = 'BC';
       
            $.post('../controladores/ctrReportes.php', {opc: opc,fecha1: fecha1,fecha2: fecha2,tcomp: tcomp,sts: sts}, function(respuesta) {
                reportsC = JSON.parse(respuesta);
                clearList();
                // head tabla
                $('#list table').append("<tr><td class='truco'>Fecha</td><td class='truco'>Status</td><td class='truco'>Modalidad</td><td class='truco'>Competencia</td><td></td></tr>");
                $.each(reportsC, function(index, valor) {
                    imagen = "";
                    if (valor['sts'] === 'FINALIZADA'){
                        imagen = "<a href='../modelos/clsDocumento.php?comp="+valor['id']+"&fecha="+valor['fecha']+"&modalidad="+valor['modalidad']+"&nombre="+valor['nombre']+"' target='_blank'>\n\
                                    <img id='rp"+index+"'  title='Reporte'  src='../img/ICO-PDF.png' width='20px'>\n\
                                  </a>";
                    }
                    $('#list table').append("<tr><td>"+valor['fecha']+"</td><td>"+valor['sts']+"</td><td>"+valor['modalidad']+"</td><td>"+valor['nombre']+"</td><td>"+imagen+"</td></tr>");
                });
            });
              
    });
    
    function clearList(){
        $('#list').empty();
        $('#list').html("<table></table>");
    }
});