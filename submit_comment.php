<?php
session_start();
include 'database.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['artwork_id'], $data['comment']) || empty(trim($data['comment']))) {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
    exit();
}

$artwork_id = intval($data['artwork_id']);
$comment = trim($data['comment']);
$user_id = intval($_SESSION['user_id']);

$sql = "INSERT INTO comments (artwork_id, user_id, comment) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(['success' => false, 'error' => 'Database error']);
    exit();
}

$stmt->bind_param('iis', $artwork_id, $user_id, $comment);
$success = $stmt->execute();

$response = ['success' => $success];
if ($success) {
    $response['username'] = $_SESSION['username'];
    $response['created_at'] = date('Y-m-d H:i:s'); 
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>
