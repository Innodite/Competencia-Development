/*Desarrollado por Innodite 
   RIF:  J-40270256-6
    Contacto
       Javier Urbano     0416-583.38.09
       Anthony Filgueira 0426-594.00.45
*/
function buscarCompetencia(){
    var r = send_form("../controladores/ctrCompetencias.php", "opc=BC&fecha=" +document.getElementById("fecha").value+
                                                              "&modalidad=" +document.getElementById("modalidad").value);
    
        if (r) document.getElementById("competencia").innerHTML = r;
 }

function volver(){
   location.href="../vistas/vistaCompetencia.php";
}
function iniciarCompetencia(){
    
   var r = send_form("../controladores/ctrCompetencias.php", "opc=IC&id_competencia=" +document.getElementById("competencia").value+
                                                                   "&modalidad=" +document.getElementById("modalidad").value);
            if (r!=0){                                                     
            document.getElementById("list").innerHTML = r;
            document.getElementById("fecha").readOnly='true';
            document.getElementById("competencia").disabled='true';
            document.getElementById("IC").src = "../img/pause7.png";
            document.getElementById("IC").onclick='false';
            document.getElementById("fecha").onkeyup='false';
            document.getElementById("fin").style.visibility='visible';
            document.getElementById("volver").style.visibility='hidden';
            document.getElementById("modalidad").disabled='true'; 
                    }       }
function agregar(cont,id_inscripcion,id_competencia,ronda){
    var r = send_form("../controladores/ctrCompetencias.php", "opc=AT&tiempo=" + document.getElementById("tiempof"+cont).value + 
                                                          "&id_inscripcion=" +id_inscripcion+
                                                          "&id_competencia=" +id_competencia+
                                                          "&ronda=" +ronda+
                                                          "&salida="+cont+
                                                          "&modalidad=" +document.getElementById("modalidad").value);
                                        
if (r!=0) {
    document.getElementById("rank").innerHTML = r;
    document.getElementById("agregarf"+cont).style.visibility='hidden';
    document.getElementById("tiempof"+cont).readOnly='true';
        primeraDivision();
        segundaDivision();
        terceraDivision();
                }                                       }
            
function nextRound(ronda,total,id_competencia){
    var r = send_form("../controladores/ctrCompetencias.php", "opc=NR&id_competencia="+id_competencia+
                                                                "&ronda="+ronda+
                                                                "&total="+total+
                                                                "&modalidad=" +document.getElementById("modalidad").value);
    if (r!=0) {
        document.getElementById("list").innerHTML = r;
        primeraDivision();
        segundaDivision();
        terceraDivision();
            }
        }
function primeraDivision(){
     var r = send_form("../controladores/ctrCompetencias.php", "opc=PD&modalidad=" +document.getElementById("modalidad").value+
                                                                            "&id_competencia="+document.getElementById("competencia").value);
    if (r) document.getElementById("primeraD").innerHTML = r;
}
function segundaDivision(){
     var r = send_form("../controladores/ctrCompetencias.php", "opc=SD&modalidad=" +document.getElementById("modalidad").value+
                                                                            "&id_competencia="+document.getElementById("competencia").value);
    if (r) document.getElementById("segundaD").innerHTML = r;
}
function terceraDivision(){
     var r = send_form("../controladores/ctrCompetencias.php", "opc=TD&modalidad=" +document.getElementById("modalidad").value+
                                                                            "&id_competencia="+document.getElementById("competencia").value);
    if (r) document.getElementById("terceraD").innerHTML = r;
}

function agregarTE(cont,id_inscripcion,id_competencia,ronda){
    var r = send_form("../controladores/ctrCompetencias.php", "opc=AT&tiempo=" + document.getElementById("tiempof"+cont).value +
                                                            "&becerros=" + document.getElementById("becerrof"+cont).value +
                                                            "&numero=" +document.getElementById("numerof"+cont).value+
                                                          "&id_inscripcion=" +id_inscripcion+
                                                          "&id_competencia=" +id_competencia+
                                                          "&ronda=" +ronda+
                                                          "&salida="+cont+
                                                          "&modalidad=" +document.getElementById("modalidad").value);
                                        
if (r!=0) {
    document.getElementById("rank").innerHTML = r;
    document.getElementById("agregarf"+cont).style.visibility='hidden';
    document.getElementById("tiempof"+cont).readOnly='true';
                }                                       }
function nextRoundE(ronda,total,id_competencia){
    var r = send_form("../controladores/ctrCompetencias.php", "opc=NR&id_competencia="+id_competencia+
                                                                "&ronda="+ronda+
                                                                "&total="+total+
                                                                "&modalidad=" +document.getElementById("modalidad").value);
    if (r!=0) {
        document.getElementById("list").innerHTML = r;
                }
        }
function finComp(){
     var r = send_form("../controladores/ctrCompetencias.php", "opc=FC&id_competencia=" + document.getElementById("competencia").value+
                                                                     "&modalidad=" +document.getElementById("modalidad").value);
      if (r) {
         window.location = "../vistas/vistaCompetencia.php"
        
    }
 }                
