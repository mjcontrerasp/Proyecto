<?php

require_once __DIR__ . '/../modelo/usuario.php';

class loginControlador {

    private $config;
    private $modelo;

    public function __construct($config) {
        $this->config = $config;
        $this->modelo = new Usuario($config);
    }

    public function comprobar() {
        $email = $_POST['email'] ?? '';
        $pass  = $_POST['password'] ?? '';

        $usuario = $this->modelo->buscarUsuario($email, $pass);

        header("Content-Type: application/json");

        if (!$usuario) {
            echo json_encode(['ok' => false, 'msg' => 'Correo o contraseña incorrectos']);
            return;
        }

        session_start();
        $_SESSION['usuario'] = $usuario['email'];
        $_SESSION['rol'] = $usuario['rol']; 
        echo json_encode([
            'ok' => true,
            'rol' => $usuario['rol']
        ]);
    }
}
