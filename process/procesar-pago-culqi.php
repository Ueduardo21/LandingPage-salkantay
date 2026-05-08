<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);

header('Content-Type: application/json');

require_once __DIR__ . '/../vendor/autoload.php';

use Culqi\Culqi;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true) ?: [];

$token = $input['token'] ?? '';
$email = $input['email'] ?? '';
$amount = intval($input['amount'] ?? 0);

if (!$token || !$email || $amount <= 0) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos para procesar pago']);
    exit;
}

$config = require __DIR__ . '/../config/culqi.php';

try {
    $culqi = new Culqi(['api_key' => $config['secret_key']]);

    $charge = $culqi->Charges->create([
        'amount' => $amount,
        'capture' => true,
        'currency_code' => 'PEN',
        'description' => 'Reserva Machu Picchu Tour',
        'email' => $email,
        'source_id' => $token
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Pago procesado correctamente',
        'charge_id' => $charge->id ?? null,
        'charge' => $charge
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Pago rechazado: ' . $e->getMessage()
    ]);
}
exit;

?>