<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../connection.php';

try {
    $result = Database::search("SELECT * FROM projects ORDER BY created_at DESC");
    $projects = [];
    while ($row = $result->fetch_assoc()) {
        $row['has_linkedin'] = (bool)$row['has_linkedin'];
        $row['has_github'] = (bool)$row['has_github'];
        $row['has_download'] = (bool)$row['has_download'];
        $projects[] = $row;
    }
    echo json_encode($projects);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Server error: ' . $e->getMessage()]);
}

?>

