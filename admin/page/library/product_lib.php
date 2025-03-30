<?php
class Product {
    private $db;

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
    $query = "SELECT p.*, c.name AS name 
              FROM product p
              JOIN categories c ON p.category_id = c.id 
              ORDER BY p.created_at DESC";

    $result = mysqli_query($this->db, $query);
    
    if (!$result) {
        die("Error fetching products: " . mysqli_error($this->db));
    }

    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    return $products;
}

   public function getProductById($id)
    {
        $result = dbSelect('product', '*', "id=$id");
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
        return null;
    }


  

    // Update a product
    public function updateProduct($id, $name, $image, $description, $price, $stock, $category_id) {
         $products = $this->getProductById($id);
        if (!$products) {
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
        return dbUpdate('product', $data, "id=$id");
    }

    // Delete a product
    public function deleteProduct($id) {
        return dbDelete('product', "id=$id");
    }
}
?>
