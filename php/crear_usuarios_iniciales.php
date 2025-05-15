<?php
// Ruta sugerida: /php/auth/crear_usuarios_iniciales.php

require_once __DIR__ . '/../db/conexion.php';

function crearUsuario($conexion, $usuario, $password, $rol) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (usuario, contrasena_hash, rol) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$usuario, $hash, $rol]);
}

try {
    $conexion = conectarBD(); // Esta es la función que retorna PDO en tu conexion.php
    crearUsuario($conexion, "admin", "clave123", "admin");
    crearUsuario($conexion, "generador", "clave123", "generador");
    echo "✅ Usuarios creados correctamente.";
} catch (Exception $e) {
    echo "❌ Error al crear usuarios: " . $e->getMessage();
}
