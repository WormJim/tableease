<?php require_once('../../../../private/initialize.php');?>
<?php include(SHARED_PATH . '/bootstrap_header.php'); ?>


<?php 

    if(!isset($SESSION['allergies'])) { $_SESSION['allergies'] = []; }    

    $id = $_GET['id'] ?? '1';
    $restaurant = find_restaurant_by_id($id);
    $menu_set = find_menu_by_restaurant_id($id);

?>

<div class="contaier">

    <h1><?php echo h($restaurant['restaurant']); ?></h1>

    <a class="back-link" href="<?php echo url_for('/users/restaurants/index.php'); ?>">&laquo; Pick a different Restaurants</a>

</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-4">
        <h5>
            Select allergies
        </h5>
        <div>
            <form action="" id="allergies">

                <input type="checkbox" name="gluten">
                <label for="gluten">Gluten</label>
                <br />
                <label for="wheat">Wheat</label>
                <input type="checkbox" name="wheat">
                <br />

                <label for="MSG">MSG</label>
                <input type="checkbox" name="msg">
                <br />
                
                <label for="Sugar">Sugar</label>
                <input type="checkbox" name="sugar">
                <br />
               
                <label for="fish">Fish</label>
                <input type="checkbox" name="fish">

            </form>
        </div>
        
        <!-- End of Col 4 below -->
        </div>
        <div class="col-8">

            <table class="table table-striped table-sm">

                <!-- <tr>
                    <th scope="col" >Item</th>
                    <th scope="col" >Sub Item</th>
                    <th scope="col" >Description</th>
                    <th scope="col" >Course</th>
                </tr> -->

                <?php while($menu = mysqli_fetch_assoc($menu_set)) { ?>
                    <tr>
                        <td><?php echo h($menu['menu_item']); ?></td>
                        <td><?php echo h($menu['sub_item']); ?></td>
                        <td><?php echo h($menu['description']); ?></td>
                        <?php $course = find_course_by_id($menu['courses_id']); ?>
                        <td><?php echo h($course['course']); ?></td>
                    </tr>
                <?php } ?>
            </table>
        <!-- End of Col 8 below -->
        </div> 
    </div>
    
<script>
    function allergies() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'menu.php', true);
        xhr.setRequestHeader('X-Requested-With', 'XMHHttpRequest');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var result = xhr.responseText;
                console.log('Result: ' + result);
            }
        }
    }

    var checkbox = document.getElementById("allergies");
    for (i = 0; i < checkbox.length; i++) {
        checkbox.item(i).addEventListener("checked", allergies);
    }
</script>


</div>
            <?php mysqli_free_result($menu_set); ?>

<?php include(SHARED_PATH . '/bootstrap_footer.php'); ?>
