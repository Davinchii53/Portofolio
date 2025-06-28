<?php
header('Content-Type: application/json');

require_once 'config.php';

$conn = getDBConnection();

if (!$conn) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

try {
    $stmt = $conn->query(
        "SELECT name, message, DATE_FORMAT(created_at, '%M %e, %Y') as formatted_date 
         FROM comments 
         ORDER BY created_at DESC 
         LIMIT 10"
    );
    
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($comments);
} catch(PDOException $e) {
    error_log("Error: " . $e->getMessage());
    echo json_encode(['error' => 'Failed to fetch comments']);
}
?>