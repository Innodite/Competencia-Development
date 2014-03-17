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
    
}