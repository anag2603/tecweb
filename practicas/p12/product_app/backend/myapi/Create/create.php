<?php
namespace TECWEB\MYAPI\Create;

use TECWEB\MYAPI\DataBase;

class Create extends DataBase {
    public function __construct(string $db) {
        parent::__construct($db, 'root', 'Cande02022004');
    }

    public function add(object $object): void {
        // Aquí va la lógica para insertar datos
    }
}
