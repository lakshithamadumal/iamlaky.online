<?php
require_once __DIR__ . '/../includes/admin_session.php';
start_admin_session();

$_SESSION = [];

if (ini_get('session.use_cookies')) {
	$params = session_get_cookie_params();
	setcookie(
		session_name(),
		'',
		time() - 42000,
		$params['path'] ?? '/',
		$params['domain'] ?? '',
		(bool) ($params['secure'] ?? false),
		(bool) ($params['httponly'] ?? true)
	);
}

session_destroy();
header('Content-Type: application/json');
echo json_encode(['message' => 'Logged out']);