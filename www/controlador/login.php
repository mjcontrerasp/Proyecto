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

        // Conexión a base de datos
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
     * Mostrar login
     */
    public function index()
    {
        // Pasamos Google Client ID a la vista
        $googleClientId = $this->config['google_client_id'];
        include $this->config['dir_vistas'] . 'index.php';
    }

    /**
     * Procesar login tradicional
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
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
                return;
            } else {
                http_response_code(401);
                echo json_encode(['error' => 'Credenciales inválidas']);
                return;
            }
        }

        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
    }

    /**
     * Procesar Google Sign-In (pendiente)
     */
    public function google()
    {
        // Aquí se procesará el token de Google
    }
}
