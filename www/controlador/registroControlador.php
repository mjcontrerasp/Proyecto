<?php
require_once __DIR__ . '/../modelo/usuario.php';

/**
 * Controlador que gestiona el registro de nuevos usuarios.
 * Recibe el formulario, valida los datos y llama al modelo Usuario.
 */
class registroControlador {

    private $modelo;

    /**
     * Constructor: carga el modelo Usuario.
     */
    public function __construct($config) {
        $this->modelo = new Usuario($config);
    }

    /**
     * Registra un usuario nuevo.
     * Devuelve una cadena simple (sin JSON) porque así lo usa el JS.
     */
    public function registrar() {

        // Recibimos los datos del formulario
        $nombre   = $_POST['nombre']   ?? '';
        $email    = $_POST['email']    ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $password = $_POST['password'] ?? '';
        $rol      = $_POST['rol']      ?? '';

        // Comprobamos que hay datos mínimos
        if (!$nombre || !$email || !$password || !$rol) {
            echo "ERROR:FALTAN_DATOS";
            return;
        }

        // Intentamos registrar el usuario
        $id = $this->modelo->registrar($nombre, $email, $telefono, $password, $rol);

        // Si no se pudo registrar (email repetido, error SQL...)
        if (!$id) {
            echo "ERROR:EMAIL_DUPLICADO";
            return;
        }

        // Todo ok → devolvemos formato simple que el JS entiende
        echo "OK:$rol:$id";
    }
}
