<div class="full-box page-header">
    <h3 class="text-center roboto-condensed-regular text-uppercase">
        <i class="fas fa-search fa-fw"></i> &nbsp; Buscar producto
    </h3>
</div>

<div class="container-fluid">
                        <ul class="full-box list-unstyled page-nav-tabs">
        <li class="nav-item" role="presentation">
            <a    href="<?php echo SERVERURL.DASHBOARD; ?>/product-new/" ><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR PRODUCTO</a>
        </li>
        <li class="nav-item" role="presentation">
            <a  href="<?php echo SERVERURL.DASHBOARD; ?>/product-list/" ><i class="fas fa-boxes fa-fw"></i> &nbsp;INVENTARIO DE PRODUCTOS</a>
        </li>
     
        <li class="nav-item" role="presentation">
            <a class="active"  href="<?php echo SERVERURL.DASHBOARD; ?>/product-search/" ><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR PRODUCTO</a>
        </li>
    </ul>
</div>
<div class="container-fluid">
    <?php
        if(!isset($_SESSION['busqueda_producto']) && empty($_SESSION['busqueda_producto'])){
    ?>
    <form class="dashboard-container mb-4 FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" data-form="default" data-lang="<?php echo LANG; ?>" method="POST" autocomplete="off" style="padding-top: 40px">
        <input type="hidden" name="modulo" value="producto">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6">
								<div class="form-group">
                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="busqueda_inicial" id="busqueda_inicial" maxlength="30">
                        <label for="busqueda_inicial" class="form-label">¿Qué producto estás buscando?</label>
                    </div>
                    <p class="text-center">
                        <button class="btn btn-raised btn-info"><i class="fas fa-search"></i> &nbsp; Buscar</button>
                    </p>
                </div>
            </div>
        </div>
    </form>
    <?php }else{ ?>
    <div class="dashboard-container mb-4">
        <form class="mb-4 FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" data-form="search" data-lang="<?php echo LANG; ?>" method="POST">
            <input type="hidden" name="modulo" value="producto">
            <input type="hidden" name="eliminar_busqueda" value="eliminar">
            <p class="lead text-center roboto-condensed-regular">Resultados de la búsqueda <span class="font-weight-bold">“<?php echo $_SESSION['busqueda_producto']; ?>”</span></p>
            <p class="text-center">
                <button type="submit" class="btn btn-raised btn-danger"><i class="far fa-trash-alt"></i> &nbsp; Eliminar búsqueda</button>
            </p>
        </form>

        <?php
            require_once "./controladores/productoControlador.php";
            $ins_producto = new productoControlador();

            echo $ins_producto->administrador_paginador_producto_controlador($pagina[2],15,$pagina[1],$_SESSION['busqueda_producto']);
        ?>
    </div>
    <?php } ?>
</div>