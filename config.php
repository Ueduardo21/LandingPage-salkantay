<?php
// Activar reporte de errores para desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Definir constante de ruta base
define('BASE_PATH', __DIR__);

// ============================================
// CARGAR VARIABLES DE ENTORNO
// ============================================
if (file_exists(BASE_PATH . '/.env')) {
    $env_file = file(BASE_PATH . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($env_file as $line) {
        $line = trim($line);
        if (strpos($line, '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            // Eliminar comillas si existen
            $value = trim($value, '"\'');
            
            putenv("$key=$value");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

// ============================================
// DETECTAR ENTORNO (LOCALHOST o CPANEL)
// ============================================
$isLocalhost = (
    $_SERVER['SERVER_NAME'] === 'localhost' || 
    $_SERVER['SERVER_NAME'] === '127.0.0.1' ||
    strpos($_SERVER['SERVER_NAME'], 'localhost') !== false ||
    strpos($_SERVER['SERVER_NAME'], '192.168.') !== false
);

define('IS_LOCALHOST', $isLocalhost);

// ============================================
// CONFIGURACIÓN GENERAL
// ============================================
define('APP_NAME', getenv('APP_NAME') ?: 'Cusco Tours Barato');
define('APP_URL', getenv('APP_URL') ?: ($isLocalhost ? 'http://localhost/salka/LandingPageSalka' : 'https://tudominio.com'));
define('APP_ENV', getenv('APP_ENV') ?: ($isLocalhost ? 'development' : 'production'));
define('DEBUG', getenv('DEBUG') === 'true' ? true : ($isLocalhost ? true : false));

// ============================================
// CONFIGURACIÓN DE EMAIL
// ============================================
define('EMAIL_TO', getenv('EMAIL_TO') ?: 'brayanedu2019@gmail.com');
define('ADMIN_EMAIL', getenv('ADMIN_EMAIL') ?: 'brayanedu2019@gmail.com');

// Configuración SMTP
define('SMTP_HOST', getenv('SMTP_HOST') ?: 'smtp.gmail.com');
define('SMTP_PORT', getenv('SMTP_PORT') ?: 587);
define('SMTP_SECURE', getenv('SMTP_SECURE') ?: 'tls');
define('SMTP_USERNAME', getenv('SMTP_USERNAME') ?: 'brayanedu2019@gmail.com');
define('SMTP_PASSWORD', getenv('SMTP_PASSWORD') ?: 'mxsa bnfh krlf uyhh');
define('SMTP_FROM', getenv('SMTP_FROM') ?: 'brayanedu2019@gmail.com');
define('SMTP_FROM_NAME', getenv('SMTP_FROM_NAME') ?: 'Cusco Tours Barato');

// ============================================
// CONFIGURACIÓN DE BASE DE DATOS (opcional)
// ============================================
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'landing_db');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

// ============================================
// CONFIGURACIÓN DE RUTAS
// ============================================
define('ASSETS_PATH', APP_URL . '/assets');
define('VENDOR_PATH', BASE_PATH . '/vendor');

// ============================================
// CARGAR AUTOLOAD DE COMPOSER
// ============================================
$composer_autoload = VENDOR_PATH . '/autoload.php';
if (file_exists($composer_autoload)) {
    require_once $composer_autoload;
} else {
    if (DEBUG) {
        echo "⚠️ Composer no está instalado. Ejecuta: composer require phpmailer/phpmailer<br>";
    }
}

// ============================================
// CONFIGURACIÓN DE ZONA HORARIA
// ============================================
date_default_timezone_set('America/Lima');

// ============================================
// CONFIGURACIÓN DE SESIÓN
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ============================================
// FUNCIONES DE DEPURACIÓN
// ============================================
function debug($data, $die = false) {
    if (DEBUG) {
        echo '<pre style="background: #f0f0f0; padding: 10px; margin: 10px; border: 1px solid #ccc; border-radius: 5px; overflow: auto;">';
        print_r($data);
        echo '</pre>';
        if ($die) die();
    }
}

function dd($data) {
    debug($data, true);
}

// ============================================
// FUNCIÓN PARA REDIRECCIONAR
// ============================================
function redirect($url) {
    header('Location: ' . $url);
    exit;
}

// ============================================
// CONFIGURACIÓN DE ERRORES SEGÚN ENTORNO
// ============================================
if (DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', BASE_PATH . '/error_log.txt');
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', BASE_PATH . '/error_log.txt');
}

// ============================================
// FUNCIÓN PARA REGISTRAR ERRORES
// ============================================
function logError($message, $context = []) {
    $log = date('Y-m-d H:i:s') . " - " . $message;
    if (!empty($context)) {
        $log .= " - " . json_encode($context);
    }
    error_log($log . PHP_EOL, 3, BASE_PATH . '/error_log.txt');
}

// Mensaje de depuración para verificar entorno
if (DEBUG && IS_LOCALHOST) {
    echo "<!-- Entorno: " . (IS_LOCALHOST ? 'LOCALHOST' : 'CPANEL') . " -->\n";
}
?>