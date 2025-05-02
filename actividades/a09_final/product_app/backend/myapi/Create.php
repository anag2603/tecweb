<?php
namespace TECWEB\MYAPI;

class Create extends DataBase {
    public function insert($data) {
        $stmt = $this->conexion->prepare("INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
        $stmt->bind_param("sssdsis", $data['nombre'], $data['marca'], $data['modelo'], $data['precio'], $data['detalles'], $data['unidades'], $data['imagen']);
        $stmt->execute();
        return ["status" => "success", "inserted_id" => $stmt->insert_id];
    }
}