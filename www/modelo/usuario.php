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
}
