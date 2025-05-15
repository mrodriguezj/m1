
-- Tabla: usuarios
CREATE TABLE `usuarios` (
  `id_usuario` int unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL UNIQUE,
  `contrasena_hash` varchar(255) NOT NULL,
  `rol` enum('admin', 'generador') NOT NULL DEFAULT 'generador',
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_usuario`)
);

-- Tabla: propiedades_ext
CREATE TABLE `propiedades_ext` (
  `id_lote` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador único del lote',
  `dimensiones` decimal(8,2) NOT NULL COMMENT 'Dimensiones del lote en metros cuadrados',
  `precio` decimal(10,2) NOT NULL COMMENT 'Precio de la propiedad',
  `tipo` enum('Premium','Regular','Comercial') NOT NULL COMMENT 'Tipo de lote',
  `disponibilidad` enum('Disponible','Vendido','Reservado') NOT NULL COMMENT 'Estado de disponibilidad',
  `desarrollo` varchar(50) NOT NULL COMMENT 'Nombre del desarrollo o fraccionamiento',
  `etapa` tinyint(3) unsigned NOT NULL COMMENT 'Número de etapa (entero positivo y pequeño)',
  `calle` enum('Calle Colibri','Calle Quetzal','Calle Aguila','Calle Paloma','Avenida Ramal Norte') NOT NULL COMMENT 'Calle donde se ubica la propiedad',
  `observaciones` text DEFAULT NULL COMMENT 'Comentarios adicionales sobre la propiedad',
  PRIMARY KEY (`id_lote`)
);

-- Tabla: cuentas_bancarias
CREATE TABLE `cuentas_bancarias` (
  `id_banco` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `cuenta` varchar(50) NOT NULL,
  `clabe` varchar(20) NOT NULL,
  `titular` varchar(100) NOT NULL,
  PRIMARY KEY (`id_banco`)
);

-- Tabla: comprobantes_generados
CREATE TABLE `comprobantes_generados` (
  `id_comprobante` int unsigned NOT NULL AUTO_INCREMENT,
  `id_lote` int unsigned NOT NULL,
  `id_usuario` int unsigned NOT NULL,
  `fecha_pago` date NOT NULL,
  `fecha_generado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_pagado` decimal(10,2) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `estado` enum('pendiente', 'procesado', 'cancelado') NOT NULL DEFAULT 'pendiente',
  PRIMARY KEY (`id_comprobante`),
  FOREIGN KEY (`id_lote`) REFERENCES propiedades_ext(`id_lote`),
  FOREIGN KEY (`id_usuario`) REFERENCES usuarios(`id_usuario`)
);
