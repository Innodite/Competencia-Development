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
        <title>Reportes</title>
       
        <link rel="stylesheet" href="../css/cssGeneral.css" type="text/css">
        <script type="text/javascript" src="../js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="../js/utils.js"></script>
        <script type="text/javascript" src="../js/jsReportes.js"></script>
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
                 <h1>INSCRIPCION DE COMPETIDORES</h1>
        <table>
            <tr>
                <td><label>Desde</label></td>
                <td><label>Hasta</label></td>
                <td><label>Status</label></td>
                <td><label>Modalidad</label></td>
                <td><label>Buscar</label></td>
                
            </tr>
            <tr>
                <td><input type="date" id="fecha1" placeholder="dd-mm-yyyy" onkeyup="getSeparator('fecha1','-')"></td>
                <td><input type="date" id="fecha2" placeholder="dd-mm-yyyy" onkeyup="getSeparator('fecha2','-')"></td>
                <td>
                    <select name="sts" id="sts">
                        <option value="0">Todos</option>
                        <option value="VAL">Pendiente</option>
                        <option value="FC">Finalizada</option>
                    </select>
                </td>
                <td>
                    <select name="tcomp" id="tcomp">
                        <option value="0">Todas</option>
                        <option value="INDIVIDUAL">Individual</option>
                        <option value="GRUPO">Equipos</option>
                    </select>
                </td>
                <td><img id="IC" src="../img/lupa.png" width="30" height="30" title="Mostrar Competencias"></td>
            </tr>
        </table>
                <div id="list"><table></table></div>
        </section>
<!-- :::::::::::::::::::::: FIN CONTENEDOR::::::::::::::::::::::::::::-->                  
<!--:::::::::::::::::::::::::::INICIO FOOTER ::::::::::::::::::::::::::::::::-->
    <?php include_once './components/footer.php'; ?>
    </body>
</html>