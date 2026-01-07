<!--sql_queries.php-->
<?php
// Check if a session is already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
   
}

require_once('../backend/Teste.php');

// Retrieve Matricule from session
$matricule = $_SESSION['matricule'] ?? null;

if (!$matricule) {
    echo "No matricule found in session.";
    exit();
}

// Fetch documents from the doc table
function getDocDocuments($conn, $matricule) {
    $docQuery = "SELECT * FROM doc WHERE Matricule = ?";
    $docStmt = $conn->prepare($docQuery);
    $docStmt->bind_param("s", $matricule);
    $docStmt->execute();
    return $docStmt->get_result();
}

// Fetch all submitted information for the matricule
function getGradeAppealInfo($conn, $matricule) {
    $queryGradeAppeal = "SELECT * FROM grade_appeal WHERE matricule = ?";
    $stmtGradeAppeal = $conn->prepare($queryGradeAppeal);
    $stmtGradeAppeal->bind_param("s", $matricule);
    $stmtGradeAppeal->execute();
    return $stmtGradeAppeal->get_result();
}

// Handle document submission
function handleDocumentSubmission($conn, $matricule, $documentNames) {
    $_SESSION['checked_documents'] = $documentNames;

    $checkQuery = $conn->prepare("SELECT Matricule FROM main WHERE Matricule = ?");
    $checkQuery->bind_param("s", $matricule);
    $checkQuery->execute();
    $checkQuery->store_result();

    if ($checkQuery->num_rows > 0) {
        foreach ($documentNames as $documentName) {
            $checkDocQuery = $conn->prepare("SELECT * FROM doc WHERE Matricule = ? AND name = ?");
            $checkDocQuery->bind_param("ss", $matricule, $documentName);
            $checkDocQuery->execute();
            $checkDocQuery->store_result();

            if ($checkDocQuery->num_rows == 0) {
                $stmt = $conn->prepare("INSERT INTO doc (Matricule, name) VALUES (?, ?)");
                $stmt->bind_param("ss", $matricule, $documentName);

                if ($stmt->execute()) {
                    $_SESSION['status'] = "Documents successfully requested.";
                } else {
                    $_SESSION['status'] = "Error: " . $stmt->error;
                }
            }
        }
    } else {
        $_SESSION['status'] = "Matricule '{$matricule}' does not exist in the main table.";
    }
}

// Handle grade appeal submission
function handleGradeAppealSubmission($conn, $moduleName, $teacherName, $wrongNote, $correctNote) {
    $matricule = $_SESSION['matricule'] ?? null;

    if ($matricule) {
        $query = "INSERT INTO grade_appeal (matricule, moduleName, teacherName, wrongNote, correctNote) VALUES (?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("sssii", $matricule, $moduleName, $teacherName, $wrongNote, $correctNote);
            
            if ($stmt->execute()) {
                $_SESSION['status'] = "Information saved successfully.";
            } else {
                $_SESSION['status'] = "Error saving information: " . $stmt->error;
            }
        } else {
            $_SESSION['status'] = "Error preparing the query: " . $conn->error;
        }
    } else {
        $_SESSION['status'] = "No matricule found in session.";
    }
}
?>