<?php
    require_once('../../private/initialize.php');

    $errors = [];
    $username = '';
    $password = '';

    if(is_post_request()) {

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $_SESSION['username'] = $username;

        // Validations/errors
        if(is_blank($username)) {
            $errors[] = "Username cannot be blank";
        }
        
        if(is_blank($password)) {
            $errors[] = "Password cannot be blank";
        }

        // If no errors, try to login
        if(empty($errors)) {
            
            // Ensuring login failure message is the same
            $login_failure_msg = "Login attempt failed. Username or password does not match.";

            // Fetch record of username and set assoc to $admin
            $admin = find_admin_by_username($username);

            // If record found
            if($admin) {
            

                // Verify password match 
                if(password_verify($password, $admin['hashed_password'])) {

                    //password matches
                    log_in_admin($admin);
                    redirect_to(url_for('/index.php'));

                } else {

                    // username found, but password does not match
                    $errors[] = $login_failure_msg;
                    
                }
                
            } else {
                
                // no username found
                $errors[] = $login_failure_msg;
                
            }
        }
    
    }

?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <h1>Log in</h1>

    <?php echo display_errors($errors); ?>

    <form action="login.php" method="post">

        Username:<br />

        <input type="text" name="username" value="<?php echo h($username); ?>" /><br />

        Password:<br />

        <input type="password" name="password" value="" /><br />

        <input type="submit" name="submit" value="Submit"  />

    </form>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>