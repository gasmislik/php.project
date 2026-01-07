<!--send_email_ad.php-->
<?php
require_once('Connect.php');

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Ensure data was sent correctly
if (!isset($data['matricule'], $data['action'], $data['documentName'])) {
    echo json_encode(["message" => "Invalid data"]);
    exit;
}

$matricule = $data['matricule'];
$action = $data['action'];
$documentName = $data['documentName'];

// Connect to the database
$db = new Connect ();
$con = $db->getConnection();

if (!$con) {
    echo json_encode(["message" => "Connection failed"]);
    exit;
}

// Determine the new status based on action
$status = ($action === 'accept') ? 'accepted' : 'refused';

// Prepare the SQL query to update the doc table
$sql = "UPDATE doc SET status = ? WHERE matricule = ? AND name = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("sss", $status, $matricule, $documentName);

// Execute the query
if ($stmt->execute()) {
    // Get the user's email address from the main table
    $userSql = "SELECT email, firstName, lastName FROM main WHERE Matricule = ?";
    $userStmt = $con->prepare($userSql);
    $userStmt->bind_param("s", $matricule);
    $userStmt->execute();
    $result = $userStmt->get_result();
    $user = $result->fetch_assoc();


} else {
    echo json_encode(["message" => "Failed to update document status"]);
}

// Close statements and connection
$stmt->close();
$userStmt->close();
$con->close();
?>
