<?php
// Ruta sugerida: /php/conexion.php

require_once __DIR__ . '/carga_variables.php';

function conectarBD() {
    try {
        $host = $GLOBALS['db_host'];
        $dbname = $GLOBALS['db_nombre'];
        $usuario = $GLOBALS['db_usuario'];
        $contrasena = $GLOBALS['db_contrasena'];

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        return new PDO($dsn, $usuario, $contrasena, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}
