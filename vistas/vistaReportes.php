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
                <td><label>Fecha de Competencia</label></td>
                <td><label>Competencia</label></td>
                <td><label>Buscar Competencia</label></td>
                
            </tr>
            <tr>
                <td><input type="date" id="fecha" onkeyup="buscarCompetencia()"></td>
                <td><select id="competencia"></select></td>
                <td><img id="IC" src="../img/play11.png" width="30" height="30" title="Mostrar Competencia"></td>
                <td> 
                    <div id="fin" style="visibility:hidden">
                        <img id="FC" src="../img/log.png" width="30" height="30" onclick="finComp()" title="Finalizar Competencia">
                    </div>
                </td>
            </tr>
        </table>
                <div id="list"></div>
                <aside id="rankings">
                    <article><div id="rank"></div></article>
                    <article id="general"><div id="rankG"></div></article>
                </aside>
        </section>
<!-- :::::::::::::::::::::: FIN CONTENEDOR::::::::::::::::::::::::::::-->                  
<!--:::::::::::::::::::::::::::INICIO FOOTER ::::::::::::::::::::::::::::::::-->
    <?php include_once './components/footer.php'; ?>
    </body>
</html>