<?php
/**
 * index.php
 * Front Controller
 */
try {
    // 1. Cargar configuración
    $config = require_once 'config.php';

    // 2. Configurar errores según debug
    if ($config['debug']) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    } else {
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
        error_reporting(0);
    }

    // 3. Middleware (session, auth, logging, etc.)
    session_start();

    // 4. Determinar controlador y método
    $controlador = $_GET['controlador'] ?? 'login';
    $metodo = $_GET['metodo'] ?? 'index';

    $archivo_controlador = $config['dir_controladores'] . strtolower($controlador) . ".php";

    if (!file_exists($archivo_controlador)) {
        throw new Exception("Controlador '$controlador' no encontrado");
    }

    require_once($archivo_controlador);

    if (!class_exists($controlador)) {
        throw new Exception("Clase '$controlador' no encontrada en '$archivo_controlador'");
    }

    $ctrl = new $controlador($config);

    if (!method_exists($ctrl, $metodo)) {
        throw new Exception("Método '$metodo' no existe en '$controlador'");
    }

    // 5. Llamar al método del controlador
    $ctrl->$metodo();
    die();

} catch (Throwable $exception) {
    header("HTTP/1.1 500 Internal Server Error");
    if (isset($config['debug']) && $config['debug']) {
        echo "<pre>" . $exception->getMessage() . "</pre>";
    } else {
        echo "Se produjo un error en el servidor.";
    }
}
