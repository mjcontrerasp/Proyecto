<?php
require_once __DIR__ . '/../modelo/comercio.php';

class comercioControlador {

    private $modelo;

    public function __construct($config) {
        $this->modelo = new Comercio($config);
    }

    public function registrar() {
        $id_usuario = $_POST['id_usuario'] ?? null;
        $nombre_comercial = $_POST['nombre_comercial'] ?? '';
        $direccion = $_POST['direccion'] ?? '';
        $horario = $_POST['horario'] ?? '';
        $activo = isset($_POST['activo']) ? 1 : 0;

        header('Content-Type: application/json');

        if (!$id_usuario || !$nombre_comercial) {
            echo json_encode(['ok' => false, 'msg' => 'Faltan datos obligatorios']);
            return;
        }

        $insert_id = $this->modelo->registrar($id_usuario, $nombre_comercial, $direccion, $horario, $activo);

        if ($insert_id) {
            echo json_encode(['ok' => true, 'id_comercio' => $insert_id]);
        } else {
            echo json_encode(['ok' => false, 'msg' => 'Error al registrar el comercio']);
        }
    }
}
