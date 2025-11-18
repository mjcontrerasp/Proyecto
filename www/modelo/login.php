<?php
/**
 * Controlador Login
 */
class login
{
    private $config;
    private $db;

    public function __construct($config)
    {
        $this->config = $config;

        // Conexión a la base de datos
        try {
            $this->db = new PDO(
                "mysql:host={$config['bd_host']};dbname={$config['bd_nombre']};port={$config['bd_port']};charset=utf8mb4",
                $config['bd_usuario'],
                $config['bd_password']
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    /**
     * Método index
     * Muestra la vista de login
     */
    public function index()
    {
        $googleClientId = $this->config['google_client_id'] ?? '';
        include $this->config['dir_vistas'] . 'index.php';
    }

    /**
     * Método login
     * Procesa login tradicional
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
            return;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (!$email || !$password) {
            http_response_code(400);
            echo json_encode(['error' => 'Email y contraseña son obligatorios']);
            return;
        }

        $stmt = $this->db->prepare("SELECT id_usuario, nombre, contraseña_hash, rol FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['contraseña_hash'])) {
            session_start();
            $_SESSION['user_id'] = $user['id_usuario'];
            $_SESSION['user_name'] = $user['nombre'];
            $_SESSION['user_rol'] = $user['rol'];
            $_SESSION['last_activity'] = time();

            echo json_encode(['success' => true]);
        } else {
            http_response_code(401);
            echo json_encode(['error' => 'Credenciales inválidas']);
        }
    }

    /**
     * Método google
     * Procesa login vía Google Sign-In
     */
    public function google()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
            return;
        }

        $token = $_POST['token'] ?? '';
        if (!$token) {
            http_response_code(400);
            echo json_encode(['error' => 'Token de Google requerido']);
            return;
        }

        // Validar token con API de Google
        $googleApiUrl = "https://oauth2.googleapis.com/tokeninfo?id_token=" . urlencode($token);
        $response = file_get_contents($googleApiUrl);
        if (!$response) {
            http_response_code(400);
            echo json_encode(['error' => 'Token inválido']);
            return;
        }

        $data = json_decode($response, true);
        if (!isset($data['email'])) {
            http_response_code(401);
            echo json_encode(['error' => 'No se pudo autenticar con Google']);
            return;
        }

        // Crear usuario o iniciar sesión
        $stmt = $this->db->prepare("SELECT id_usuario, nombre, rol FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $data['email']]);
        $user = $stmt->fetch();

        session_start();

        if ($user) {
            $_SESSION['user_id'] = $user['id_usuario'];
            $_SESSION['user_name'] = $user['nombre'];
            $_SESSION['user_rol'] = $user['rol'];
        } else {
            // Crear nuevo usuario en la base de datos
            $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, email, rol) VALUES (:nombre, :email, :rol)");
            $stmt->execute([
                'nombre' => $data['name'] ?? $data['email'],
                'email' => $data['email'],
                'rol' => 'voluntario'
            ]);
            $_SESSION['user_id'] = $this->db->lastInsertId();
            $_SESSION['user_name'] = $data['name'] ?? $data['email'];
            $_SESSION['user_rol'] = 'voluntario';
        }

        echo json_encode(['success' => true]);
    }
}
