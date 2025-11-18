<?php
require_once __DIR__ . '/../modelo/usuario.php';

class registroControlador {

    private $modelo;

    public function __construct($config) {
        $this->modelo = new Usuario($config);
    }

    public function registrar() {

        $nombre   = $_POST['nombre']   ?? '';
        $email    = $_POST['email']    ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $password = $_POST['password'] ?? '';
        $rol      = $_POST['rol']      ?? '';

        if (!$nombre || !$email || !$password || !$rol) {
            echo "ERROR:FALTAN_DATOS";
            return;
        }

        $id = $this->modelo->registrar($nombre, $email, $telefono, $password, $rol);

        if (!$id) {
            echo "ERROR:EMAIL_DUPLICADO";
            return;
        }

        echo "OK:$rol:$id";
    }
}
