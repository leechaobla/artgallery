<?php
include 'database.php';

$artwork_id = intval($_GET['artwork_id']);

$sql = "SELECT c.comment, u.user_name AS username, c.created_at 
        FROM comments c 
        INNER JOIN users u ON c.user_id = u.id 
        WHERE c.artwork_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $artwork_id);
$stmt->execute();
$result = $stmt->get_result();

$comments = [];
while ($row = $result->fetch_assoc()) {
    $comments[] = $row;
}

echo json_encode($comments);

$stmt->close();
$conn->close();
?>
