<?php
class Category
{
    private $db;

    public function __construct()
    {
        $this->db = dbConn(); 
    }

    // CREATE a new category
    public function createCategory($name)
    {

        $result = dbSelect('categories', 'id', "name='$name'");
        if ($result && mysqli_num_rows($result) > 0) {
            return false; 
        }
        $data = [
            'name' => $name
        ];

        return dbInsert('categories', $data);
    }

    // READ all categories
    public function getCategories()
    {
        $result = dbSelect('categories', '*');
        return $result;
    }

    // READ a specific category by ID
    public function getCategory($id)
    {
        $result = dbSelect('categories', '*', "id=$id");
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
        return null;
    }

    // UPDATE a category
    public function updateCategory($id, $newName)
    {
        // Check if the category exists
        $category = $this->getCategory($id);
        if (!$category) {
            return false; // Category doesn't exist
        }

        // Update the category
        $data = [
            'name' => $newName
        ];

        return dbUpdate('categories', $data, "id=$id");
    }

    // DELETE a category
    public function deleteCategory($id)
    {
        // Check if the category exists
        $category = $this->getCategory($id);
        if (!$category) {
            return false; // Category doesn't exist
        }

        // Delete the category
        return dbDelete('categories', "id=$id");
    }
}
?>
