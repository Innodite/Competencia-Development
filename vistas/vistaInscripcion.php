<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscripci&oacute;n</title>
        <link rel="stylesheet" href="../css/cssInscripcion.css" type="text/css">
        <script type="text/javascript" src="../js/utils.js"></script>
        <script type="text/javascript" src="../js/jsInscripcion.js"></script>
    </head>
    <body>
       <div align="center">
        <section id="contenedor">
            <?php include 'vistaMenu.php'; ?>
        <section id="inscripcion">
                <h1>Inscripciones</h1>
        <form> <!-- action="../controladores/ctrInscripcion.php" method="POST" -->
            <table>
                <tr>
                    <td>Cedula</td>
                    <td>Competidor</td>
                    <td>Edad</td>
                    <td>Competencia</td>
                    <td>Costo</td>
                </tr>
                <tr>
                    <td><input id="cedula"  type="text"  onkeyup="verificarCi()" name="txtCedula" value="" required></td>
                    <td><input id="competidor" type="text"  name="txtCompetidor" value="" required></td>
                    <td><input id="edad" type="text" name="txtEdad" onkeyup="loadCompetencia()"  value="" required></td>
                    <td><select id="competencia"></select></td>                     
                    <td>
                        <input id="costo" type="text" name="txtCosto" value="" required>
                        <input type="hidden" name="swper" id="swper" value="0">
                    </td>  
                    <td>
                        <img id="imgadd"  title="Agregar" src="../img/add_med.png" onclick="cargar()">
                        <img id="imgbus"  title="Buscar"  src="../img/lupa_med.png" onclick="buscar()">
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