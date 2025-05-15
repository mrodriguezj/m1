<?php
// Ruta sugerida: php/auth/verify_token.php
require_once __DIR__ . '/../../vendor/autoload.php';


require_once __DIR__ . '/clave_secreta.php';use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}


$claveSecreta = 'TU_CLAVE_SECRETA_SEGURA'; // debe coincidir con login.php

// Leer el cuerpo del POST
$input = json_decode(file_get_contents('php://input'), true);

// DEBUG: Guarda lo que se recibe para diagnóstico
file_put_contents('../../debug.log', json_encode([
    'hora' => date('Y-m-d H:i:s'),
    'input' => $input
]) . PHP_EOL, FILE_APPEND);

if (!isset($input['token'])) {
    echo json_encode(['valido' => false]);
    exit;
}

$token = $input['token'];

try {
    $decoded = JWT::decode($token, new Key($claveSecreta, 'HS256'));

    // Si llega aquí, el token es válido
    echo json_encode(['valido' => true]);
} catch (Exception $e) {
    // DEBUG: También puedes registrar el mensaje del error si lo necesitas
    // file_put_contents('../../debug.log', "ERROR: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
    echo json_encode(['valido' => false]);
}

