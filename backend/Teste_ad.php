<!--Teste_ad.php-->
<?php

class Teste {
    private $conn;

    public function __construct($host, $user, $password, $database) {
        $this->connect($host, $user, $password, $database);
    }

    private function connect($host, $user, $password, $database) {
        $this->conn = new mysqli($host, $user, $password, $database);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection error: " . $this->conn->connect_error);
        }
    }

    public function insertBrands($brands) {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $this->conn->prepare("INSERT INTO doc (name) VALUES (?)");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }

        foreach ($brands as $item) {
            // Bind the parameter and execute the statement
            $stmt->bind_param("s", $item);
            $query_run = $stmt->execute();

            if (!$query_run) {
                return false; // Data insertion failed
            }
        }

        return true; // All data inserted successfully
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

// Usage
session_start();

if (isset($_POST['finich'])) {
    $brands = $_POST['brands'];
    $documentManager = new Teste("localhost", "root", "", "documents");

    try {
        if ($documentManager->insertBrands($brands)) {
            $_SESSION['status'] = "Inserted Successfully";
        } else {
            $_SESSION['status'] = "Data Not Inserted";
        }
    } catch (Exception $e) {
        $_SESSION['status'] = "An error occurred: " . $e->getMessage();
    } finally {
        $documentManager->closeConnection();
        header("Location:../user/documents.php");
        exit();
    }
}
?>
