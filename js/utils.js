/*Desarrollado por Innodite 
   RIF:  J-40270256-6
    Contacto
       Javier Urbano     0416-583.38.09
       Anthony Filgueira 0426-594.00.45
*/
function send_form(url, post_data){
 if(window.XMLHttpRequest){
  var ajaxResponse = new XMLHttpRequest();
 }else
  if(window.ActiveXObject){ // IE
   try{
    var ajaxResponse = new ActiveXObject("Msxml2.XMLHTTP");
   }catch(e){
    try {
     var ajaxResponse = new ActiveXObject("Microsoft.XMLHTTP");
    }catch(e){
     return false;
    }
   };
  };
  if(!ajaxResponse){
   return false;
  };
  if(post_data){
   ajaxResponse.open('POST', url, false);
   ajaxResponse.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   ajaxResponse.send(post_data);
  }else{
   ajaxResponse.open('GET', url, false);
   ajaxResponse.send(null);
  }
  if(ajaxResponse.status == 200){
   return ajaxResponse.responseText;
  }else{
   return false;
  };
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
/**
 * Funcion que valida formato de fecha para input date dd-mm-yyyy
 **
 * @param {String} id Identificador del Objeto DOM
 * @param {String} sp Caracter que separa dia-mes-año
 */
function getSeparator(id, sp){
    
    var n = document.getElementById(id).value.length;
    
    if (n > 0){
        if (!isNumber(document.getElementById(id).value.substr(n-1,n))){
            document.getElementById(id).value = document.getElementById(id).value.substr(0,--n);
        }
    }
    
    if (n === 2 || n === 5){
        document.getElementById(id).value = document.getElementById(id).value + sp;
    }
    if (n > 10){
        document.getElementById(id).value = document.getElementById(id).value.substr(0,10);
    }
}