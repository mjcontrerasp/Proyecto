<?php
$config = [
    'bd_host' => 'localhost',
    'bd_nombre' => 'proyecto',
    'bd_usuario' => 'root',
    'bd_clave' => ''
];

$db = new mysqli(
    $config['bd_host'],
    $config['bd_usuario'],
    $config['bd_clave'],
    $config['bd_nombre']
);

if ($db->connect_error) {
    die("ERROR: " . $db->connect_error);
}

echo "OK — Conectado a la base de datos";
