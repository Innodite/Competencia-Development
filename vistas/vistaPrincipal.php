<?php
    session_start();
    if (!isset($_SESSION['perfil']))
        header("Location: ../index.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Principal</title>
        <link rel="stylesheet" href="../css/cssGeneral.css" type="text/css"/>
    </head>
    <body>
        <div align="center">
        <section id="contenedor">
            <?php include 'vistaMenu.php'; ?>
            <div id="datauser">
            <?php echo "Bienvenido, ".
                        ucfirst(strtolower($_SESSION['nombre']))." ".
                        ucfirst(strtolower($_SESSION['apellido']));
            ?>
            </div>
            <section id="categoria">
                Imagen Principal
            </section>
            <div id="list"></div>
        </section>
        </div>
    </body>
</html>