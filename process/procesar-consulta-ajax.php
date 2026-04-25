<?php
// ============================================
// PROCESAR CONSULTA AJAX - CORREGIDO
// ============================================

// Mostrar errores para debug (quitar en producción)
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

try {
    // Incluir el enviador de correos
    $gmailSenderPath = __DIR__ . '/../includes/GmailSender.php';
    
    if (!file_exists($gmailSenderPath)) {
        throw new Exception("No se encontró GmailSender.php en: " . $gmailSenderPath);
    }
    
    require_once $gmailSenderPath;
    
    // Verificar que la clase existe
    if (!class_exists('GmailSender')) {
        throw new Exception("La clase GmailSender no está definida");
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error de configuración: ' . $e->getMessage()]);
    exit;
}

// Verificar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Obtener los datos del formulario
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    // Si no es JSON, obtener datos normales del POST
    $input = $_POST;
}

// Validar campos requeridos
$requiredFields = ['name', 'email', 'phone'];
foreach ($requiredFields as $field) {
    if (empty($input[$field])) {
        echo json_encode(['success' => false, 'message' => "El campo {$field} es requerido"]);
        exit;
    }
}

// Validar email
if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Email inválido']);
    exit;
}

// Preparar datos para el email
$data = [
    'name' => strip_tags(trim($input['name'])),
    'email' => strip_tags(trim($input['email'])),
    'phone' => strip_tags(trim($input['phone'])),
    'date' => strip_tags(trim($input['date'] ?? '')),
    'people' => strip_tags(trim($input['people'] ?? '1')),
    'message' => strip_tags(trim($input['message'] ?? '')),
    'tour' => strip_tags(trim($input['tour'] ?? 'Machu Picchu Tour'))
];

// Enviar email
$mailer = new GmailSender();
$result = $mailer->sendEnquiryEmail($data);

// Crear carpeta logs si no existe
$logDir = __DIR__ . '/../logs';
if (!file_exists($logDir)) {
    mkdir($logDir, 0777, true);
}

// Registrar en archivo de log
$logEntry = date('Y-m-d H:i:s') . " - Consulta: " . $data['name'] . " - " . $data['email'] . " - " . ($result['success'] ? 'OK' : 'ERROR') . "\n";
file_put_contents($logDir . '/consultas.log', $logEntry, FILE_APPEND);

echo json_encode($result);
?>