<!--fetchNotifications.php-->
<?php

class fetchNotifications{
    private $conn;
    private $docMatricule;
    private $gradeAppealMatricule;

    public function __construct($conn, $docMatricule = null, $gradeAppealMatricule = null) {
        $this->conn = $conn;
        $this->docMatricule = $docMatricule;
        $this->gradeAppealMatricule = $gradeAppealMatricule;
    }

    private function getNotificationCount($table, $column, $value) {
        $query = "SELECT COUNT(*) AS notification_count FROM $table WHERE $column = ? AND (status = 'Accepted' OR status = 'Refused')";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $this->conn->error);
        }
        $stmt->bind_param("s", $value);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['notification_count'];
        }
        throw new Exception("Query execution failed: " . $stmt->error);
    }

    public function getDocNotifications() {
        if ($this->docMatricule) {
            return $this->getNotificationCount("doc", "Matricule", $this->docMatricule);
        }
        return 0;
    }

    public function getGradeAppealNotifications() {
        if ($this->gradeAppealMatricule) {
            return $this->getNotificationCount("grade_appeal", "matricule", $this->gradeAppealMatricule);
        }
        return 0;
    }

    public function getTotalNotifications() {
        return $this->getDocNotifications() + $this->getGradeAppealNotifications();
    }
}

// Fetch session variables
$docMatricule = $_SESSION['matricule'] ?? null;
$gradeAppealMatricule = $_SESSION['matricule'] ?? null; // Use the same session variable or modify as needed

try {
    // Create NotificationHandler instance
    $notificationHandler = new fetchNotifications($conn, $docMatricule, $gradeAppealMatricule);

    // Get notification counts
    $docNotificationCount = $notificationHandler->getDocNotifications();
    $gradeAppealrNotificationCount = $notificationHandler->getGradeAppealNotifications();
    $totalNotifications = $notificationHandler->getTotalNotifications();

   
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
