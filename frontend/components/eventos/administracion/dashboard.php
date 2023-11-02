<div class="row">
    <div class="col-2 nav flex-column nav-pills mt-5" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <?php require_once 'lateral.php'; ?>
    </div>
    <div class="col-10 tab-content mt-2" id="v-pills-tabContent">
        <?php
            require_once 'home-view.php';
            require_once 'cargar-egresados.php';
            require_once 'confirmar-egresados.php';
            require_once 'ajustes-asientos.php';
            require_once 'asientos-egresados.php';
        ?> 
    </div>
</div>  

<script type="text/javascript" src="<?php echo URL_ROUTE;?>/frontend/assets/js/eventos.js"></script>