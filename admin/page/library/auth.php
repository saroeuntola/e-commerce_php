<?php
session_start();
include('db.php');

class Auth
{
    private $db;

    public function __construct()
    {
        $this->db = dbConn(); 
    }

    // Register
    public function register($username, $email, $password,$sex, $role_id = 1) 
    {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password,
            'sex'=> $sex,
            'role_id' => $role_id 
        ];

        return dbInsert('users', $data); 
    }

    // Login
    public function login($username, $password, $remember = false)
    {
        // Get user 
        $result = dbSelect('users', 'id, username, password, role_id', "username='$username'");
        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role_id'] = $user['role_id'];

                if ($remember) {
                    $token = bin2hex(random_bytes(32));
                    $expiry = time() + (86400 * 30);  // 30 days expiry
                    dbInsert('user_tokens', [
                        'user_id' => $user['id'],
                        'token' => hash('sha256', $token),
                        'expires_at' => date('Y-m-d H:i:s', $expiry)
                    ]);
                    setcookie("remember_token", $token, $expiry, "/", "", true, true);
                }

                return true;
            }
        }

        return false;
    }

    // Check if user is logged in
    public function is_logged_in()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } elseif (isset($_COOKIE['remember_token'])) {
            $token = hash('sha256', $_COOKIE['remember_token']);
            $result = dbSelect('user_tokens', 'user_id', "token='$token' AND expires_at > NOW() LIMIT 1");
            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['user_id'] = $user['user_id'];

                // Retrieve the user's role from the database and store it in the session
                $userRoleResult = dbSelect('users', 'role_id', "id=" . $user['user_id']);
                if ($userRoleResult && mysqli_num_rows($userRoleResult) > 0) {
                    $userRole = mysqli_fetch_assoc($userRoleResult);
                    $_SESSION['role_id'] = $userRole['role_id'];
                }

                return true;
            }
        }

        return false;
    }

    // Logout 
    public function logout()
    {
        session_destroy();
        if (isset($_COOKIE['remember_token'])) {
            $token = hash('sha256', $_COOKIE['remember_token']);
            dbDelete('user_tokens', "token='$token'");
            setcookie("remember_token", "", time() - 3600, "/", "", true, true);
        }
    }

    // Check if the user has a specific role
    public function has_role($role_id)
    {
        return isset($_SESSION['role_id']) && $_SESSION['role_id'] == $role_id;
    }

    // Check if user has any of the roles
    public function has_any_role($role_ids = [])
    {
        return isset($_SESSION['role_id']) && in_array($_SESSION['role_id'], $role_ids);
    }
}
