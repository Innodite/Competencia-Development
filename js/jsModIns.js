
$(document).on("ready",function (){
   
  //Funciones para Cambiar De Modalidad Individual a Grupal  
    $('input[name=asdf]:radio').on("change",function(){
        if($('input[name=asdf]:radio:checked').val()=='g'){
            $('#mi').hide();
            $('input[id=g]:radio').prop("checked",false);
            $('#mg').show();
            $('input[id=g2]:radio').prop("checked",true);}});
    $('input[name=asdf2]:radio').on("change",function(){
        if($('input[name=asdf2]:radio:checked').val()=='i2'){
            $('#mg').hide();
            $('input[id=i2]:radio').prop("checked",false);
            $('#mi').show();
            $('input[id=i]:radio').prop("checked",true);}   });
//Funcion para validar si el Competidor existe
    $('#cedula').on('keyup',function(){

        var cedula = $('#cedula').val();
        var opc = 'CHK';
    
        $.post('../controladores/ctrIndividual.php',{cedula:cedula,opc:opc},function(respuesta){
            if(respuesta != 0){
                                competidor = JSON.parse(respuesta);    
                                $('#nombre').val(competidor.nombre);
                                $('#nombre').prop('readonly',true);
                                $('#edad').val(competidor.edad);
                                $('#edad').prop('readonly',true);
                                $('#comp').attr("value","E");
                                $().cargarCompetencia();
                                }
            else{ 
                $('#nombre').val("");
                $('#nombre').prop('readonly',false);
                $('#edad').val("");
                $('#edad').prop('readonly',false);
                $('#competencia').empty();
                $('#comp').attr("value","N");
                }                                          });});
//Funcion para cargar las competencias segun la edad del competidor cuando el mismo existe
$.fn.cargarCompetencia=function(){
    var edad = $('#edad').val();
    var opc  = 'LSTCI';
    $.post('../controladores/ctrIndividual.php',{edad:edad,opc:opc},function(respuesta){
         
        if(respuesta!=0){
                competencia = JSON.parse(respuesta);
                $.each(competencia,function(index,valor){
                    $('#competencia').append("<option value="+valor['id_competencia']+">"+valor['nombre']+"</option>");
                                                        });
                        }
        else{
            $('#competencia').empty();
            }   });         }
//Funcion para cargar las competencias segun la edad del competidor cuando el mismo NO existe
$('#edad').on('keyup',function(){
    $().cargarCompetencia();
});
//Funcion para Inscribir Competidor
$('#imgadd').on('click',function(){
    var cedula      = $('#cedula').val();
    var nombre      = $('#nombre').val();
    var edad        = $('#edad').val();
    var competencia = $('#competencia').val();
    var comp        = $('#comp').attr('value');
    var opc         = 'IC';
    $.post('../controladores/ctrIndividual.php',{cedula:cedula,nombre:nombre,edad:edad,competencia:competencia,opc:opc,comp:comp},function(respuesta){
        if(respuesta ==1){
            $('#cedula').val('');
            $('#nombre').val('');
            $('#edad').val('');
            $('#competencia').empty();
        }
        
    });
    
});
});

