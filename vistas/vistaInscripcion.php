<?php
    session_start();
    if (!isset($_SESSION['perfil']))
        header("Location: ../index.php");
?>
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
        <link rel="stylesheet" href="../css/cssGeneral.css" type="text/css"/>
 

        <script type="text/javascript" src="../js/utils.js"></script>
        <script type="text/javascript" src="../js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="../js/jsModIns.js"></script>
<!--        <script type="text/javascript" src="../js/jsInscripcion.js"></script>-->
       
    </head>
    <body>
         <header id="logo-menu">
              <a href= "vistaPrincipal.php"><img id="logo" src="../img/asovaqueros.png"/></a>
          
        </header> 
<!--::::::::::::::::::::::::INICIO CONTENEDOR:::::::::::::::::::::::::::::::::::-->                
        <section id="contenedor">

<!--::::::::::::::::::::::::INICIO SESIÓN Y MENÚ:::::::::::::::::::::::::::::::::::-->
<!--:::::::::::::::::::::::::::::: SESIÓN :::::::::::::::::::::::::::::::::::-->           
            <nav id="usuario-sesion">
                    <br></br>
                    <div>
                        <?php echo "".
                                ucfirst(strtolower($_SESSION['nombre']))." ".
                                ucfirst(strtolower($_SESSION['apellido']));
                        ?>
                    </div>
 <!--::::::::::::::::::::::::::::::::MENÚ:::::::::::::::::::::::::::::::::::-->             
                    <div id="posicion-menu"><?php include 'vistaMenu.php';?></div>
                    <div> <a href="../sesion.php"><img id="logo-off" src="../img/off.png" title="Salir"></a></div>
            </nav>
<!--::::::::::::::::::::::::FIN SESIÓN Y MENÚ:::::::::::::::::::::::::::::::::::-->
                 <br></br>
                 <h1>INSCRIPCION DE COMPETIDORES</h1>
                 <section>                
        <form> <!-- action="../controladores/ctrInscripcion.php" method="POST" -->
          <div id="mi"><!--Inicio Modalidad Individual-->
            <table>
                <tr>
                    <td>
                       I<input id="i" type="radio" name="asdf" value="i" checked>
                       G<input id="g" type="radio" name="asdf" value="g">
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
                            </div> <!-- Fin Modalidad Individual-->
                            <div id="mg" hidden><!-- Inicio Modalidad Grupal-->
            <table>
                <tr>
                    <td> 
                        I<input id="i2" type="radio" name="asdf2" value="i2">
                        G<input id="g2" type="radio" name="asdf2" value="g2">
                    </td>
                </tr>
               <tr>
                    <td>Equipo</td>
                    <td>Competencia</td> 
               </tr>
               <tr>
                   <td><select class="input" id="equipos"></select></td>
                   <td><select class="input" id="competenciaE"></select> </td>
                   <td>
                        <img id="imgaddE"  title="Agregar" src="../img/add_med.png" >
                        <img id="imgbusE"  title="Buscar"  src="../img/lupa_med.png">
                   </td>
               </tr>
            </table>
                            </div>   <!--Fin Modalidad Grupal-->                         
        </form>
                </section>
            <div id="list"><table></table></div>
                </section>
<!-- :::::::::::::::::::::: FIN CONTENEDOR::::::::::::::::::::::::::::-->                  
        <footer>                
            <p id="footer">Copyright © 2014 Western Intelligent System Venezuela</p>
        </footer>         
    </body>
</html>
