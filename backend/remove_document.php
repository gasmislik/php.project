<!--remove_document.php-->
<?php
require_once('Teste.php');

// Clear any previous output
if (ob_get_length()) ob_clean();

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$documentId = $data['id'] ?? null;

$response = ['success' => false, 'message' => ''];

if (!$documentId) {
    $response['message'] = 'No document ID provided';
    echo json_encode($response);
    exit();
}

try {
    // Start transaction
    $conn->begin_transaction();
    
    $query = "DELETE FROM doc WHERE id = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("i", $documentId);
    $executed = $stmt->execute();
    
    if ($executed && $stmt->affected_rows > 0) {
        $conn->commit();
        $response['success'] = true;
        $response['message'] = 'Document deleted successfully';
    } else {
        $conn->rollback();
        $response['message'] = 'No document found with that ID or deletion failed';
    }
    
    $stmt->close();
} catch (Exception $e) {
    if (isset($conn)) $conn->rollback();
    $response['message'] = 'Error: ' . $e->getMessage();
}

echo json_encode($response);
exit(); // Ensure no additional output