<?php
// Ruta sugerida: /php/auth/login.php

require_once __DIR__ . '/../../db/conexion.php';
require_once __DIR__ . '/../../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Content-Type: application/json');

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['usuario']) || !isset($input['password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Faltan datos']);
    exit;
}

$usuario = trim($input['usuario']);
$password = $input['password'];

if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/', $usuario)) {
    http_response_code(422);
    echo json_encode(['error' => 'Usuario inválido']);
    exit;
}

try {
    $pdo = conectarBD();

    $stmt = $pdo->prepare("SELECT id_usuario, usuario, contrasena_hash, rol FROM usuarios WHERE usuario = ? AND activo = 1");
    $stmt->execute([$usuario]);

    if ($stmt->rowCount() === 0) {
        http_response_code(401);
        echo json_encode(['error' => 'Usuario no encontrado o inactivo']);
        exit;
    }

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!password_verify($password, $user['contrasena_hash'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Contraseña incorrecta']);
        exit;
    }

    $payload = [
        'iat' => time(),
        'exp' => time() + 600,
        'uid' => $user['id_usuario'],
        'usuario' => $user['usuario'],
        'rol' => $user['rol']
    ];

    $secretKey = 'TU_CLAVE_SECRETA_SEGURA'; // reemplaza con tu clave real
    $token = JWT::encode($payload, $secretKey, 'HS256');

    echo json_encode(['token' => $token]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Error interno',
        'detalle' => $e->getMessage()
    ]);
}
