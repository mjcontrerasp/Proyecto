<?php
require_once __DIR__ . '/../modelo/comercio.php';

/**
 * Controlador encargado de registrar los datos de un comercio.
 * Recibe los datos desde un formulario y llama al modelo
 * para guardarlos en la base de datos.
 */
class comercioControlador {

    private $modelo;

    /**
     * Constructor: crea el modelo Comercio para usarlo después.
     */
    public function __construct($config) {
        $this->modelo = new Comercio($config);
    }

    /**
     * Método que recibe los datos del comercio y los registra.
     * Devuelve un JSON indicando si ha ido bien o mal.
     */
    public function registrar() {

        // Datos enviados desde el formulario
        $id_usuario = $_POST['id_usuario'] ?? null;
        $nombre_comercial = $_POST['nombre_comercial'] ?? '';
        $direccion = $_POST['direccion'] ?? '';
        $horario = $_POST['horario'] ?? '';
        $activo = isset($_POST['activo']) ? 1 : 0;

        // Indicamos que la respuesta será JSON
        header('Content-Type: application/json');

        // Comprobamos datos obligatorios
        if (!$id_usuario || !$nombre_comercial) {
            echo json_encode(['ok' => false, 'msg' => 'Faltan datos obligatorios']);
            return;
        }

        // Guardamos el comercio en la base de datos
        $insert_id = $this->modelo->registrar($id_usuario, $nombre_comercial, $direccion, $horario, $activo);

        // Respondemos según el resultado
        if ($insert_id) {
            echo json_encode(['ok' => true, 'id_comercio' => $insert_id]);
        } else {
            echo json_encode(['ok' => false, 'msg' => 'Error al registrar el comercio']);
        }
    }
}
