<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Modulo de Competencias</title>
        <link rel="stylesheet" href="../css/cssCompetencias.css" type="text/css">
        <link rel="stylesheet" href="../css/cssGeneral.css" type="text/css">
        <script type="text/javascript" src="../js/utils.js"></script>
        <script type="text/javascript" src="../js/jsCompetencias.js"></script>
    </head>
    <body>
        <div align="center">
            <section id="contenedor">
        <table>
            <tr>
                <td>Fecha</td>
                <td>Modalidad</td>
                <td>Competencia</td>
                <td>Iniciar</td>
                <td>Finalizar</td>
                <td>Volver</td>
            </tr>
            <tr>
                <td><input type="date" id="fecha" onkeyup="buscarCompetencia()"></td>
                <td>
                    <select id="modalidad" onchange="buscarCompetencia()">
                        <option  value="individual">Individual</option>
                        <option  value="grupo">Grupo</option>
                    </select>
                </td>
                <td><select id="competencia"></select></td>
                
                <td><img id="IC" src="../img/play11.png" width="30" height="30" onclick="iniciarCompetencia()" title="iniciar Competencia"></td>
                <td> 
                    <div id="fin" style="visibility:hidden">
                        <img id="FC" src="../img/log.png" width="30" height="30" onclick="finComp()" title="Finalizar Competencia">
                    </div>
                </td>
                <td>
                    <img src="../img/back1.png" id="volver" width="30" height="30" onclick="volver()" title="Volver">
                </td>
            </tr>
        </table>
                <div id="list"></div>
                <aside id="rankings">
                  <article><div id="rank"></div></article>
                  
                </aside>
                <section id="footer">
                    <div id="primeraD"></div>
                    <div id="segundaD"></div>
                    <div id="terceraD"></div>
                </section>
        </section>
        </div>
    </body>
</html>


