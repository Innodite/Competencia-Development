<!DOCTYPE html>
<html>
    <head>
         <meta charset="UTF-8">
        
         <title>Control de Acceso</title>
        
        <!-- <link href="http://www.dafont.com/es/the-dead-saloon.font/css?family=thedeadsaloon-regular" type="text/css" rel="stylesheet" />-->
       
        <link rel="stylesheet" href="css/index.css" type="text/css">
    <body>
        <header>
            <img id="logo" src="img/asovaqueros.png"/>
        </header>            
        <section id="contenedor">
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
          <footer>                
              <p id="footer">Copyright © 2014 Asovaqueros - Bolívar. Derechos Reservados</p>
          </footer>
        
    </body>
</html>
        

