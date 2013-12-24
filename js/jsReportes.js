function buscarCompetencia(){
    var r = send_form("../controladores/ctrReportes.php", "opc=BC&fecha=" + document.getElementById("fecha").value);
    if (r) document.getElementById("competencia").innerHTML = r;
    
}
function mostrarCompetencia(){
    
}