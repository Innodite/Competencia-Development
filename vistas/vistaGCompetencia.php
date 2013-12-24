<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Competencia</title>
        <link rel="stylesheet" href="../css/cssGCompetencia.css" type="text/css">
        <script type="text/javascript" src="../js/utils.js"></script>
        <script type="text/javascript" src="../js/jsGCompetencia.js"></script>
    </head>
    <body>
        <div align="center">
        <section id="contenedor">
        <?php include 'vistaMenu.php'; ?>
        <section id="gcompetencia">
            <h1>Iniciar Competencia</h1>
            <form>
                <table>
                    <tr>
                        <td><label>Desde</label></td>
                        <td><label>Hasta</label></td>
                        <td><label>Categor&iacute;a</label></td>
                        <td rowspan="2">
                            <input type="hidden" name="vuelta" id="vuelta" value="1">
                            <img id="imgbus" class="topbuttons" title="Buscar"  src="../img/lupa_med.png" onclick="buscar()">                            
                        </td>
                    </tr>
                    <tr>                        
                        <td><input id="tfdesde" type="date" class="medtopbuttons" name="tfdesde" required=""></td>
                        <td><input id="tfhasta"  type="date" class="medtopbuttons" name="tfhasta" required></td>
                        <td><select id="categoria"></select></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <label>Competencias</label>
                            <select id="competencias">
                                <option value="0">Seleccione..</option> 
                            </select>
                        </td>
                        <td>
                            <img id="imgchek" class="topbuttons" title="Activar" src="../img/check.png" onclick="check()">
                        </td>
                    </tr>
                </table>                                
                <div id="list"></div>
            </form>
        </section>
        </section>
        </div>
    </body>
</html>

