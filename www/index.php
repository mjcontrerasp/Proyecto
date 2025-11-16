<?php
try {
    $config = require('config.php');

    if ($config['debug']) {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }

    $controlador = $_GET['controlador'] ?? null;
    $metodo = $_GET['metodo'] ?? null;

    // Si no manda controlador ni método → carga el login
    if (!$controlador || !$metodo) {
        require $config['dir_html'] . 'index.html';
        die();
    }

    require_once $config['dir_controladores'] . $controlador . '.php';
    $c = new $controlador($config);
    $c->$metodo();

} catch (Throwable $e) {
    echo "ERROR: " . $e->getMessage();
}
