var filas = 0;

function buscarEquipo(){
    r = send_form("../controladores/ctrCrearEquipo.php", "opc=BSE&name="+document.getElementById("nomb_equipo").value);
    rs = JSON.parse(r);
    filas = (rs['rows'] > 0) ? (rs['rows']-1) : 0;
    document.getElementById("listado").innerHTML = rs['data'];
}

function verificarCi(fila){
    document.getElementById("competidor_"+fila).value = "";
    document.getElementById("edad_"+fila).value = "";
    var r = send_form("../controladores/ctrInscripcion.php", "opc=CHK&txtCedula=" + document.getElementById("cedula_"+fila).value);
    if (r!=0){
        var t = JSON.parse(r);
        document.getElementById("competidor_"+fila).value = t['nombre'];
        document.getElementById("edad_"+fila).value = t['edad'];
        
        document.getElementById("competidor_"+fila).setAttribute("readonly", "");
        document.getElementById("edad_"+fila).setAttribute("readonly", "");
        document.getElementById("swper").value = 0;
            
    }else{
        document.getElementById("competidor_"+fila).readOnly= false;
        document.getElementById("edad_"+fila).readOnly=false;
        document.getElementById("swper").value = 1;
    }
}

function validaIntegranteEquipo(idx){
    if (document.getElementById("nomb_equipo").value.length     == 0 ||
        document.getElementById("cedula_"+idx).value.length     == 0 ||
        document.getElementById("competidor_"+idx).value.length == 0)
        return false;
    return true;
}

function saveIntegrante(fila){
    if (validaIntegranteEquipo(fila)){
        r = send_form("../controladores/ctrCrearEquipo.php", "opc=IN&name="+document.getElementById("nomb_equipo").value +
                                                               "&cedula="+document.getElementById("cedula_"+fila).value+
                                                               "&competidor="+document.getElementById("competidor_"+fila).value+
                                                               "&edad="+document.getElementById("edad_"+fila).value);
        rs = JSON.parse(r);
        if (rs['rs']){
            //document.getElementById("imgsav_"+fila).style.visibility = 'hidden';
            buscarEquipo();
        }
    }
}

function addFila(){
    $("#listable").append("<tr><td><input type='text' name='cedula_"+(++filas)+"' id='cedula_"+(filas)+"' onkeyup='verificarCi("+(filas)+")'/></td>"+
                              "<td><input type='text' name='competidor_"+(filas)+"' id='competidor_"+(filas)+"'/></td>"+
                              "<td><input type='text' name='edad_"+(filas)+"' id='edad_"+(filas)+"'/></td>"+
                              "<td style='text-align:left;'><img id='imgsav_"+(filas)+"'  title='Guardar Cambios' src='../img/save.png' onclick='saveIntegrante("+(filas)+")' style='width:28px; height:28px'/></td>"+
                          "</tr>");
    //"<img id='imgdel_"+(filas)+"'  title='Quitar Integrante'  src='../img/del_med.png' onclick='delFila("+(filas)+")'/>"+
}

function delFila(idx,id){
    var r = send_form("../controladores/ctrCrearEquipo.php", "opc=DL&id="+id);
    rs = JSON.parse(r);
    if (rs['rs']){
        var ob = document.getElementById("imgdel_"+idx);
        var parent = $(ob).parents().parents().get(0);
        $(parent).remove();
    }
}