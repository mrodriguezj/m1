m1
├─── db
│     ├─── .env #Credenciales de conexion a la base de datos
│     ├─── carga_variables.php #Carga las credenciales para conexion a la base de datos
│     ├─── conexion.php #Genera una conexion a la base de datos
│     └─── ConexionPrueba.php #Prueba de funcionalidad de una conexion simple a la base de datos
│
└─── vendor #Componentes instalados "firebase/php-jwt" "spomky-labs/otphp" "endroid/qr-code" "dompdf/dompdf"
│
├─── composer.json
├─── composer.lock
├─── README.md
├─── index.html #Punto de entrada del sistema
│
├─── front #Archivos visuales del cliente
│     ├─── js #archivos JavaScript
│     └─── css #archivos de estilos
│
├─── autentificacion #Modulos para autenticacion y seguridad
│     ├─── verificar_token.php
│     ├─── generar_token.php
│     ├─── generar_otp.php
│     └─── verificar_otp.php
│
├─── comprobantes #Generacion y validacion de comprobantes
│     ├─── generar_provisional.php
│     ├─── enviar_comprobante.php
│     ├─── validar_pago.php
│     └─── plantilla.html
│
├─── sql_tables #Tablas SQL
│     └─── main.sql
│
└─── utilidades #Funciones auxiliares reutilizables
      ├─── generar_qr.php
      ├─── pdf_generator.php
      └─── logger.php

└
│
├
─