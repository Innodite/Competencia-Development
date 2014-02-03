function buscarCompetencia(){
     var r = send_form("../controladores/ctrBarriles.php", "opc=BC&fecha=" + document.getElementById("fecha").value);
    if (r) document.getElementById("competencia").innerHTML = r;
 }
 
function iniciarComp(){
   var r = send_form("../controladores/ctrBarriles.php", "opc=IC&competencia=" + document.getElementById("competencia").value);
    if (r!='NULL'){ 
        document.getElementById("list").innerHTML = r;
        document.getElementById("fecha").readOnly='true';
        document.getElementById("competencia").disabled='true';
         document.getElementById("IC").src = "../img/pause7.png";
         document.getElementById("IC").onclick='false';
         document.getElementById("fecha").onkeyup='false';
         document.getElementById("fin").style.visibility='visible'; 
    }
                    }
function agregar(cont,id_inscripcion,competencia,ronda){
    var r = send_form("../controladores/ctrBarriles.php", "opc=AT&tiempo=" + document.getElementById("tiempof"+cont).value + 
                                                          "&id_inscripcion=" +id_inscripcion+
                                                          "&competencia=" +competencia+
                                                          "&ronda=" +ronda+
                                                          "&salida="+cont);
                                        
if (r!='NULL') {document.getElementById("rank").innerHTML = r;
    document.getElementById("agregarf"+cont).style.visibility='hidden';
    document.getElementById("tiempof"+cont).readOnly='true';
}
    
}
function rankGeneral(){
    var r = send_form("../controladores/ctrBarriles.php", "opc=RG");
    if (r) document.getElementById("rankG").innerHTML = r;
}
function nextRound(ronda,total,competencia){
    var r = send_form("../controladores/ctrBarriles.php", "opc=NR&competencia=" + competencia +
            "&ronda="+ronda+
            "&total="+total);
    if (r) {
        document.getElementById("list").innerHTML = r;
        rankGeneral();
            }
        }
function finComp(){
     var r = send_form("../controladores/ctrBarriles.php", "opc=FC&competencia=" + document.getElementById("competencia").value);
      if (r) {
         window.location = "../vistas/vistaCompetencia.php"
        
    }
 }