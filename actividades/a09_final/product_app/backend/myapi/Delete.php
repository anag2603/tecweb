<?php
namespace TECWEB\MYAPI;

class Delete extends DataBase {
    public function delete($id) {
        $stmt = $this->conexion->prepare("UPDATE productos SET eliminado = 1 WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return ["status" => "deleted"];
    }
}