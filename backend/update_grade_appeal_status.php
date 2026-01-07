<!--update_grade_appeal_status.php-->
<?php
require_once('Connect.php');

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Ensure data was sent correctly
if (!isset($data['id'], $data['action'])) {
    echo json_encode(["message" => "Invalid data"]);
    exit;
}

$id = $data['id'];
$action = $data['action'];

// Connect to the database
$db = new Connect();
$con = $db->getConnection();

if (!$con) {
    echo json_encode(["message" => "Connection failed"]);
    exit;
}

// Determine the new status based on action
$status = $action === 'accept' ? 'accepted' : 'refused';

// Prepare the SQL query to update the grade appeal status in the grad_appeal table
$sql = "UPDATE grade_appeal SET status = ? WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("si", $status, $id);

if ($stmt->execute()) {
    echo json_encode(["message" => ucfirst($action) . "ed successfully"]);
} else {
    echo json_encode(["message" => "Failed to update document status"]);
}

$stmt->close();
$con->close();
?>
