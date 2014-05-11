<?php
    session_start();
    if (!isset($_SESSION['perfil']))
        header("Location: ../index.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Crear Equipo</title>
        <link rel="stylesheet" href="../css/cssGeneral.css" type="text/css">
        <script type="text/javascript" src="../js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="../js/utils.js"></script>
        <script type="text/javascript" src="../js/jsCrearEquipo.js"></script>
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
                 <h1>CREAR EQUIPOS</h1>
        <section id="categoria">
            <form> 
                <table>
                    <tr>
                                    

                        <td style="text-align:left; padding-top:8px;">
                            
                            <label>Nombre de Equipo</label>&nbsp;&nbsp;
                            <input style="text-transform: uppercase" type="text" name="nomb_equipo" id="nomb_equipo" onkeyup="buscarEquipo()" />&nbsp;&nbsp;&nbsp;&nbsp;
                            <img id="imgbus"  title="Buscar Equipo" src="../img/lupa_med.png" onclick="buscarEquipo()"/>
                            <input type="hidden" name="swper" id="swper" value="0"/>
                        </td>
                    </tr>
                </table>
                <div id="listado">
                    <table id="listable">
                        <tr>
                                    <td colspan="4">
                                            <label>Integrantes del Equipo</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <img id="imgadd"  title="Agregar Integrante" src="../img/add_med.png" onclick="addFila()"/>
                                    </td>
                        </tr>
                        <tr>
                                    <td><label>C&eacute;dula</label></td>
                                    <td><label>Competidor</label></td>
                                    <td><label>Edad</label></td>
                                    <td></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="cedula_0" id="cedula_0" onkeyup="verificarCi(0)"/></td>
                            <td><input type="text" name="competidor_0" id="competidor_0"/></td>
                            <td><input type="text" name="edad_0" id="edad_0"/></td>
                            <td style="text-align:left;">
                                <img id="imgsav_0"  title="Guardar Cambios" src="../img/save.png" onclick="saveIntegrante(0)" style="width:28px; height:28px">
                                <!--<img id="imgdel_0"  title="Quitar Integrante"  src="../img/del_med.png" onclick="delFila(0)"/>-->
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </section>
            <div id="list"></div>
        </section>
<!-- :::::::::::::::::::::: FIN CONTENEDOR::::::::::::::::::::::::::::-->                  
<!--:::::::::::::::::::::::::::INICIO FOOTER ::::::::::::::::::::::::::::::::-->
    <?php include_once './components/footer.php'; ?>
    </body>
</html>

