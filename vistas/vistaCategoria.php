<?php
    session_start();
    if (!isset($_SESSION['perfil']))
        header("Location: ../index.php");
?>
<!--
Desarrollado por www.innodite.com
    RIF:  J-40270256-6
    Contacto
        Javier Urbano     0416-583.38.09
        Anthony Filgueira 0426-594.00.45
 
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Categoria</title>
        <!--<link rel="stylesheet" href="../css/cssCategoria.css" type="text/css">-->
         <link rel="stylesheet" href="../css/cssGeneral.css" type="text/css"/>
        <script type="text/javascript" src="../js/utils.js"></script>
        <script type="text/javascript" src="../js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="../js/spin.js"></script>
        <script type="text/javascript" src="../js/jquery.spin.js"></script>

       <script type="text/javascript" src="../js/jsCategoria2.js"></script>
        <script type="text/javascript" src="../js/jsCategoria.js"></script>

        
    </head>
    <body>
<!--::::::::::::::::::::::::INICIO HEADER Y MENÚ ::::::::::::::::::::::::::::-->
        <?php include_once './components/header.php'; ?>
<!--::::::::::::::::::::::::INICIO CONTENEDOR:::::::::::::::::::::::::::::::::::-->                
            <section class="ScrollContenedor">

<!--::::::::::::::::::::::::INICIO SESIÓN:::::::::::::::::::::::::::::::::::-->
<!--:::::::::::::::::::::::::::::: SESIÓN :::::::::::::::::::::::::::::::::::-->           
            <nav id="usuario-sesion">
                    <br></br>
                    <div>
                        <?php echo "".
                                ucfirst(strtolower($_SESSION['nombre']))." ".
                                ucfirst(strtolower($_SESSION['apellido']));
                        ?>
                    </div>
            </nav>
<!--::::::::::::::::::::::::FIN SESIÓN Y MENÚ:::::::::::::::::::::::::::::::::::-->
                 <br></br>
                 <h1>CATEGORIAS DE LAS COMPETENCIAS</h1>
                <section id="categoria">
                    
                        <form> <!-- ../controladores/ctrCategoria.php -->
                            <table>
                                <tr>
                                    <td><label>Nombre</label></td>
                                    <td><label>Edad M&iacute;nima</label></td>
                                    <td><label>Edad M&aacute;xima</label></td>
                                </tr>
                                <tr>                        
                                    <td><input id="nombre"     type="text" name="txtNombre" value="" autofocus required></td>
                                    <td><input id="edadMin"    type="text"  name="txtEdadMin" value="" required></td>
                                    <td><input id="edadMax"    type="text"  name="txtEdadMax" value="" required></td>                        
                                    <td>
                                       
                                         <img id="imgadd"  title="Agregar" src="../img/add_med.png" onclick="">
                                         <div id="cont"><div class="status"></div></div>
                                         <img id="imgbus"  title="Buscar"  src="../img/lupa_med.png" onclick="buscar()">
                                            
                                    </td>
                                    
                                                                                

                                       
                                  
                                </tr>
                            </table>                                
                        </form>
                </section>
                <div id="list"></div>
            </section>
<!-- :::::::::::::::::::::: FIN CONTENEDOR::::::::::::::::::::::::::::-->                  
<!--:::::::::::::::::::::::::::INICIO FOOTER ::::::::::::::::::::::::::::::::-->
    <?php include_once './components/footer.php'; ?>
    </body>
</html>

