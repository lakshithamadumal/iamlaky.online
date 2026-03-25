<?php
require_once __DIR__ . '/../includes/admin_session.php';
start_admin_session();
header('Content-Type: application/json');
echo json_encode(['logged_in' => !empty($_SESSION['admin_logged_in'])]);

?>