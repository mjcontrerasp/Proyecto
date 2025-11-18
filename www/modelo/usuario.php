<?php
require_once __DIR__ . '/../servicios/bd.php';

class Usuario {

    private $db;

    public function __construct($config) {
        $this->db = BD::conexion($config);
    }

    public function buscarUsuario($email, $password) {
        $sql = "SELECT * FROM usuarios WHERE email = ? AND contrasena_hash = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function registrar($nombre, $email, $telefono, $password, $rol) {

    $sql = "INSERT INTO usuarios (nombre, email, telefono, contrasena_hash, rol)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $this->db->prepare($sql);

    if (!$stmt) {
        echo "ERROR_PREPARE: " . $this->db->error;
        return false;
    }

    $stmt->bind_param("sssss", $nombre, $email, $telefono, $password, $rol);

    if (!$stmt->execute()) {
        echo "ERROR_EXECUTE: " . $stmt->error;
        return false;
    }

    return $this->db->insert_id;
}

}
