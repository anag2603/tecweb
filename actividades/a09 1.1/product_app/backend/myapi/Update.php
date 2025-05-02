<?php
namespace TECWEB\MYAPI;

use TECWEB\MYAPI\DataBase;

class Update extends DataBase {

    public function __construct($db = "product_db", $user = "root", $pass = "Cande02022004") {
        parent::__construct($db, $user, $pass);
    }

    public function insert($data) {
        return ['status' => 'success', 'message' => 'Producto agregado (mock)'];
    }

    public function getAll() {
        return [['id' => 1, 'nombre' => 'Mock1'], ['id' => 2, 'nombre' => 'Mock2']];
    }

    public function getById($id) {
        return ['id' => $id, 'nombre' => 'Mock producto'];
    }

    public function search($search) {
        return [['id' => 1, 'nombre' => "Coincidencia con $search"]];
    }

    public function update($data) {
        return ['status' => 'success', 'message' => 'Producto actualizado (mock)'];
    }

    public function delete($id) {
        return ['status' => 'success', 'message' => 'Producto eliminado (mock)'];
    }
}
