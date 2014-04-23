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
         <title>Nosotros</title>
        <!-- <link href="http://www.dafont.com/es/the-dead-saloon.font/css?family=thedeadsaloon-regular" type="text/css" rel="stylesheet" />-->
          <link rel="stylesheet" href="../css/slider.css" type="text/css" />
         <link rel="stylesheet" href="../css/cssGeneral.css" type="text/css"/>
      </head>
    <body>      
        <header>
             <a href= "vistaPrincipal.php"><img id="logo" src="../img/asovaqueros.png"/></a>
        </header>            
        <section id="contenedor"> 
<!--::::::::::::::::::::::::INICIO MENÚ Y SESIÓN:::::::::::::::::::::::::::::::::::-->           
            <nav id="usuario-sesion">                
                <br></br>
                <div>
                    <?php echo "Bienvenido, ".
                        ucfirst(strtolower($_SESSION['nombre']))." ".
                        ucfirst(strtolower($_SESSION['apellido']));
                   ?>
                </div>
                <div id="posicion-menu"><?php include 'vistaMenu.php';?></div>
                <div> <a href="../sesion.php"><img id="logo-off" src="../img/off.png" title="Salir"></a></div>
            </nav>
            <br></br>
            <h1>Western Intelligent System Venezuela</h1>
<!--::::::::::::::::::::::::INICIO PRESENTACION:::::::::::::::::::::::::::::::::::-->     
                <section id="presentacion">
                        <section id="innodite">
                             <img src="../img/innodite.png"/>
                             <p>Innodite es uns empresa tecnológica que busca continuamente mejorar la calidad tanto de entornos productivos 
                                como de nuestra cotidianidad, desarrollando e implementando con carácter 
                                creativo e innovador tecnologías de punta al servicio de nuestros clientes.</p>
                        </section>
                        <section id="asovaqueros">
                             <img src="../img/asovaqueros.png"/>
                             <p>Asovaqueros Bolívar, Asovaqueros Bolívar, Asovaqueros Bolívar, Asovaqueros Bolívar,
                             Asovaqueros Bolívar, Asovaqueros Bolívar, Asovaqueros Bolívar Asovaqueros Bolívar 
                             </p>
                        </section>  
                       
                </section> 
        </section>   <!-- :::::::::::: CIERRE SECTION CONTENEDOR:::::::::::::::::::::-->               
          <footer>                
              <p id="footer">Copyright © 2014 Western Intelligent System Venezuela</p>
          </footer>   
    </body>
</html>


