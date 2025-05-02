<?php
namespace TECWEB\MYAPI;

class Update extends DataBase {
    public function update($data) {
        $stmt = $this->conexion->prepare("UPDATE productos SET nombre=?, marca=?, modelo=?, precio=?, detalles=?, unidades=?, imagen=? WHERE id=?");
        $stmt->bind_param("sssdsisi", $data['nombre'], $data['marca'], $data['modelo'], $data['precio'], $data['detalles'], $data['unidades'], $data['imagen'], $data['id']);
        $stmt->execute();
        return ["status" => "success"];
    }
}