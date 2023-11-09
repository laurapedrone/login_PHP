<?php

class DB{
    private $host;
    private $db;
    private $user;
    private $password;
    private $port;

    public function __construct(){
        $this->host     = 'localhost';
        $this->db       = 'compras';
        $this->user     = 'root';
        $this->password = '';
        $this->port = '3307';
    }

    function connect(){
    
        try{
            
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";port=" . $this->port;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($connection, $this->user, $this->password, $options);
    
            return $pdo;

        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }   
    }
}

?>