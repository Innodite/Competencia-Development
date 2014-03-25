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
        <title>Registro De Competencias</title>
        <link rel="stylesheet" href="../css/cssCompetencia.css" type="text/css">
        <link rel="stylesheet" href="../css/cssGeneral.css" type="text/css">
        <script type="text/javascript" src="../js/utils.js"></script>
        <script type="text/javascript" src="../js/jsCompetencia.js"></script>
    </head>
    <body>
        <div align="center">
            <section id="contenedor">
                <?php include 'vistaMenu.php'; ?>
                <section id="competencia">
                    <h1>Registro de Competencias</h1>
                    <form> <!-- action="../controladores/ctrCompetencia.php" method="POST" -->
                        <table>
                            <tr>
                                <td><label>Fecha</label></td>
                                <td><label>Competencia</label></td>
                                <td><label>Categoria</label></td>
                                <td><label>% Premio</label></td>
                                <td><label>% Casa</label></td>
                                <td><label>Inscripcion</label></td>
                                <td><label>Vueltas</label></td>
                            </tr>
                            <tr>
                                <td><input id="date" type="date" name="dateFecha" value="" required></td>
                                <td><select id="tipo_comp"></select></td>
                                <td><select id="categoria"></select></td>
                                <td><input class="size" id="premio" type="text" name="txtPremio" onkeyup="evalPorcUp('premio','casa')" required></td>
                                <td><input class="size" id="casa" type="text" name="txtCasa" readonly="" required></td>
                                <td><input id="inscripcion" type="text" name="txtInscripcion" required></td>
                                <td><input class="size" id="rondas" type="text" name="txtVueltas" required></td>
                                <td>
                                    <img id="imgadd" title="Agregar" src="../img/add_med.png" onclick="cargar()">
                                    <img id="imgbus" title="Buscar" src="../img/lupa_med.png" onclick="buscar()">
                                </td>
                            </tr>
                        </table>
                    </form>
                </section>
                <div id="list"></div>
            </section>
        </div>
    </body>
</html>