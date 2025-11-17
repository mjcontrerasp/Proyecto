<?php
require_once __DIR__ . '/../servicios/bd.php';

class Comercio {

    private $db;

    public function __construct($config) {
        $this->db = BD::conexion($config);
    }

    public function registrar($id_usuario, $nombre_comercial, $direccion, $horario, $activo) {
        $sql = "INSERT INTO comercios (id_usuario, nombre_comercial, direccion, horario, activo) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("isssi", $id_usuario, $nombre_comercial, $direccion, $horario, $activo);

        if ($stmt->execute()) {
            return $this->db->insert_id;
        }
        return false;
    }
}
