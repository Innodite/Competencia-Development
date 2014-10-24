/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).on("ready", function() {
    
    var opc = 'MR';
    var id = $('#nombre').val();
     function clearList(){
        $('#list').empty();
        $('#list').html("<table></table>");
    }
    
    $('#imgbus').on('click', function() {
        clearList();
     $.post('../controladores/ctrResultado.php', {id: id, opc: opc}, function(respuesta) {
            if (respuesta != 0) {
             resultado = JSON.parse(respuesta);
             $('#list table').append("<tr><th>NOMBRE</th><th>BECERRO</th><th>ENCIERRO</th><th>TIEMPO</th></tr>");
             $.each(resultado, function(index, valor) {
                  
                   $('#list table').append("<tr><td>"+ valor['nombre']+"</td><td>"+valor['numero']+"</td><td>"+valor['becerro']+"</td><td>"+valor['tiempo']+"</td></tr>");
                  
                });
            }
     });
    
    });
    
    
    
    
    
});