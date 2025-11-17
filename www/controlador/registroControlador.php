<?php
require_once __DIR__ . '/../modelo/usuario.php';

class registroControlador {
    private $modelo;

    public function __construct($config) {
        $this->modelo = new Usuario($config);
    }

    public function registrar() {
        header("Content-Type: application/json");

        try {
            $nombre = $_POST['nombre'] ?? '';
            $email  = $_POST['email'] ?? '';
            $telefono = $_POST['telefono'] ?? '';
            $password = $_POST['password'] ?? '';
            $rol = $_POST['rol'] ?? '';

            if (!$nombre || !$email || !$password || !$rol) {
                echo json_encode(['ok'=>false,'msg'=>'Faltan datos obligatorios']);
                return;
            }

            // Registrar en la base de datos (contraseña en texto plano según tu petición)
            $id_usuario = $this->modelo->registrar($nombre, $email, $telefono, $password, $rol);

            if ($id_usuario) {
                echo json_encode(['ok'=>true,'msg'=>'Usuario registrado','id_usuario'=>$id_usuario,'tipo'=>$rol]);
            } else {
                echo json_encode(['ok'=>false,'msg'=>'No se pudo registrar el usuario']);
            }

        } catch (Throwable $e) {
            echo json_encode(['ok'=>false,'msg'=>$e->getMessage()]);
        }
    }
}
