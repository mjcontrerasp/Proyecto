<?php

/**
 * Clase BD
 * Gestiona la conexión a la base de datos.
 */
class BD {

    /**
     * Crea y devuelve una conexión mysqli.
     *
     * @param array $config Configuración de la base de datos.
     * @return mysqli Objeto de conexión.
     */
    public static function conexion($config) {
        $db = new mysqli(
            $config['bd_host'],
            $config['bd_usuario'],
            $config['bd_clave'],
            $config['bd_nombre']
        );

        if ($db->connect_error) {
            die("Error en la base de datos: " . $db->connect_error);
        }

        return $db;
    }
}
