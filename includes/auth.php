<?php
require_once 'config/database.php';
require_once 'config/session.php';

class Auth {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Register new user
    public function register($full_name, $email, $password, $phone = '', $address = '') {
        // Check if user already exists
        $this->db->query('SELECT id FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        
        if ($this->db->single()) {
            return ['success' => false, 'message' => 'User with this email already exists'];
        }

        // Hash password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $this->db->query('INSERT INTO users (full_name, email, password_hash, phone, address) VALUES (:full_name, :email, :password_hash, :phone, :address)');
        $this->db->bind(':full_name', $full_name);
        $this->db->bind(':email', $email);
        $this->db->bind(':password_hash', $password_hash);
        $this->db->bind(':phone', $phone);
        $this->db->bind(':address', $address);

        if ($this->db->execute()) {
            return ['success' => true, 'message' => 'Registration successful'];
        } else {
            return ['success' => false, 'message' => 'Registration failed'];
        }
    }

    // Login user
    public function login($email, $password) {
        $this->db->query('SELECT * FROM users WHERE email = :email AND is_active = 1');
        $this->db->bind(':email', $email);
        $user = $this->db->single();

        if ($user && password_verify($password, $user['password_hash'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['is_admin'] = $user['is_admin'];
            
            return ['success' => true, 'message' => 'Login successful'];
        } else {
            return ['success' => false, 'message' => 'Invalid email or password'];
        }
    }

    // Logout user
    public function logout() {
        session_destroy();
        return ['success' => true, 'message' => 'Logged out successfully'];
    }

    // Update user profile
    public function updateProfile($user_id, $full_name, $email, $phone, $address) {
        $this->db->query('UPDATE users SET full_name = :full_name, email = :email, phone = :phone, address = :address WHERE id = :id');
        $this->db->bind(':full_name', $full_name);
        $this->db->bind(':email', $email);
        $this->db->bind(':phone', $phone);
        $this->db->bind(':address', $address);
        $this->db->bind(':id', $user_id);

        if ($this->db->execute()) {
            // Update session data
            $_SESSION['full_name'] = $full_name;
            $_SESSION['email'] = $email;
            return ['success' => true, 'message' => 'Profile updated successfully'];
        } else {
            return ['success' => false, 'message' => 'Profile update failed'];
        }
    }
}
?>
