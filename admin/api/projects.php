<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../config.php';

// Authentication middleware
function authenticate() {
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
        header('WWW-Authenticate: Basic realm="Admin Dashboard"');
        http_response_code(401);
        echo json_encode(['message' => 'Authentication required']);
        exit;
    }
    
    $email = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];
    
    // Validate credentials (in a real app, use prepared statements and password_verify)
    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if (!$user || !password_verify($password, $user['password_hash'])) {
        http_response_code(401);
        echo json_encode(['message' => 'Invalid credentials']);
        exit;
    }
    
    return $user;
}

// Handle different request methods
$method = $_SERVER['REQUEST_METHOD'];

try {
    switch ($method) {
        case 'GET':
            // List all projects
            $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($projects);
            break;
            
        case 'POST':
            // Create new project
            $user = authenticate();
            
            // Handle file upload
            $uploadDir = __DIR__ . '/../../assets/uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $projectData = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'project_type' => $_POST['project_type'],
                'live_link' => $_POST['live_link'],
                'has_linkedin' => isset($_POST['has_linkedin']) ? 1 : 0,
                'linkedin_link' => $_POST['linkedin_link'] ?? null,
                'has_github' => isset($_POST['has_github']) ? 1 : 0,
                'github_link' => $_POST['github_link'] ?? null,
                'has_download' => isset($_POST['has_download']) ? 1 : 0,
                'download_link' => $_POST['download_link'] ?? null,
                'gradient_start' => $_POST['gradient_start'] ?? null,
                'gradient_end' => $_POST['gradient_end'] ?? null,
                'svg_code' => $_POST['svg_code'] ?? null,
                'image_path' => null
            ];
            
            if ($projectData['project_type'] === 'image' && isset($_FILES['project_image'])) {
                $file = $_FILES['project_image'];
                $fileName = uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
                $filePath = $uploadDir . $fileName;
                
                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    $projectData['image_path'] = 'assets/uploads/' . $fileName;
                }
            }
            
            // Insert into database
            $stmt = $pdo->prepare("
                INSERT INTO projects (
                    title, description, project_type, image_path, gradient_start, gradient_end, svg_code,
                    live_link, has_linkedin, linkedin_link, has_github, github_link, has_download, download_link
                ) VALUES (
                    :title, :description, :project_type, :image_path, :gradient_start, :gradient_end, :svg_code,
                    :live_link, :has_linkedin, :linkedin_link, :has_github, :github_link, :has_download, :download_link
                )
            ");
            
            if ($stmt->execute($projectData)) {
                http_response_code(201);
                echo json_encode(['message' => 'Project created successfully', 'id' => $pdo->lastInsertId()]);
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Error creating project']);
            }
            break;
            
        case 'PUT':
        case 'DELETE':
            // Implement update and delete as needed
            http_response_code(501);
            echo json_encode(['message' => 'Not implemented yet']);
            break;
            
        default:
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Database error: ' . $e->getMessage()]);
}