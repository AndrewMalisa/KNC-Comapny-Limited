<?php
require_once __DIR__ . '/../config/database.php';

class Users {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Get all users
    public function getAllUsers() {
        $this->db->query('SELECT * FROM users ORDER BY created_at DESC');
        return $this->db->resultset();
    }

    // Get total user count
    public function getTotalUsers() {
        $this->db->query('SELECT COUNT(*) as total FROM users WHERE is_active = 1');
        $result = $this->db->single();
        return $result['total'];
    }

    // Get recent users
    public function getRecentUsers($limit = 5) {
        $this->db->query('SELECT * FROM users ORDER BY created_at DESC LIMIT :limit');
        $this->db->bind(':limit', $limit);
        return $this->db->resultset();
    }

    // Get single user
    public function getUser($id) {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Toggle user status (admin only)
    public function toggleUserStatus($user_id) {
        // First get current status
        $this->db->query('SELECT is_active FROM users WHERE id = :id AND is_admin = 0');
        $this->db->bind(':id', $user_id);
        $user = $this->db->single();

        if (!$user) {
            return ['success' => false, 'message' => 'User not found or is admin'];
        }

        $new_status = $user['is_active'] ? 0 : 1;
        
        $this->db->query('UPDATE users SET is_active = :status WHERE id = :id');
        $this->db->bind(':status', $new_status);
        $this->db->bind(':id', $user_id);

        if ($this->db->execute()) {
            $action = $new_status ? 'activated' : 'deactivated';
            return ['success' => true, 'message' => "User successfully {$action}"];
        } else {
            return ['success' => false, 'message' => 'Failed to update user status'];
        }
    }

    // Update user profile
    public function updateUser($id, $full_name, $email, $phone, $address) {
        $this->db->query('UPDATE users SET full_name = :full_name, email = :email, phone = :phone, address = :address WHERE id = :id');
        $this->db->bind(':full_name', $full_name);
        $this->db->bind(':email', $email);
        $this->db->bind(':phone', $phone);
        $this->db->bind(':address', $address);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return ['success' => true, 'message' => 'Profile updated successfully'];
        } else {
            return ['success' => false, 'message' => 'Failed to update profile'];
        }
    }

    // Get user orders
    public function getUserOrders($user_id) {
        $this->db->query('SELECT o.*, p.name as product_name, p.image_url 
                          FROM orders o 
                          JOIN products p ON o.product_id = p.id 
                          WHERE o.user_id = :user_id 
                          ORDER BY o.created_at DESC');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultset();
    }
}
?>
