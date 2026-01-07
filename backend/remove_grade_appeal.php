<!--remove_grade_appeal.php-->
<?php
// Ensure the session is started
session_start();

// Include your database connection file
require_once('Teste.php');

// Check if the gradeAppealId is provided in the request
if (isset($_POST['gradeAppealId'])) {
    $gradeAppealId = $_POST['gradeAppealId'];

    // Prepare the SQL statement to delete the record
    $query = "DELETE FROM grade_appeal WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $gradeAppealId);

    // Execute the statement and check if the deletion was successful
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No gradeAppealId provided";
}

// Close the database connection
$conn->close();
?>
