<?php
namespace TECWEB\MYAPI;

use mysqli;
use Exception;

abstract class DataBase {
    protected $conexion;

    public function __construct() {
        $this->conexion = new mysqli("localhost", "root", "Cande02022004", "marketzone");
        if ($this->conexion->connect_error) {
            throw new Exception("Error de conexión: " . $this->conexion->connect_error);
        }
    }
}