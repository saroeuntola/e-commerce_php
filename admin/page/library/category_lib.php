<?php
class Category
{
    public $db;

    public function __construct()
    {
        $this->db = dbConn(); 
    }

    // CREATE a new category
    public function createCategory($name)
    {
        $quotedName = $this->db->quote($name);
        $result = dbSelect('categories', 'id', "name=$quotedName");

        if ($result && count($result) > 0) {
            return false; 
        }

        $data = ['name' => $name];
        return dbInsert('categories', $data);
    }

    // READ all categories
    public function getCategories()
    {
        return dbSelect('categories', '*');
    }

    // READ a specific category by ID
    public function getCategory($id)
    {
        $quotedId = $this->db->quote($id);
        $result = dbSelect('categories', '*', "id=$quotedId");

        return ($result && count($result) > 0) ? $result[0] : null;
    }

    // UPDATE a category
    public function updateCategory($id, $newName)
    {
        $category = $this->getCategory($id);
        if (!$category) {
            return false; // Category doesn't exist
        }

        $data = ['name' => $newName];
        return dbUpdate('categories', $data, "id=" . $this->db->quote($id));
    }

    // DELETE a category
    public function deleteCategory($id)
    {
        $category = $this->getCategory($id);
        if (!$category) {
            return false; // Category doesn't exist
        }

        return dbDelete('categories', "id=" . $this->db->quote($id));
    }
}
?>
