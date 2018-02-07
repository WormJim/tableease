<?php 

// Admin Auth

    function log_in_admin($admin) {
        
        session_regenerate_id();
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['last_login'] = time();
        $_SESSION['username'] = $admin['username'];
        
    }
    
    function log_out_admin() {
        unset($_SESSION['admin_id']);
        unset($_SESSION['last_login']);
        unset($_SESSION['username']);

        return true;
    }
// User Auth

    function log_in_user($user) {
        
        session_regenerate_id();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['last_login'] = time();
        $_SESSION['username'] = $user['username'];
        
    }
    
// Customer Auth

    function log_in_customer($customer) {
        
        session_regenerate_id();
        $_SESSION['customer_id'] = $customer['id'];
        $_SESSION['last_login'] = time();
        $_SESSION['username'] = $customer['username'];

    }

// Misc

    function is_logged_in() {
        return isset($_SESSION['admin_id']);
    }

    function require_login() {
        if(!admin_is_logged_in()) {
            redirect_to(url_for('/table_app/login.php'));
        } else {
            // Do nothing
        }
    }
?>