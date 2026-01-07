<?php
require_once('../backend/Connect.php');

class SqlQueries {
    private $db;
    private $con;

    public function __construct() {
        $this->db = new Connect();
        $this->con = $this->db->getConnection();
        
        if (!$this->con) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function __destruct() {
        // Close the connection when the object is destroyed
        if ($this->con) {
            $this->con->close();
        }
    }

    public function getDocumentActions($search = '') {
        // Check if connection is still open
        if (!$this->con || !$this->con->ping()) {
            $this->con = $this->db->getConnection(); // Reconnect if needed
        }

        $search = $this->con->real_escape_string($search);
        $sql = "SELECT m.matricule, u.firstName, u.lastName, m.annee, m.groupe, m.section, m.specialite, d.name AS document_name, d.created_at
                FROM main m 
                LEFT JOIN doc d ON m.matricule = d.matricule
                LEFT JOIN users u ON m.matricule = u.matricule
                WHERE d.name IS NOT NULL 
                AND d.name != '' 
                AND d.status = 'pending'";

        if (strlen($search) > 0) {
            $sql .= " AND (
                m.matricule LIKE '$search%' OR 
                u.firstName LIKE '$search%' OR 
                u.lastName LIKE '$search%' OR 
                m.annee LIKE '$search%' OR 
                m.groupe LIKE '$search%' OR 
                (m.section LIKE '$search%' OR m.section = REPLACE('$search', 'section ', '')) OR 
                m.specialite LIKE '$search%' OR 
                d.created_at LIKE '$search%' OR 
                d.name LIKE '$search%'
            )";
        }

        $sql .= " ORDER BY d.created_at ASC";
        $result = $this->con->query($sql);

        if (!$result) {
            die('Query failed: ' . $this->con->error);
        }

        return $result;
    }

    public function getGradeAppealRequests($search = '') {
        // Check if connection is still open
        if (!$this->con || !$this->con->ping()) {
            $this->con = $this->db->getConnection(); // Reconnect if needed
        }

        $search = $this->con->real_escape_string($search);
        $sql = "SELECT 
                    r.matricule, 
                    r.moduleName, 
                    r.teacherName, 
                    r.wrongNote, 
                    r.correctNote,
                    u.firstName, 
                    u.lastName, 
                    m.annee, 
                    m.groupe, 
                    m.section, 
                    m.specialite,
                    r.created_at AS grade_appeal_created_at,  
                    r.id 
                FROM grade_appeal r
                LEFT JOIN main m ON r.matricule = m.matricule
                LEFT JOIN users u ON m.matricule = u.matricule
                WHERE r.status = 'Pending'";

        if (strlen($search) > 0) {
            $sql .= " AND (
                r.matricule LIKE '$search%' OR 
                r.moduleName LIKE '$search%' OR 
                r.teacherName LIKE '$search%' OR 
                r.wrongNote LIKE '$search%' OR 
                r.correctNote LIKE '$search%' OR 
                u.firstName LIKE '$search%' OR 
                u.lastName LIKE '$search%' OR 
                m.annee LIKE '$search%' OR 
                m.groupe LIKE '$search%' OR 
                m.section LIKE '$search%' OR 
                r.created_at LIKE '$search%' OR 
                m.specialite LIKE '$search%'
            )";
        }
        $sql .= " ORDER BY r.created_at ASC";
        $result = $this->con->query($sql);

        if (!$result) {
            die('Query failed: ' . $this->con->error);
        }

        return $result;
    }

    public function insertStudent($matricule, $annee, $groupe, $section, $specialite) {
        // Check if connection is still open
        if (!$this->con || !$this->con->ping()) {
            $this->con = $this->db->getConnection(); // Reconnect if needed
        }

        $matricule = $this->con->real_escape_string($matricule);
        $annee = $this->con->real_escape_string($annee);
        $groupe = $this->con->real_escape_string($groupe);
        $section = $this->con->real_escape_string($section);
        $specialite = $this->con->real_escape_string($specialite);

        $sql = "INSERT INTO main (matricule, annee, groupe, section, specialite) 
                VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $this->con->prepare($sql)) {
            $stmt->bind_param("sssss", $matricule, $annee, $groupe, $section, $specialite);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        } else {
            return false;
        }
    }
}
?>