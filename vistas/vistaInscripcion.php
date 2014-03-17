<!--Desarrollado por Innodite 
    RIF:  J-40270256-6
    Contacto
        Javier Urbano     0416-583.38.09
        Anthony Filgueira 0426-594.00.45
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
       
        <title>Inscripci&oacute;n</title>
        <link rel="stylesheet" href="../css/cssInscripcion.css" type="text/css">
 
        <script type="text/javascript" src="../js/utils.js"></script>
        <script type="text/javascript" src="../js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="../js/jsModIns.js"></script>
<!--        <script type="text/javascript" src="../js/jsInscripcion.js"></script>-->
       
    </head>
    <body>
       <div align="center">
        <section id="contenedor">
            <?php include 'vistaMenu.php'; ?>
        <section id="inscripcion">
                <h1>Inscripciones</h1>
        <form> <!-- action="../controladores/ctrInscripcion.php" method="POST" -->
            <div id="mi">
            <table>
                
                 
                <tr>
                    <td>
                       I  <input id="i" type="radio" name="asdf" value="i" checked>
                       G  <input id="g" type="radio" name="asdf" value="g">
                    </td>
                
                    
                </tr>
                
                    <tr>
                    <td>Cedula</td>
                    <td>Competidor</td>
                    <td>Edad</td>
                    <td>Competencia</td>
                    
                </tr>
                <tr>
                
                    <td><input  class="input" id="cedula"      type="text"                                required></td>
                    <td><input  class="input" id="nombre"      type="text"                                required></td>
                    <td><input  class="input" id="edad"        type="text"                                required></td>
                    <td><select class="input" id="competencia"></select>                                           </td>                     
                    <td>
                        <input id="comp" type="hidden" value="N">
                        <img id="imgadd"  title="Agregar" src="../img/add_med.png" >
                        <img id="imgbus"  title="Buscar"  src="../img/lupa_med.png">
                    </td>
                </tr>
               
                
            </table>
                </div>
            <div id="mg" hidden>
            <table>
                <tr><td> 
                         <input id="i2" type="radio" name="asdf2" value="i2">
                         <input id="g2" type="radio" name="asdf2" value="g2">
                    </td></tr>
               
                
            </table>
                </div>
            
        </form>
                 
                </section>
            
               
                 <div id="list"></div>
                </section>
            </div>
    </body>
</html>
