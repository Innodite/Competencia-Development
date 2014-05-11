<?php
    session_start();
    if (!isset($_SESSION['perfil']))
        header("Location: ../index.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
         <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <title>Principal</title>
        <!-- <link href="http://www.dafont.com/es/the-dead-saloon.font/css?family=thedeadsaloon-regular" type="text/css" rel="stylesheet" />-->
          <link rel="stylesheet" href="../css/slider.css" type="text/css" />
        <link rel="stylesheet" href="../css/cssGeneral.css" type="text/css"/>
  
         <script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>
         <script type="text/javascript" src="../js/jquery.nivo.slider.js"></script>
         <script type="text/javascript"> <!--Script para el Slider-->
                    $(window).load(function() {
                     $('#slider').nivoSlider();
                     });
                </script>
    </head>
    <body>
<!--::::::::::::::::::::::::INICIO HEADER Y MENÚ ::::::::::::::::::::::::::::-->
        <?php include_once './components/header.php'; ?>
        <section  class="ScrollContenedor">
<!--::::::::::::::::::::::::INICIO SESIÓN:::::::::::::::::::::::::::::::::::-->
            <nav id="usuario-sesion">                
                <br></br>
                <div>
            <?php echo "Bienvenido, ".
                        ucfirst(strtolower($_SESSION['nombre']))." ".
                        ucfirst(strtolower($_SESSION['apellido']));
            ?>
            </div>
            </nav>
            <br></br>
            <h1>Western Intelligent System Venezuela</h1>
<!--::::::::::::::::::::::::INICIO SLIDER:::::::::::::::::::::::::::::::::::-->     
                        <div id="wrapper">
                                 <div class="slider-wrapper slideshow">
                                    <div id="slider" class="nivoSlider">
                                         <img src="../img/slider/caballo1.jpg"/>                                        
                                        <img src="../img/slider/caballo2.jpg"/>
                                        <img src="../img/slider/caballo3.jpg"/>
                                        <img src="../img/slider/caballo4.jpg"/>
                                        <img src="../img/slider/caballo5.jpg"/>
        </div>
                                </div>
                            </div>
          </section>   <!-- :::::::::::: CIERRE SECTION CONTENEDOR:::::::::::::::::::::-->               
<!--:::::::::::::::::::::::::::INICIO FOOTER ::::::::::::::::::::::::::::::::-->
    <?php include_once './components/footer.php'; ?>
    </body>
</html>


