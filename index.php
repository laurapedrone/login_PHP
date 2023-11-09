<?php
//Incluimos nuestras librerías
include_once 'includes/user.php'; 
include_once 'includes/user_session.php';

// Creamos un objeto tipo userSession, para poder inicializar el ambiente de sessiones 
//y poder validar si hay sessiones, 
//dependiendo de eso redirigir al usuario
$userSession = new UserSession();
//es lo que vamos a a menejar el usuario actual
$user = new User();

//Comienza las validaciones:
//isset: si existe una session
if(isset($_SESSION['user'])){
    //echo "hay sesion";
    $user->setUser($userSession->getCurrentUser());
    include_once 'vistas/home.php';

}else if(isset($_POST['username']) && isset($_POST['password'])){ //username y password son las variables de nuestra vista
    
    $userForm = $_POST['username'];
    $passForm = $_POST['password'];

    $user = new User();
    if($user->userExists($userForm, $passForm)){
        //echo "Existe el usuario";
        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);

        include_once 'vistas/home.php';
    }else{
        //echo "No existe el usuario";
        $errorLogin = "Nombre de usuario y/o password incorrecto";
        include_once 'vistas/login.php';
    }
}else{
    //echo "login";
    include_once 'vistas/login.php';
}

?>