/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var listItem;
function buscar(){
    document.getElementById("list").innerHTML = "";
    var r = send_form("../controladores/ctrGCompetencia.php", "opc=BSC&desde=" + document.getElementById("tfdesde").value + 
                                                                                                   "&hasta=" + document.getElementById("tfhasta").value + 
                                                                                                   "&categoria=" + document.getElementById("categoria").value );
    if (r){
        document.getElementById("competencias").innerHTML = r;
        document.getElementById("competencias").disabled = false;
        document.getElementById("imgchek").onclick = function(event){ check(); };
    }
}

function check(){    
    if (parseInt(document.getElementById("competencias").value) != 0){
        document.getElementById("vuelta").value = 1;        
    	var r = send_form("../controladores/ctrGCompetencia.php", "opc=LSI&id=" + document.getElementById("competencias").value +
                                                                         "&vuelta=" + document.getElementById("vuelta").value);
    	if (r){
                    document.getElementById("list").innerHTML = r;
                    document.getElementById("competencias").disabled = true;
                    document.getElementById("imgchek").onclick = false;
                }
    }
}

function next(){
    if (parseInt(document.getElementById("competencias").value) != 0){
        var r = send_form("../controladores/ctrGCompetencia.php", "opc=LSI&id=" + document.getElementById("competencias").value +
                                                                                                                    "&vuelta=" + document.getElementById("vuelta").value);
        if (r) document.getElementById("list").innerHTML = r;
    }
}

function setTime(id, ronda,pos){
    if (document.getElementById("tftime"+pos).value != ""){
     var r = send_form("../controladores/ctrGCompetencia.php", "opc=ST&id="+id+"&ronda="+ronda+"&time="+ document.getElementById("tftime"+pos).value +
                                                                                                  "&competencia="+ document.getElementById("competencias").value);
        t = JSON.parse(r);
        if (t['R']){
         var i;   
         document.getElementById("imgadd"+pos).style.visibility = "hidden";
         document.getElementById("tftime"+pos).readOnly= true;
         for (i=0; i < t['POSICIONES'].length; i++){
             document.getElementById("rk"+t['POSICIONES'][i]['id']).innerHTML = "En Ronda: " + t['POSICIONES'][i]['posfinal'];
         }
         for (i=0; i < t['POSICIONES'].length; i++){
             document.getElementById("gk"+t['GENERAL'][i]['id']).innerHTML = "General: " + t['GENERAL'][i]['posfg'];
         }
         document.getElementById("valuinsc").value = parseInt(document.getElementById("valuinsc").value) + 1;
         if ( parseInt(document.getElementById("ttalinsc").value) == parseInt(document.getElementById("valuinsc").value)){
             if ( parseInt(document.getElementById("nvmax").value) >parseInt(document.getElementById("vuelta").value)){
                 document.getElementById("vuelta").value = parseInt(document.getElementById("vuelta").value) + 1;
                 document.getElementById("rrondas").innerHTML = document.getElementById("vuelta").value+"/"+
                                                                                                   document.getElementById("nvmax").value;
                 document.getElementById("valuinsc").value = 0;
                 document.getElementById("imgnxt").style.visibility = "visible";
                 document.getElementById("imgnxt").onclick = function(event){ /*setNext(t['POSICIONES']);*/ next(); };
             }            
         }
        }   
    }        
}

function setNext(vpos){     
    listItem = vpos;
    for (var jk=0; jk < vpos.length; jk++){
        document.getElementById("tftime"+(jk+1)).value = "";
        document.getElementById("tftime"+(jk+1)).readOnly= false;
        document.getElementById("imgadd"+(jk+1)).style.visibility = "visible";             
        document.getElementById("imgadd"+(jk+1)).onclick = function(event){ 
                        var item = this.id.substring(6);
                         setTime(parseInt(listItem[(item-1)]['id']) , parseInt(document.getElementById("vuelta").value) , item);
        };
        document.getElementById("rk"+vpos[jk]['id']).innerHTML = "";
        document.getElementById("lstable").rows[(jk+2)].cells[4].innerHTML = document.getElementById("vuelta").value;
    }
}

function loadCategoria(){
    var r = send_form("../controladores/ctrCompetencia.php", "opc=LSC");
    if (r) document.getElementById("categoria").innerHTML = r;
}

window.onload = function(){    
    loadCategoria();
}
