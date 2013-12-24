<?php
 session_start();
 
       if($_POST['username'] && $_POST['password'])
           {

//aqui debe ir validacion de base de datos

//si el login esta bueno agarrar sesion

if($_POST['username']== 'anthony' && $_POST['password']== '1234'){

     
    //Creamos la sesión 
     $_SESSION['username'] = $_POST['username'];
     $_SESSION['password'] = $_POST['password'];
     
     header('Location: ../competencia/vistas/vistaCompetencia.php');
     
}
else{
     header('Location: index.php');
}
}
 
 if(!isset($_SESSION['username']))
    {
       header('Location: index.php');
    }
?>
