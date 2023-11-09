<?php
include_once 'db.php';

//Se crea una clase DB que se extiende de nuestra base de datos:
class User extends DB{
    private $nombre;
    private $username;

    //Creo una función para saber si existe el usuario:
    public function userExists($user, $pass){
        //$md5pass = md5($pass) ->MD5 es para encriptar la contraseña: pero en este caso no lo estamos aplicando, ver en youtube como encriptar contraseña...
        $md5pass = $pass;
        //Me va a validar si existe o no el usuario y la clave en mi BD para hacer mi loguin:
        //connect() es para conectarme a la bd, prepare() es para validar la BD
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user AND password = :pass');
        //con execute voy a unir los datos temporales que puse en pantalla.
        $query->execute(['user' => $user, 'pass' => $md5pass]);

        //Vamos a validar si query, rowCount me permite contar el numero de filas, si hay filas voy a regresar true y si no false
        //y con esto puedo validar que el loguin fue incorrecto.
        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }
    //en esta vamos asignar de acuerdo un nombre de usuario, vamos a llenar las variables de los objetos $user y $md5pass
    public function setUser($user){
        //Aquí no necesito validar el password, solamente necesito el nombre de usuario
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
        $query->execute(['user' => $user]);
        
        //Tenemos que hacer el barrido: donde asiganmos nuestras variables y obtenemos los valores de la columna de nombre y username
        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['nombre'];
            $this->username = $currentUser['username'];
        }
    }

    //Es para obtener la variable Nombre
    public function getNombre(){
        return $this->nombre;
    }
}

?>