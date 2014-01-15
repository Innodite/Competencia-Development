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
        <form > <!-- action="../controladores/ctrCompetencia.php" method="POST" -->
            <table>
                <tr>
                    <td class="truco"><label>Fecha</label></td>
                    <td class="truco"><label>Competencia</label></td>
                    <td class="truco"><label>Categoria</label></td>
                     <td class="truco"><label>% Premio</label></td>
                    <td class="truco"> <label>% Casa</label></td>
                    <td class="truco"><label>Vueltas</label></td>
                    
                </tr>
                <tr>
                    <td>
                        <input id="date" type="date" name="dateFecha" value="" required>
                    </td>
                    <td>
                        <select id="tipo_comp"></select>
                    </td>
                    <td>
                        <select id="categoria"></select>
                    </td>
                    <td>
                        <input id="premio" type="text" name="txtPremio" value="" onkeyup="evalPorcUp('premio','casa')" required>
                    </td>
                    <td>
                        <input id="casa" type="text" name="txtCasa" value="" readonly="" required>
                    </td>
                    <td>
                        <input id="rondas" type="text" name="txtVueltas" value="" required>
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

