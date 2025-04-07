<?php
namespace TECWEB\MYAPI\Read;

use TECWEB\MYAPI\DataBase;

class Read extends DataBase {
    public function __construct(string $db) {
        parent::__construct($db, 'root', 'Cande02022004');
    }

    public function list(): void {
        // Listado de registros
    }

    public function search(string $string): void {
        // Búsqueda por texto
    }

    public function single(string $string): void {
        // Búsqueda por ID u otro valor único
    }
}
