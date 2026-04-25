<?php
// ============================================
// CARGA DE VARIABLES DE ENTORNO
// ============================================

class EnvLoader
{
    private static $variables = [];
    
    public static function load($path)
    {
        if (!file_exists($path)) {
            throw new Exception("Archivo .env no encontrado: " . $path);
        }
        
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line) {
            // Saltar comentarios
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            
            // Parsear variable
            $parts = explode('=', $line, 2);
            if (count($parts) === 2) {
                $key = trim($parts[0]);
                $value = trim($parts[1]);
                self::$variables[$key] = $value;
                putenv("$key=$value");
                $_ENV[$key] = $value;
            }
        }
    }
    
    public static function get($key, $default = null)
    {
        $value = getenv($key);
        if ($value !== false) {
            return $value;
        }
        
        return isset(self::$variables[$key]) ? self::$variables[$key] : $default;
    }
}

// Cargar el archivo .env
$envPath = dirname(__DIR__) . '/.env';
if (file_exists($envPath)) {
    EnvLoader::load($envPath);
}

// Configuración de email
define('SMTP_HOST', EnvLoader::get('SMTP_HOST', 'smtp.gmail.com'));
define('SMTP_PORT', EnvLoader::get('SMTP_PORT', 587));
define('SMTP_USER', EnvLoader::get('SMTP_USER'));
define('SMTP_PASS', EnvLoader::get('SMTP_PASS'));
define('SMTP_SECURE', EnvLoader::get('SMTP_SECURE', 'tls'));
define('ADMIN_EMAIL', EnvLoader::get('ADMIN_EMAIL'));
define('ADMIN_NAME', EnvLoader::get('ADMIN_NAME', 'Administrador'));
define('FROM_EMAIL', EnvLoader::get('FROM_EMAIL'));
define('FROM_NAME', EnvLoader::get('FROM_NAME', 'Turismo Peru'));

// Verificar que las variables necesarias existan
if (!SMTP_USER || !SMTP_PASS || !ADMIN_EMAIL) {
    error_log('Error: Faltan variables de entorno para el envío de correos');
}
?>