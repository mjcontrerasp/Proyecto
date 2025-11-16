<?php

class BD {
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
