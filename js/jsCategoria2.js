/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).on("ready", function() {
    //Agregar Categoria  
$('#imgadd').on('click', function() {
    var nombre = $('#nombre').val();
    var edadMin = $('#edadMin').val();
    var edadMax = $('#edadMax').val();
    var opc = 'IC';
    $.ajax({
            beforeSend: function(){
               $('.status').spin({top:3,left:3,radius:3,width:2,height:2,length:6}); 
                                },
            type:"POST",
            url:"../controladores/ctrCategoria.php",
            data: {
                   nombre: nombre, edadMin: edadMin, edadMax: edadMax, opc: opc
                    },
            success: function(resp){
                if(resp == 1){
                    
                    $('.status').html('<div id="frac"><img width=28 height=28 src="../img/op_exitosa.png"</div>');
                    $('.status #frac').fadeOut(3000);
                    $('#nombre').val('');
                    $('#edadMin').val('');
                    $('#edadMax').val('');
                }
                else{
                    $('.status').html('<div id="frac"><img width=28 height=28 src="../img/op_fracaso.png"</div>');
                    $('.status #frac').fadeOut(3000);  
                    }
                                    }
            });});//Fin Agregar Categoria
       
    //Buscar Lista de Categorias
        $('#imgbus').on("click",function(){
            
            
            
            
            
        });
    
});    
    
    
    
    
    
    
    
    
    
    
