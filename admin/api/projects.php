<?php
session_start();
header('Content-Type: application/json');

if (empty($_SESSION['admin_logged_in'])) {
    http_response_code(401);
    echo json_encode(['message' => 'Unauthorized']);
    exit;
}

require_once __DIR__ . '/../../connection.php';

$method = $_SERVER['REQUEST_METHOD'];

try {
    switch ($method) {
        case 'GET':
            // List all projects
            $result = Database::search("SELECT * FROM projects ORDER BY created_at DESC");
            $projects = [];
            while ($row = $result->fetch_assoc()) {
                $row['has_linkedin'] = (bool)$row['has_linkedin'];
                $row['has_github'] = (bool)$row['has_github'];
                $row['has_download'] = (bool)$row['has_download'];
                $projects[] = $row;
            }
            echo json_encode($projects);
            break;

        case 'POST':
            // Create new project
            $uploadDir = __DIR__ . '/../../assets/uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $title = Database::escape_string($_POST['title'] ?? '');
            $description = Database::escape_string($_POST['description'] ?? '');
            $project_type = Database::escape_string($_POST['project_type'] ?? 'image');
            $live_link = Database::escape_string($_POST['live_link'] ?? '');

            $has_linkedin = filter_var($_POST['has_linkedin'] ?? false, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
            $has_github = filter_var($_POST['has_github'] ?? false, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
            $has_download = filter_var($_POST['has_download'] ?? false, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;

            $linkedin_link_val = $has_linkedin ? "'" . Database::escape_string($_POST['linkedin_link'] ?? '') . "'" : "NULL";
            $github_link_val = $has_github ? "'" . Database::escape_string($_POST['github_link'] ?? '') . "'" : "NULL";
            $download_link_val = $has_download ? "'" . Database::escape_string($_POST['download_link'] ?? '') . "'" : "NULL";

            $gradient_start_val = ($project_type === 'gradient') ? "'" . Database::escape_string($_POST['gradient_start'] ?? '') . "'" : "NULL";
            $gradient_end_val = ($project_type === 'gradient') ? "'" . Database::escape_string($_POST['gradient_end'] ?? '') . "'" : "NULL";
            $svg_code_val = ($project_type === 'gradient') ? "'" . Database::escape_string($_POST['svg_code'] ?? '') . "'" : "NULL";

            $image_path_val = "NULL";
            if ($project_type === 'image' && isset($_FILES['project_image']) && is_uploaded_file($_FILES['project_image']['tmp_name'])) {
                $file = $_FILES['project_image'];
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $fileName = uniqid('project_', true) . ($ext ? ('.' . $ext) : '');
                $filePath = $uploadDir . $fileName;
                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    $relativePath = 'assets/uploads/' . $fileName;
                    $image_path_val = "'" . Database::escape_string($relativePath) . "'";
                }
            }

            if ($title === '' || $description === '' || $live_link === '') {
                http_response_code(400);
                echo json_encode(['message' => 'Missing required fields']);
                exit;
            }

            $q = "INSERT INTO projects (
                    title, description, project_type, image_path, gradient_start, gradient_end, svg_code,
                    live_link, has_linkedin, linkedin_link, has_github, github_link, has_download, download_link
                ) VALUES (
                    '$title', '$description', '$project_type', $image_path_val, $gradient_start_val, $gradient_end_val, $svg_code_val,
                    '$live_link', $has_linkedin, $linkedin_link_val, $has_github, $github_link_val, $has_download, $download_link_val
                )";

            Database::iud($q);
            http_response_code(201);
            echo json_encode(['message' => 'Project created successfully']);
            break;

        case 'DELETE':
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            if ($id <= 0) {
                http_response_code(400);
                echo json_encode(['message' => 'Invalid project id']);
                exit;
            }

            // Remove image file if present
            $res = Database::search("SELECT image_path FROM projects WHERE id = $id");
            if ($res && $res->num_rows === 1) {
                $row = $res->fetch_assoc();
                if (!empty($row['image_path'])) {
                    $full = __DIR__ . '/../../' . $row['image_path'];
                    if (file_exists($full)) {
                        @unlink($full);
                    }
                }
            }

            Database::iud("DELETE FROM projects WHERE id = $id");
            echo json_encode(['message' => 'Project deleted successfully']);
            break;

        default:
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Server error: ' . $e->getMessage()]);
}