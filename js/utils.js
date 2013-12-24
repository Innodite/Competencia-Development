/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
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
