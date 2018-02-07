<?php require_once('../../../private/initialize.php');?>
<?php include(SHARED_PATH . '/bootstrap_header.php'); ?>


<?php 

    $id = $_GET['id'] ?? '1';
    // $menu_set = find_menu_by_restaurant_id($id); 
    $restaurant = find_restaurant_by_id($id);

?>


<div class="content">

    <div class="menu listing">
    
        <h1>Menu for <?php echo h($restaurant['restaurant']); ?></h1>

            <a class="back-link" href="<?php echo url_for('/customers/restaurants/index.php'); ?>">&laquo; Pcik a different Restaurants</a>

    </div>

</div>





<?php include(SHARED_PATH . '/bootstrap_footer.php'); ?>
