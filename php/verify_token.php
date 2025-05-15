<?php
// Ruta sugerida: /php/verify_token.php

require_once __DIR__ . '/../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Content-Type: application/json');

$headers = getallheaders();
$authHeader = $headers['Authorization'] ?? '';

if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
    http_response_code(401);
    echo json_encode(['error' => 'Token no proporcionado']);
    exit;
}

$token = str_replace('Bearer ', '', $authHeader);
$secretKey = 'TU_CLAVE_SECRETA_SEGURA'; // reemplaza con tu clave real

try {
    $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));

    echo json_encode([
        'valid' => true,
        'usuario' => $decoded->usuario,
        'rol' => $decoded->rol,
        'expira_en' => $decoded->exp
    ]);
} catch (Exception $e) {
    http_response_code(401);
    echo json_encode([
        'valid' => false,
        'error' => 'Token inválido o expirado',
        'detalle' => $e->getMessage()
    ]);
}
