<?php require_once('../../../private/initialize.php'); ?>

<?php

$id = $_GET['id'] ?? '1';

$user_set = find_user_by_id($id);
$user = mysqli_fetch_assoc($user_set);

?>

<h1>Welcome <?php echo h(u($user['first_name'])); ?></h1>

<h2><?php echo $_SESSION['new_user_message']; ?></h2>


<?php mysqli_free_result($user_set); ?>