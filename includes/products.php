<?php
require_once __DIR__ . '/../config/database.php';

class Products {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Get all products
    public function getAllProducts($category_id = null) {
        $query = 'SELECT p.*, c.name as category_name FROM products p 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  WHERE p.is_active = 1';
        
        if ($category_id) {
            $query .= ' AND p.category_id = :category_id';
        }
        
        $query .= ' ORDER BY p.created_at DESC';
        
        $this->db->query($query);
        
        if ($category_id) {
            $this->db->bind(':category_id', $category_id);
        }
        
        return $this->db->resultset();
    }

    // Get single product
    public function getProduct($id) {
        $this->db->query('SELECT p.*, c.name as category_name FROM products p 
                          LEFT JOIN categories c ON p.category_id = c.id 
                          WHERE p.id = :id AND p.is_active = 1');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Get all categories
    public function getCategories() {
        $this->db->query('SELECT * FROM categories ORDER BY name');
        return $this->db->resultset();
    }

    // Add new product (admin only)
    public function addProduct($name, $description, $price, $image_url, $category_id) {
        $this->db->query('INSERT INTO products (name, description, price, image_url, category_id) 
                          VALUES (:name, :description, :price, :image_url, :category_id)');
        $this->db->bind(':name', $name);
        $this->db->bind(':description', $description);
        $this->db->bind(':price', $price);
        $this->db->bind(':image_url', $image_url);
        $this->db->bind(':category_id', $category_id);

        if ($this->db->execute()) {
            return ['success' => true, 'message' => 'Product added successfully'];
        } else {
            return ['success' => false, 'message' => 'Failed to add product'];
        }
    }

    // Update product (admin only)
    public function updateProduct($id, $name, $description, $price, $image_url, $category_id) {
        $this->db->query('UPDATE products SET name = :name, description = :description, 
                          price = :price, image_url = :image_url, category_id = :category_id 
                          WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $name);
        $this->db->bind(':description', $description);
        $this->db->bind(':price', $price);
        $this->db->bind(':image_url', $image_url);
        $this->db->bind(':category_id', $category_id);

        if ($this->db->execute()) {
            return ['success' => true, 'message' => 'Product updated successfully'];
        } else {
            return ['success' => false, 'message' => 'Failed to update product'];
        }
    }

    // Delete product (admin only)
    public function deleteProduct($id) {
        $this->db->query('UPDATE products SET is_active = 0 WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return ['success' => true, 'message' => 'Product deleted successfully'];
        } else {
            return ['success' => false, 'message' => 'Failed to delete product'];
        }
    }
}
?>
