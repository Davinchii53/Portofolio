<?php
header('Content-Type: application/json');

require_once 'config.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getDBConnection();
    
    if (!$conn) {
        $response['message'] = 'Database connection error';
        echo json_encode($response);
        exit;
    }

    // Validasi input
    $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $message = isset($_POST['message']) ? sanitizeInput($_POST['message']) : '';

    if (empty($name) || empty($email) || empty($message)) {
        $response['message'] = 'All fields are required';
        echo json_encode($response);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Invalid email format';
        echo json_encode($response);
        exit;
    }

    try {
        $stmt = $conn->prepare(
            "INSERT INTO comments (name, email, message) 
             VALUES (:name, :email, :message)"
        );
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Thank you for your comment!';
            $response['comment'] = [
                'name' => $name,
                'message' => $message,
                'date' => date('Y-m-d H:i:s')
            ];
        }
    } catch(PDOException $e) {
        error_log("Error: " . $e->getMessage());
        $response['message'] = 'Failed to save comment';
    }
} else {
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
?>