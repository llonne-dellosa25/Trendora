<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost", "root", "", "trendora");
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function userExists($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    // Update to use 'fullname' instead of 'full_name'
    public function registerUser($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Update the query to match the actual column name 'fullname'
        $stmt = $this->db->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);
        
        return $stmt->execute();
    }

    public function __destruct() {
        $this->db->close();
    }

    class User {
        private $db;
    
        public function __construct() {
            $this->db = new mysqli("localhost", "root", "", "trendora");
            if ($this->db->connect_error) {
                die("Connection failed: " . $this->db->connect_error);
            }
        }
    
        public function userExists($email) {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->num_rows > 0;
        }
    
        public function getUserByEmail($email) {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();  // Returns user data
        }
    
        public function registerUser($name, $email, $password) {
            $stmt = $this->db->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $password);
            return $stmt->execute();
        }
    }
    
}
