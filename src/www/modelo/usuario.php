<?php
require_once __DIR__ . '/../servicios/bd.php';

/**
 * Clase Usuario
 * Gestiona las operaciones de la tabla usuarios.
 */
class Usuario {

    /**
     * @var mysqli $db Conexión a la base de datos.
     */
    private $db;

    /**
     * Constructor de la clase.
     * @param array $config Configuración de la base de datos.
     */
    public function __construct($config) {
        $this->db = BD::conexion($config);
    }

    /**
     * Busca un usuario por email y contraseña.
     *
     * @param string $email Correo electrónico del usuario.
     * @param string $password Contraseña en texto plano.
     * @return array|null Devuelve un array con los datos del usuario o null si no existe.
     */
    public function buscarUsuario($email, $password) {
        $sql = "SELECT * FROM usuarios WHERE email = ? AND contrasena_hash = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Registra un nuevo usuario en la base de datos.
     *
     * @param string $nombre Nombre completo del usuario.
     * @param string $email Correo electrónico.
     * @param string $telefono Teléfono.
     * @param string $password Contraseña en texto plano.
     * @return int|false Devuelve el ID del usuario insertado o false si hubo error.
     */
    public function registrar($nombre, $email, $telefono, $password) {
        $sql = "INSERT INTO usuarios (nombre, email, telefono, contrasena_hash)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
        echo "ERROR_PREPARE: " . $this->db->error;
        return false;
    }

        $stmt->bind_param("ssss", $nombre, $email, $telefono, $password);

        if (!$stmt->execute()) {
        echo "ERROR_EXECUTE: " . $stmt->error;
        return false;
    }

        return $this->db->insert_id;
    }
}
