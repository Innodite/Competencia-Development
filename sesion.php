<?php
 session_start();
 
if(isset($_POST['username']) && isset($_POST['password'])){

    include './modelos/clsUsers.php';
    $usr = new clsUsers();
    if($usr->getLogin($_POST['username'], $_POST['username'])){
        $usr->getDataUser($_POST['username']);
        //Creamos la sesión 
         $_SESSION['username'] = $_POST['username'];
         $_SESSION['password'] = $_POST['password'];
         $_SESSION['nombre']   = $usr->getName();
         $_SESSION['apellido'] = $usr->getLastName();
         $_SESSION['id']       = $usr->getIdUsr();
         $_SESSION['perfil']   = $usr->getPerfil();

         header('Location: ./vistas/vistaPrincipal.php');

    }else{
         header('Location: index.php');
    }
}else{
    if(isset($_SESSION['username'])){
        session_destroy();
        session_start();
        session_destroy();
        header('Location: index.php');
    }
}
 
 if(!isset($_SESSION['username'])){
       header('Location: index.php');
 }
?>
