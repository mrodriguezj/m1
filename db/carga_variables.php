<?php
// Ruta sugerida: /php/carga_variables.php

$envPath = __DIR__ . '/.env';
if (!file_exists($envPath)) {
    die("Archivo .env no encontrado");
}

$env = parse_ini_file($envPath);

$GLOBALS['db_host'] = $env['DB_HOST'] ?? '127.0.0.1';
$GLOBALS['db_nombre'] = $env['DB_NAME'] ?? 'comprobantes';
$GLOBALS['db_usuario'] = $env['DB_USER'] ?? 'root';
$GLOBALS['db_contrasena'] = $env['DB_PASS'] ?? '';
