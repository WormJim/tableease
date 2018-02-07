<?php require_once('../../../../private/initialize.php');?>

<?php include(SHARED_PATH . '/bootstrap_header.php'); ?>

<?php $restaurant_set = find_all_restaurants(); ?>

<div id="content">

    <div class="restaurant show">

        <h1>Pick a restaurant</h1>

        <ul>

            <?php while ($restaurant = mysqli_fetch_assoc($restaurant_set)) { ?>
                <li>
                    <a href="<?php echo url_for('/table_app/user_portal/restaurants/menu.php?id=' . $restaurant['id']); ?>">
                    <?php echo h($restaurant['restaurant']); ?></a>
                </li>
            <?php } ?>

        </ul>

    </div>

</div>

<?php mysqli_free_result($restaurant_set); ?>

<?php include(SHARED_PATH . '/bootstrap_footer.php'); ?>
