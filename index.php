<!DOCTYPE html>
<html>
    <head>
         <meta charset="UTF-8">
         
        
         <title>Control de Acceso</title>
        
        <!-- <link href="http://www.dafont.com/es/the-dead-saloon.font/css?family=thedeadsaloon-regular" type="text/css" rel="stylesheet" />-->
        
        <link rel="stylesheet" href="css/index.css" type="text/css">
    <body>
        <header id="header">
            <img id="logo" src="img/weinsys.png"/>
        </header>            
        <section class="ScrollContenedor">
<!--::::::::::::::::::::::::INICIO MENÚ Y SESIÓN:::::::::::::::::::::::::::::::::::-->           
             <br></br>
<!--::::::::::::::::::::::::INICIO FORMULARIO SESIÓN:::::::::::::::::::::::::::::::::::-->               
        <section id="login">
 <!--::::::::::::::::::::::::INICIO FORMULARIO SESIÓN:::::::::::::::::::::::::::::::::::-->     
        <form  action="./sesion.php" method="POST">
                             <h1>Control de Acceso</h1>
                    <fieldset>
                                 <label>Usuario:</label><br><br>
                                 <img  src="img/user.png" alt="user"><input id="username" name="username" type="text" placeholder="Usuario" autofocus required>   
                    </fieldset>
                    <fieldset> 
                                   <label>Contraseña:</label><br><br>
                                   <img  id="icono-sesion" src="img/pass.png" alt="pass"><input id="password" name="password" type="password" placeholder="Contraseña" required>
                    </fieldset>
                             <input  id="acceder" type="submit" id="submit" value="Acceder">                            
        </form>
 <!--::::::::::::::::::::::::FIN FORMULARIO SESIÓN:::::::::::::::::::::::::::::::::::-->     
        </section>
        </section>
 <!--:::::::::::::::::::::::::::INICIO FOOTER ::::::::::::::::::::::::::::::::-->
    <?php include_once './vistas/components/footer.php'; ?>
        
    </body>
</html>
        

