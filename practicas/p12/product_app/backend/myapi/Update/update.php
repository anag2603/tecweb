<?php
namespace TECWEB\MYAPI\Update;

use TECWEB\MYAPI\DataBase;

class Update extends DataBase {
    public function __construct(string $db) {
        parent::__construct($db, 'root', 'Cande02022004');
    }

    public function edit(object $object): void {
        // Actualización de registro
    }
}
