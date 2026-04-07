<?php
/**
 * ARCHIVO DE CONFIGURACIÓN DE BACK-END
 * Este archivo gestiona las credenciales de acceso para la interfaz administrativa.
 */

$ADMIN_CREDENTIALS = [
    "nro"   => "593-EC.dev",
    "clave" => "24865139"
];

// Lógica de respuesta para peticiones de validación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (isset($input['nro']) && isset($input['clave'])) {
        if ($input['nro'] === $ADMIN_CREDENTIALS['nro'] && $input['clave'] === $ADMIN_CREDENTIALS['clave']) {
            header('Content-Type: application/json');
            echo json_encode([
                "status" => "success",
                "token" => bin2hex(random_bytes(32)),
                "role" => "admin"
            ]);
            exit;
        }
    }
    
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(["status" => "error", "message" => "Acceso denegado"]);
}
?>
