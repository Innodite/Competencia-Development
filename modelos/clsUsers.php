<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clsUsers
 *
 * @author merma
 */

include 'clsConexion.php';

class clsUsers extends clsConexion{
    //put your code here
    private $user;
    private $pass;
    private $nombre;
    private $apellido;
    private $perfil;
    private $id;
    
    public function __construct($p=NULL){
        parent::__construct();
        if (!is_null($p)){
            $this->user     = $p['user'];
            $this->pass     = $p['pass'];
            $this->id       = $p['id'];
        }
    }
    
    public function __destruct(){}
    
    public function getLogin($user=null,$pass=null){
        $user = is_null($user) ? $this->user : $user;
        $pass = is_null($pass) ? $this->pass : $pass;
        
        $r = $this->filtro("select tlogin('".trim($user)."','".trim($pass)."') usrlog");
        $row = $this->proximo($r);
        if ($row['usrlog'] == 0)
            return true;
        return false;
    }
    
    public function getDataUser($user=null){
        $user = is_null($user) ? $this->user : $user;
        $r = $this->filtro("select id_usuarios, nombre, apellido, perfil 
                            from usuarios
                            where nick = '".$user."'");
        
        $row = $this->proximo($r);
        $this->id       = $row['id_usuarios'];
        $this->nombre   = $row['nombre'];
        $this->apellido = $row['apellido'];
        $this->perfil   = $row['perfil'];
        return $row;
    }
    
    public function getIdUsr(){
        return $this->id;
    }
    
    public function getName(){
        return $this->nombre;
    }
    
    public function getLastName(){
        return $this->apellido;
    }
    
    public function getPerfil(){
        return $this->perfil;
    }
    
}

?>
