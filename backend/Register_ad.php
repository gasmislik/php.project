<!--Register_ad.php-->
<?php
include 'Connect.php';

class Register_ad {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Method to register a new user
    public function register($code, $firstName, $lastName, $email, $password) {
        $passwordHash = md5($password); // Consider using password_hash() for better security

        try {
            if ($this->emailExists($email)) {
                return "Email Address Already Exists!";
            }
            if ($this->codeExists($code)) {
                return "Invalid Code";
            }

            // Prepare and execute the insert query
            $insertQuery = $this->conn->prepare("INSERT INTO users_ad (code, firstName, lastName, email, password) VALUES (?, ?, ?, ?, ?)");
            $insertQuery->bind_param("sssss", $code, $firstName, $lastName, $email, $passwordHash);
            if ($insertQuery->execute()) {
                return true; // Successful registration
            } else {
                throw new Exception("Error during user registration: " . $this->conn->error);
            }
        } catch (Exception $e) {
            return "An error occurred: " . $e->getMessage();
        }
    }

    // Method to login a user
    public function login($email, $password) {
        $passwordHash = md5($password); // Consider using password_hash() for better security

        $sql = $this->conn->prepare("SELECT * FROM users_ad WHERE email = ? AND password = ?");
        $sql->bind_param("ss", $email, $passwordHash);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            session_start();
            $row = $result->fetch_assoc();
            $_SESSION['email'] = $row['email'];
            header("Location: ../admin/etud_actions.php");
            exit();
        } else {
            return "Not Found, Incorrect Email or Password";
        }
    }

    // Check if email exists
    private function emailExists($email) {
        $checkEmail = $this->conn->prepare("SELECT * FROM users_ad WHERE email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $resultEmail = $checkEmail->get_result();
        return $resultEmail->num_rows > 0;
    }

    // Check if code exists
    private function codeExists($code) {
        $checkCode = $this->conn->prepare("SELECT * FROM users_ad WHERE code = ?");
        $checkCode->bind_param("s", $code);
        $checkCode->execute();
        $resultCode = $checkCode->get_result();
        return $resultCode->num_rows > 0;
    }
}

// Usage
$db = new Connect();
$conn = $db->getConnection();
$userAuth = new Register_ad($conn);

if (isset($_POST['signUp'])) {
    $response = $userAuth->register($_POST['code'], $_POST['fName'], $_POST['lName'], $_POST['email'], $_POST['password']);
    if ($response === true) {
        header("Location: ../admin/index_ad.php");
        exit();
    } else {
        echo $response; // Show error message
    }
}

if (isset($_POST['signIn'])) {
    $response = $userAuth->login($_POST['email'], $_POST['password']);
    if ($response) {
        echo $response; // Show error message
    }
}
?>