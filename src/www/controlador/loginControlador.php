<?php

require_once __DIR__ . '/../modelo/usuario.php';

/**
 * Controlador para el inicio de sesión.
 */
class loginControlador {

    /** Modelo de usuario */
    private $modelo;

    /**
     * Constructor: carga el modelo con la configuración.
     */
    public function __construct($config) {
        $this->modelo = new Usuario($config);
    }

    /**
     * Comprueba el email y la contraseña recibidos por POST.
     * Si son correctos inicia sesión, si no devuelve un error.
     */
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
