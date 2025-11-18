<?php

require_once __DIR__ . '/../modelo/usuario.php';

class loginControlador {

    private $modelo;

    public function __construct($config) {
        $this->modelo = new Usuario($config);
    }

    public function comprobar() {

        $email = $_POST['email'] ?? '';
        $pass  = $_POST['password'] ?? '';

        $usuario = $this->modelo->buscarUsuario($email, $pass);

        if (!$usuario) {
            echo "ERROR:LOGIN";
            return;
        }

        session_start();
        $_SESSION['usuario'] = $usuario['email'];

        echo "OK:" . $usuario['rol'];
    }
}
