<?php
include "pdo.php";

$pdo = getPDO();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
  $messageId = intval($_POST['id']); // Get ID and sanitize it

  try {
    // Prepare and execute the DELETE statement
    $stmt = $pdo->prepare("DELETE FROM messages WHERE id = :id");
    $stmt->bindParam(':id', $messageId, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      echo json_encode(["success" => true]);
    } else {
      echo json_encode(["success" => false, "error" => "Message not found"]);
    }
  } catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
  }
} else {
  echo json_encode(["success" => false, "error" => "Invalid request"]);
}
?>
