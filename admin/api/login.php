<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../includes/admin_session.php';
start_admin_session();
header('Content-Type: application/json');
// require_once __DIR__ . '/../../config.php'; // Temporarily comment if error

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

if ($email === 'mandujayaweera2003@gmail.com' && $password === '#Lucky2003') {
    session_regenerate_id(true);
    $_SESSION['admin_logged_in'] = true;
    echo json_encode(['message' => 'Login successful']);
} else {
    http_response_code(401);
    echo json_encode(['message' => 'Invalid credentials']);
}