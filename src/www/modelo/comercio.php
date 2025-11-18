<?php
require_once __DIR__ . '/../servicios/bd.php';

/**
 * Clase Comercio
 * Gestiona las operaciones de la tabla comercios.
 */
class Comercio {

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
     * Registra un nuevo comercio en la base de datos.
     *
     * @param int $id_usuario Id del usuario asociado.
     * @param string $nombre_comercial Nombre del comercio.
     * @param string $direccion Dirección del comercio.
     * @param string $horario Horario de apertura.
     * @param int $activo Indica si el comercio está activo (1) o no (0).
     * @return int|false Devuelve el ID del comercio insertado o false si hubo error.
     */
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
