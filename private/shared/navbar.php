<nav class="navbar navbar-inverse bg-inverse ">

    <div class="d-flex justify-content-between">

        <div class="">
        
            <a class="navbar-brand" href="<?php echo url_for('/index.php') ?>">
                <img src="<?php echo url_for('/assets/images/logo.png'); ?>" width="80.24" height="34" alt="Table Ease" />
            </a>
        
        </div>

        <div class="">
        
            <!-- <form class="form-inline" action="<?php // echo url_for('/public/signin.php'); ?>">
                <button type="submit" class="btn btn-outline-secondary my-sm-0">Sign Up</button>
            </form> -->

            <form class="form-inline" action="<?php echo url_for('/public/signin.php'); ?>">
                <button type="submit" class="btn btn-outline-secondary my-2 my-sm-0">Sign In</button>
            </form>
            
        </div>

    </div>

</nav>