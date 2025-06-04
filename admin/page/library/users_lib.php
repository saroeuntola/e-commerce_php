<?php
class User
{
    public $db;

    public function __construct()
    {
        $this->db = dbConn();
    }

     public function getusers() {
        $query = "SELECT u.*, r.name AS name 
                  FROM users u
                  JOIN roles r ON u.role_id = r.id 
                  ORDER BY u.created_at DESC";

        try {
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching products: " . $e->getMessage());
        }
    }
    // CREATE a new user
    public function createUser($data)
    {
        // Check for duplicate email
        $quotedEmail = $this->db->quote($data['email']);
        $existing = dbSelect('users', 'id', "email=$quotedEmail");

        if ($existing && count($existing) > 0) {
            return false; // Email already exists
        }

        // Hash password before insert
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        return dbInsert('users', $data);
    }

   public function getRoles()
    {
        return dbSelect('roles', '*');
    }
    public function getUser($id)
    {
        $quotedId = $this->db->quote($id);
        $result = dbSelect('users', '*', "id=$quotedId");
        return ($result && count($result) > 0) ? $result[0] : null;
    }
 public function updateProfile($userId, $data) {
        // Assuming you have a database connection in your `db.php`
        global $db;

        $query = "UPDATE users SET username = ?, sex = ?, profile = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("sssi", $data['username'], $data['sex'], $data['profile'], $userId);

        return $stmt->execute(); // Returns true if update is successful
    }
    // UPDATE a user (password optional)
    public function updateUser($id, $data)
    {
        $user = $this->getUser($id);
        if (!$user) {
            return false; // User not found
        }

        // If password is set, hash it
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']); // Don't update password if not provided
        }

        return dbUpdate('users', $data, "id=" . $this->db->quote($id));
    }
    public function getUserByID($id)
{
    if ($id === null) {
        return null;
    }

    $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    // DELETE a user
    public function deleteUser($id)
    {
        $user = $this->getUser($id);
        if (!$user) {
            return false;
        }

        return dbDelete('users', "id=" . $this->db->quote($id));
    }
}
?>
