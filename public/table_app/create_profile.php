<?php require_once('../../private/initialize.php'); ?>

<?php 

    $errors = [];
    
    if(is_post_request()) {

        $user = [];
        $user['first_name'] = $_POST['first_name'];
        $user['last_name'] = $_POST['last_name'];
        $user['email'] = $_POST['email'];
        $user['username'] = $_POST['username'];
        $user['password'] = $_POST['password'] ?? '';
        $user['confirm_password'] = $_POST['confirm_password'] ?? '';
        
        $new_user = create_new_user($user);
        if($new_user === true) {
            $new_id = mysqli_insert_id($db);
            $_SESSION['new_user_message'] = 'Thank you for signing up.';
            redirect_to(url_for('/table_app/user_portal/welcome.php?id=' . $new_id));
        } else {
            $errors = $new_user;
        }
        
    } else {
        
        $user = [];
        $user['first_name'] = '';
        $user['last_name'] = '';
        $user['email'] = '';
        $user['username'] = '';
        $user['password'] = '';
        $user['confirm_password'] = '';
    }

?>

<?php include(SHARED_PATH . '/bootstrap_header.php'); ?>

<div class="container">
    <form action="<?php echo url_for('/table_app/create_profile.php')?>" method="post">

        <dl>
            <dt>First Name</dt>
            <dd>
                <input type="text" name="first_name" id="" value="<?php echo h($user['first_name']); ?>" />
            </dd>
        </dl>
        <dl>
            <dt>Last Name</dt>
            <dd>
                <input type="text" name="last_name" id="" value="<?php echo h($user['last_name']); ?>" />
            </dd>
        </dl>
        <dl>
            <dt>Email</dt>
            <dd>
                <input type="email" name="email" id="" value="<?php echo h($user['email']); ?>" />
            </dd>
        </dl>
        <dl>
            <dt>Username</dt>
            <dd>
                <input type="text" name="username" id="" value="<?php echo h($user['username']); ?>" />
            </dd>
        </dl>
        <dl>
            <dt>Password</dt>
            <dd>
                <input type="password" name="password" id="">
            </dd>
        </dl>
        <dl>
            <dt>Confrim Password</dt>
            <dd>
                <input type="password" name="confirm_password" id="">
            </dd>
        </dl>
        <dl>
            <dt></dt>
            <dd>
                <input type="submit" value="submit" />
            </dd>
        </dl>

    </form>
</div>

<?php include(SHARED_PATH . '/bootstrap_footer.php'); ?>