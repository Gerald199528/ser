<div class="full-box page-header">
    <h3 class="text-center roboto-condensed-regular text-uppercase">
        <i class="fas fa-boxes fa-fw"></i> &nbsp; Inventario de productos
    </h3>
</div>

<div class="container-fluid">
                        <ul class="full-box list-unstyled page-nav-tabs">
        <li class="nav-item" role="presentation">
            <a   href="<?php echo SERVERURL.DASHBOARD; ?>/product-new/" ><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR PRODUCTO</a>
        </li>
        <li class="nav-item" role="presentation">
            <a   class="active" href="<?php echo SERVERURL.DASHBOARD; ?>/product-list/" ><i class="fas fa-boxes fa-fw"></i> &nbsp;INVENTARIO DE PRODUCTOS</a>
        </li>
     
        <li class="nav-item" role="presentation">
            <a  href="<?php echo SERVERURL.DASHBOARD; ?>/product-search/" ><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR PRODUCTO</a>
        </li>
    </ul>
</div>
<div class="container-fluid">
    <div class="full-box dashboard-container">
        <?php
            require_once "./Controladores/productoControlador.php";
            $Lc = new productoControlador();

            echo $Lc->administrador_paginador_producto_controlador($pagina[2],4,$pagina[1],"");
        ?>
    </div>
</div>