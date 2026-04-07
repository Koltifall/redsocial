<?php
/**
 * Backend de Procesamiento para Code Developer Platform
 * * Este script maneja las peticiones de registro, baneo y apelaciones
 * enviadas desde el frontend.
 */

header('Content-Type: application/json');

// Simulación de base de datos o conexión real
$host = 'localhost';
$db   = 'code_developer_db';
$user = 'root';
$pass = '';

/**
 * Función para procesar apelaciones de usuarios baneados
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'submit_appeal':
            $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
            $message  = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
            
            // Lógica para guardar la apelación en la base de datos
            // e incrementar el contador de intentos del usuario.
            echo json_encode([
                "status" => "success",
                "message" => "Apelación recibida correctamente para el usuario: " . $username
            ]);
            break;

        case 'update_profile':
            $oldUsername = $_POST['old_username'];
            $newUsername = $_POST['new_username'];
            $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            // Actualizar credenciales en servidor
            echo json_encode([
                "status" => "success",
                "message" => "Perfil actualizado en servidor."
            ]);
            break;

        case 'moderate_user':
            $adminToken = $_POST['token'];
            $targetUser = $_POST['target'];
            $modAction  = $_POST['mod_type']; // ban o suspend
            
            // Verificar permisos de admin y aplicar sanción
            echo json_encode([
                "status" => "success",
                "user_notified" => true
            ]);
            break;

        default:
            echo json_encode(["status" => "error", "message" => "Acción no reconocida"]);
            break;
    }
} else {
    echo json_encode(["status" => "error", "message" => "Petición inválida"]);
}
?>
