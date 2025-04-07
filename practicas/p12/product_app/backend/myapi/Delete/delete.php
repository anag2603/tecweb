<?php
namespace TECWEB\MYAPI\Delete;

use TECWEB\MYAPI\DataBase;

class Delete extends DataBase {
    public function __construct(string $db) {
        parent::__construct($db, 'root', 'Cande02022004');
    }

    public function delete(string $string): void {
        // Eliminación de registro
    }
}
