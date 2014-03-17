/*Desarrollado por Innodite 
   RIF:  J-40270256-6
    Contacto
       Javier Urbano     0416-583.38.09
       Anthony Filgueira 0426-594.00.45
*/
function buscar(){
    var r = send_form("../controladores/ctrCategoria.php", "opc=BS&nombre=" + document.getElementById("nombre").value +
                                                                 "&agemin=" + document.getElementById("min").value    +
                                                                 "&agemax=" + document.getElementById("max").value);
    if (r!='NULL') document.getElementById("list").innerHTML = r;
}

function cargar(){
    var r = send_form("../controladores/ctrCategoria.php", "opc=IN&nombre=" + document.getElementById("nombre").value +
                                                                 "&agemin=" + document.getElementById("min").value    +
                                                                 "&agemax=" + document.getElementById("max").value);
    if (r) loadStore();
}

function actualizar(fila, id){
    var categoria = document.getElementById("tfc"+fila).value;
    var agemin    = document.getElementById("tfemin"+fila).value;
    var agemax    = document.getElementById("tfemax"+fila).value;
    var r = send_form("../controladores/ctrCategoria.php", "opc=UP&id=" + id + "&nombre=" + categoria + 
                                                                               "&agemin=" + agemin    +
                                                                               "&agemax=" + agemax);
    if (r){        
        document.getElementById("imgf"+fila).src = "../img/up_med.png";
        document.getElementById("imgf"+fila).onclick =  function(event){ modificar(fila, categoria ,agemin,agemax,id); };
        document.getElementById("lstable").rows[fila].cells[0].innerHTML = categoria;
        document.getElementById("lstable").rows[fila].cells[1].innerHTML = agemin;
        document.getElementById("lstable").rows[fila].cells[2].innerHTML = agemax;
    };
}

function modificar(fila,catgria,edmin,edmax,id){
    document.getElementById("lstable").rows[fila].cells[0].innerHTML = "<input id=tfc"+fila+"     name=tfc"+fila+" value='"+catgria+"'/>";
    document.getElementById("lstable").rows[fila].cells[1].innerHTML = "<input id=tfemin"+fila+"  name=tfemin"+fila+" value='"+edmin+"'/>";
    document.getElementById("lstable").rows[fila].cells[2].innerHTML = "<input id=tfemax"+fila+"  name=tfemax"+fila+" value='"+edmax+"'/>";
    document.getElementById("imgf"+fila).src = "../img/up_med_blue.png";
    document.getElementById("imgf"+fila).onclick =  function(event){ actualizar(fila, id); };
}

function eliminar(id){
    var r = send_form("../controladores/ctrCategoria.php", "opc=DL&id=" + id);
    if (r) loadStore();
}

function loadStore(){
    var r = send_form("../controladores/ctrCategoria.php", "opc=LS");
    if (r) document.getElementById("list").innerHTML = r;
}