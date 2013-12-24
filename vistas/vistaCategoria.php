<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Categoria</title>
        <link rel="stylesheet" href="../css/cssCategoria.css" type="text/css">
        <link rel="stylesheet" href="../css/cssGeneral.css" type="text/css">
        <script type="text/javascript" src="../js/utils.js"></script>
        <script type="text/javascript" src="../js/jsCategoria.js"></script>
    </head>
    <body>
        <div align="center">
        <section id="contenedor">
        <?php include 'vistaMenu.php'; ?>
        <section id="categoria">
            <h1>Categoria</h1>
            <form> <!-- ../controladores/ctrCategoria.php -->
                <table>
                    <tr>
                        <td><label>Nombre</label></td>
                        <td><label>Edad M&iacute;nima</label></td>
                        <td><label>Edad M&aacute;xima</label></td>
                        
                    </tr>
                    <tr>                        
                        <td><input id="nombre" type="text" name="txtNombre" value="" autofocus required></td>
                        <td><input id="min"    type="text"  name="txtEdadMin" value="" required></td>
                        <td><input id="max"    type="text"  name="txtEdadMax" value="" required></td>                        
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

