<!DOCTYPE html>
<!--
Innodite 
-->

<html>
    <head>
        <title>Administrativo</title>
        <meta charset="UTF-8" >  
              
        <link rel="stylesheet" href="css/index.css" type="text/css"> 

          
    </head>
    <body>
         <header>
             <a href= "vistaPrincipal.php"><img id="logo" src="../img/asovaqueros.png"/></a>
        </header>            
        <div align= center>
        <section id="contenedor">
                <section id="login">
                        <form  action="./sesion.php" method="POST">
                             <h1>Control de Acceso</h1>
                             <fieldset>
                                 <label>Usuario:</label><br>
                                 <img src="img/user.png" alt="user"><input id="username" name="username" type="text" placeholder="Usuario" autofocus required>   
                             </fieldset>
                             <fieldset> 
                                   <label>Contraseña:</label><br>
                                   <img src="img/pass.png" alt="pass"><input id="password" name="password" type="password" placeholder="Contraseña" required>
                             </fieldset>
                             <input  id="acceder" type="submit" id="submit" value="Acceder">                            
                        </form>
                </section>
        </section>
        </div>             
          <footer>                
              <p id="footer">Copyright © 2014 Asovaqueros - Bolívar</p>
          </footer>   
    </body>











 
</html>
        