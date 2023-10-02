<div class="row mt-1 mb-4 align-items-center">
    <div class="col-3 text-start">
        <h1 id="logo-title"><img style="width: 100px;" src="<?php echo URL_ROUTE ?>/frontend/assets/media/system/icons/logo.png" /></h1>
    </div>
    <div class="col-9 text-end">
        <ul>
            <li class="nav-item">
                <a href="">
                    <span id="username-nav"><?php echo $_SESSION['username']; ?></span>
                    <img src="<?php echo URL_ROUTE;?>/frontend/assets/media/system/images/default-user.png" width="40px" alt="">
                </a>
            </li> 
        </ul>
    </div>
</div>