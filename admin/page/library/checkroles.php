<?php

include("auth.php");
function protectPathAccess() {
    $auth = new Auth();
    
    if ($auth->is_logged_in()) {
        if ($_SESSION['role_id'] != 1) {
            header('Location: /ministore/admin/page/include/no_access.php');
            exit;
        }
    } else {
        header('Location: /ministore/include/login.php');
        exit;
    }
}
?>