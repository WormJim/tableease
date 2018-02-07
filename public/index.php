<?php 
    require_once('../private/initialize.php'); 
    
    if(is_post_request()) {

        $contact = [];
        $contact['firstName'] = $_POST['firstName'] ?? '';
        $contact['lastName'] = $_POST['lastName'] ?? '';
        $contact['email'] = $_POST['email'] ?? '';

        $result = insert_contact($contact);
        if ($result === true) {
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('index.php'));
        } else {
        $errors = $result;
        }
        
    } else {

        $contact = [];
        $contact['firstName'] = '';
        $contact['lastName'] = '';
        $contact['email'] = '';

    }

?>

<?php include(SHARED_PATH . '/bootstrap_header.php'); ?>

        <div class="container-fluid">
            <div class="jumbotron jumbotron-fluid">
                    <h1 class="mx-auto text-center">Table Ease Coming Soon! Yep</h1>
            </div>
        
            <?php echo display_errors($errors); ?>

            <form action="<?php echo url_for('index.php'); ?>" method="post">
                <div class="row">
                    <div class=col-sm-3></div>
                    <div class="col-sm">
                        <dl>
                            <dd><input type="text" class="form-control" placeholder="First Name" name="firstName" value="<?php echo h($contact['firstName']); ?>"></dd>
                        </dl>
                    </div>
                    <div class="col-sm">
                        <dl>
                            <dd><input type="text" class="form-control" placeholder="Last Name"name="lastName" value="<?php echo h($contact['lastName']); ?>"></dd>
                        </dl>
                    </div>
                    <div class="col-sm">
                        <dl>
                            <dd><input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo h($contact['email']); ?>"></dd>
                        </dl>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <div class="row">
                        <dl class="mx-auto">
                            <dt>Let Us contact you when we are up and running.</dt>
                </div>
                <div class="row">
                    <input class="btn btn-secondary mx-auto" type="submit" value="Stay in the loop!" />
                </div>
                        </dl>
            </form>
        </div>

<?php include(SHARED_PATH . '/bootstrap_footer.php'); ?>