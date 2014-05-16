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
        var fecha = $('#fecha').val();  
        var competencia = $('#competencia').val();
        var opc = 'MD';
       
            $.post('../controladores/ctrReportes.php', {opc: opc,fecha: fecha}, function(respuesta) {
               
                url= '../modelos/clsDocumento.php?fecha='+fecha+'&comp='+competencia;
                $(location).attr('href',url);
                
            });
              
    });
});