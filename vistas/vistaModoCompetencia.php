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
        <title>Modo De Competencia</title>
        <link rel="stylesheet" href="../css/cssModoCompetencia.css" type="text/css">
        <link rel="stylesheet" href="../css/cssGeneral.css" type="text/css">
        <script type="text/javascript" src="../js/utils.js"></script>
        <script type="text/javascript" src="../js/jsModoCompetencia.js"></script>
    </head>
    <body >
        <div align="center">
        <section id="contenedor">
        <?php include 'vistaMenu.php'; ?>
        
        <section id="modCompetencia">
            <h1>Modo De Competencia</h1>
            <form>
                <table>
                    <tr>
                        <td>Modo De Competencia</td>
                        <td>Modalidad</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="txtNombre" id="txtNombre" value="" autofocus required>
                        </td>
                        <td>
                            <select id="lblModalidad">
                                <option  value="individual">Individual</option>
                                <option  value="grupo">Grupo</option>
                            </select>
                        </td>
                        <td> 
                            <img id="imgadd" title="Agregar" src="../img/add_med.png" onclick="cargar()">
                            <img id="imgbus" title="Buscar"  src="../img/lupa_med.png" onclick="buscar()">
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

