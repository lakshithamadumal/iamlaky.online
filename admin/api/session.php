
<?php
session_start();
header('Content-Type: application/json');
echo json_encode(['logged_in' => !empty($_SESSION['admin_logged_in'])]);

?>