/*Desarrollado por Innodite 
   RIF:  J-40270256-6
    Contacto
       Javier Urbano     0416-583.38.09
       Anthony Filgueira 0426-594.00.45
*/
function buscar(){

  var r = send_form("../controladores/ctrModoCompetencia.php", "opc=BS&nombre=" + document.getElementById("txtNombre").value);
   if (r) document.getElementById("list").innerHTML = r;
}

function cargar(){
    var r = send_form("../controladores/ctrModoCompetencia.php", "opc=IN&nombre=" + document.getElementById("txtNombre").value + 
                                                                        "&modalidad="  +          document.getElementById("lblModalidad").value);
    if (r) loadStore();
}

function actualizar(fila, id){
    var valor = document.getElementById("tf"+fila).value;
    var r = send_form("../controladores/ctrModoCompetencia.php", "opc=UP&id=" + id + "&nombre=" + valor);
    if (r){        
        document.getElementById("imgf"+fila).src = "../img/up_med.png";
        document.getElementById("imgf"+fila).onclick =  function(event){ modificar(fila, valor ,id); };
        document.getElementById("lstable").rows[fila].cells[0].innerHTML = valor;
    };
}

function modificar(fila,value,id){
    document.getElementById("lstable").rows[fila].cells[0].innerHTML = "<input id=tf"+fila+" name=tf"+fila+" value='"+value+"'/>";
    document.getElementById("imgf"+fila).src = "../img/up_med_blue.png";
    document.getElementById("imgf"+fila).onclick =  function(event){ actualizar(fila, id); };
}

function eliminar(id){
    var r = send_form("../controladores/ctrModoCompetencia.php", "opc=DL&id=" + id);
    if (r) loadStore();
}

function loadStore(){
    var r = send_form("../controladores/ctrModoCompetencia.php", "opc=LS");
    if (r) document.getElementById("list").innerHTML = r;
}

window.onload = function(){
  
}