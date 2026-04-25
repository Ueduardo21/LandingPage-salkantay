<?php
// ============================================
// PROCESAR RESERVA AJAX - CORREGIDO
// ============================================

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

try {
    $gmailSenderPath = __DIR__ . '/../includes/GmailSender.php';
    
    if (!file_exists($gmailSenderPath)) {
        throw new Exception("No se encontró GmailSender.php en: " . $gmailSenderPath);
    }
    
    require_once $gmailSenderPath;
    
    if (!class_exists('GmailSender')) {
        throw new Exception("La clase GmailSender no está definida");
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error de configuración: ' . $e->getMessage()]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    $input = $_POST;
}

// Validar campos principales
if (empty($input['nombre_completo']) || empty($input['email']) || empty($input['telefono'])) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos requeridos']);
    exit;
}

$mailer = new GmailSender();
$result = $mailer->sendReservationEmail($input);

$logDir = __DIR__ . '/../logs';
if (!file_exists($logDir)) {
    mkdir($logDir, 0777, true);
}

$logEntry = date('Y-m-d H:i:s') . " - Reserva: " . $input['nombre_completo'] . " - " . $input['email'] . " - " . ($result['success'] ? 'OK' : 'ERROR') . "\n";
file_put_contents($logDir . '/reservas.log', $logEntry, FILE_APPEND);

echo json_encode($result);
?>