<?php
namespace TECWEB\MYAPI;

class Read extends DataBase {
    public function getAll() {
        $result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conexion->prepare("SELECT * FROM productos WHERE id = ? AND eliminado = 0");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function search($term) {
        $search = "%{$term}%";
        $stmt = $this->conexion->prepare("SELECT * FROM productos WHERE nombre LIKE ? AND eliminado = 0");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}