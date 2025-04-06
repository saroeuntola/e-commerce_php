<?php
class Product {
    public $db;

    public function __construct() {
        $this->db = dbConn(); 
    }

    // Create a new product
    public function createProduct($name, $image, $description, $price, $stock, $category_id) {
        $data = [
            'name' => $name,
            'image' => $image,
            'description' => $description,
            'price' => $price,
            'stock' => $stock,
            'category_id' => $category_id
        ];
        return dbInsert('product', $data);
    }

    // Get all products
    public function getProducts() {
        $query = "SELECT p.*, c.name AS category_name 
                  FROM product p
                  JOIN categories c ON p.category_id = c.id 
                  ORDER BY p.created_at DESC";

        try {
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching products: " . $e->getMessage());
        }
    }

    // Get a single product by ID
    public function getProductById($id) {
        $result = dbSelect('product', '*', "id=" . $this->db->quote($id));
        return ($result && count($result) > 0) ? $result[0] : null;
    }

    // Update a product
    public function updateProduct($id, $name, $image, $description, $price, $stock, $category_id) {
        if (!$this->getProductById($id)) {
            return false; 
        }

        $data = [
            'name' => $name,
            'image' => $image,
            'description' => $description,
            'price' => $price,
            'stock' => $stock,
            'category_id' => $category_id
        ];
        return dbUpdate('product', $data, "id=" . $this->db->quote($id));
    }

    // Delete a product
    public function deleteProduct($id) {
        return dbDelete('product', "id=" . $this->db->quote($id));
    }
}
?>
