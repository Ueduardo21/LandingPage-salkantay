<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

try {
    require_once __DIR__ . '/../includes/GmailSender.php';

    if (!class_exists('GmailSender')) {
        throw new Exception("La clase GmailSender no está definida");
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error de configuración: ' . $e->getMessage()
    ]);
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

function limpiar($valor)
{
    return strip_tags(trim($valor ?? ''));
}

$requiredFields = [
    'nombre_completo',
    'email',
    'telefono',
    'fecha',
    'personas',
    'tipo_servicio',
    'metodo_pago'
];

foreach ($requiredFields as $field) {
    if (empty($input[$field])) {
        echo json_encode([
            'success' => false,
            'message' => "Falta el campo requerido: {$field}"
        ]);
        exit;
    }
}

if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Email inválido']);
    exit;
}

$tipoServicio = limpiar($input['tipo_servicio']);
$personas = intval($input['personas']);
$precioBase = $tipoServicio === 'grupal' ? 520 : 850;
$total = $precioBase * $personas;

$metodoPago = limpiar($input['metodo_pago']);

$codigoReserva = 'RES-' . date('Ymd-His') . '-' . rand(100, 999);

$estadoPago = 'pendiente_confirmacion';

if ($metodoPago === 'tarjeta') {
    $estadoPago = 'pago_simulado_aprobado';
} elseif ($metodoPago === 'paypal') {
    $estadoPago = 'pendiente_paypal';
} elseif ($metodoPago === 'yape' || $metodoPago === 'plin') {
    $estadoPago = 'pendiente_validacion_manual';
}

$data = [
    'codigo_reserva' => $codigoReserva,
    'estado_pago' => $estadoPago,
    'metodo_pago' => $metodoPago,

    'nombre_completo' => limpiar($input['nombre_completo']),
    'email' => limpiar($input['email']),
    'telefono' => limpiar($input['telefono']),
    'tipo_documento' => limpiar($input['tipo_documento'] ?? ''),
    'numero_documento' => limpiar($input['numero_documento'] ?? ''),
    'edad' => limpiar($input['edad'] ?? ''),
    'sexo' => limpiar($input['sexo'] ?? ''),
    'pais' => limpiar($input['pais'] ?? ''),

    'tour' => limpiar($input['tour'] ?? 'Machu Picchu Tour'),
    'fecha' => limpiar($input['fecha']),
    'fecha_alternativa' => limpiar($input['fecha_alternativa'] ?? ''),
    'personas' => $personas,
    'tipo_servicio' => $tipoServicio,
    'precio_unitario' => $precioBase,
    'total' => $total,
    'moneda' => 'USD',
    'mensaje' => limpiar($input['mensaje'] ?? ''),
    'created_at' => date('Y-m-d H:i:s')
];

$logDir = __DIR__ . '/../logs';
if (!file_exists($logDir)) {
    mkdir($logDir, 0777, true);
}

$jsonFile = $logDir . '/reservas.json';

$reservas = [];
if (file_exists($jsonFile)) {
    $contenido = file_get_contents($jsonFile);
    $reservas = json_decode($contenido, true) ?: [];
}

$reservas[] = $data;
file_put_contents($jsonFile, json_encode($reservas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));


try {
    $mailer = new GmailSender();
    $result = $mailer->sendReservationEmail($data);
} catch (Exception $e) {
    $result = [
        'success' => false,
        'message' => 'Reserva registrada, pero falló el envío de correo: ' . $e->getMessage()
    ];
}


/* 
$result = [
    'success' => true,
    'message' => 'Email simulado OK'
];
*/

$logEntry = date('Y-m-d H:i:s') .
    " - Reserva {$codigoReserva} - {$data['nombre_completo']} - {$data['email']} - {$metodoPago} - {$estadoPago}\n";

file_put_contents($logDir . '/reservas.log', $logEntry, FILE_APPEND);


ob_clean(); // 🔥 limpia cualquier salida previa

echo json_encode([
    'success' => true,
    'message' => 'Reserva registrada correctamente',
    'codigo_reserva' => $codigoReserva,
    'estado_pago' => $estadoPago,
    'metodo_pago' => $metodoPago,
    'total' => $total,
    'email_status' => $result
]);

exit;

?>
