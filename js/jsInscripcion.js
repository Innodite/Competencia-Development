/*Desarrollado por Innodite 
   RIF:  J-40270256-6
    Contacto
       Javier Urbano     0416-583.38.09
       Anthony Filgueira 0426-594.00.45
*/


function buscar(){
  var r = send_form("../controladores/ctrInscripcion.php", "opc=BS&txtCedula=" + document.getElementById("cedula").value +
                                                                 "&txtCompetencia=" + document.getElementById("competencia").value +
                                                                 "&nombre=" + document.getElementById("competidor").value +
                                                                "&edad=" + document.getElementById("edad").value);
   if (r) document.getElementById("list").innerHTML = r;
}
function cargar(){
    var r = send_form("../controladores/ctrInscripcion.php", "opc=IN&txtCedula=" + document.getElementById("cedula").value +
                                                                 "&txtCompetencia=" + document.getElementById("competencia").value +
                                                                 "&nombre=" + document.getElementById("competidor").value +
                                                                 "&edad=" + document.getElementById("edad").value +
                                                                 "&swper=" + document.getElementById("swper").value);
//    rs = JSON.parse(r);rs['R']
    if (r){
        clear();
        loadStore();
    }
}

function modificar(fila,id,costo){
    var ntc = document.getElementById("competencia").length;
    var strSelectTC = "", i=0;
    for (i=0;i<ntc;i++){
        strSelectTC = strSelectTC + "<option value="+document.getElementById("competencia").options[i].value+">"+document.getElementById("competencia").options[i].text+"</option>";
    }
    document.getElementById("lstable").rows[fila].cells[3].innerHTML = "<select id=tcomp"+fila+" name=tcomp"+fila+">" + strSelectTC + "</select>";
  
    
}

function eliminar(id){
     var r = send_form("../controladores/ctrInscripcion.php", "opc=DL&id=" + id);
     if (r) loadStore();
}

function verificarCi(){
    document.getElementById("competidor").value = "";
    document.getElementById("edad").value = "";
    var r = send_form("../controladores/ctrInscripcion.php", "opc=CHK&txtCedula=" + document.getElementById("cedula").value);
    if (r!=0){
        var t = JSON.parse(r);
        document.getElementById("competidor").value = t['nombre'];
        document.getElementById("edad").value = t['edad'];
        
        document.getElementById("competidor").setAttribute("readonly", "");
        document.getElementById("edad").setAttribute("readonly", "");
        document.getElementById("swper").value = 0;
              
    }else{
        document.getElementById("competidor").readOnly= false;
        document.getElementById("edad").readOnly=false;
        document.getElementById("swper").value = 1;
    } 
   
}
function clear(){
    document.getElementById("cedula").value = "";
    document.getElementById("competidor").value = "";
    document.getElementById("edad").value = "";
    document.getElementById("competencia").value = 0;
   
   document.getElementById("swper").value = 0;
   document.getElementById("competidor").readOnly= false;
    document.getElementById("edad").readOnly=false;
}
function loadCompetencia(){
    var r = send_form("../controladores/ctrInscripcion.php", "opc=LST&edad=" +document.getElementById("edad").value);
    if (r) document.getElementById("competencia").innerHTML = r;
}
function loadStore(){
    var r = send_form("../controladores/ctrInscripcion.php", "opc=LS");
    if (r) document.getElementById("list").innerHTML = r;
}
window.onload = function(){    
   loadCompetencia();
  
}



