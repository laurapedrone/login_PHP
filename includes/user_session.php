<?php
//Aqui solo voy a menjar la session:
class UserSession{
    //Inicializamos un ambiente para menejar sessiones con session_start();
    public function __construct(){
        session_start();
    }
    //Esta función me va a yudar a ponerle un valor a mi session actual, por eso voy a pedir un usuario
    public function setCurrentUser($user){
        //$_SESSION es para guardar valores de mi session, en este caso $user->Aqui voy a guardar el nombre del usuario
        $_SESSION['user'] = $user;
    }
    //Devuelvo la session 
    public function getCurrentUser(){
        return $_SESSION['user'];
    }

    //esta función es para cerrar la session
    public function closeSession(){
        //Borra los valores:
        session_unset();
        //Destruye las sessiones como tal
        session_destroy();
    }
}

?>