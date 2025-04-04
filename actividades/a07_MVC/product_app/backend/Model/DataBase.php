<?php
    namespace TECWEB\MYAPI;
    //Creamos clase abstracta
    abstract class DataBase{
        protected $conexion;
        public function __construct($user, $pass, $db) {
            $this->conexion = @mysqli_connect(
                'localhost',
                $user, $pass, $db
            );
            
            if(!$this->conexion){
                die('¡ERROR al conectar la base de datos!');
            }
        }
    }
?>