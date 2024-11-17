
<div class="full-box page-header">
    <h3 class="text-center roboto-condensed-regular text-uppercase">
        <i class="fas fa-sync-alt fa-fw"></i> &nbsp; Actualizar disponibilidad del producto
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
            <a  href="<?php echo SERVERURL.DASHBOARD; ?>/product-search/" ><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR PRODUCTO</a>
        </li>
    </ul>
</div>

<div class="container-fluid">
    <div class="dashboard-container">
        <?php
      
            
            $datos_producto=$Lc->datos_tabla("Unico","producto","producto_id",$pagina[2]);
            if($datos_producto->rowCount()==1){
                $campos=$datos_producto->fetch();
        ?>
      
        <form class="FormularioAjax" method="POST" data-form="update" autocomplete="off" action="<?php echo SERVERURL;?>ajax/productoAjax.php" >
            <input type="hidden" name="modulo_producto" value="actualizar_disponibilidad">
            <input type="hidden" name="producto_disponibilidad_id_up" value="<?php echo $pagina[2]; ?>">
            <fieldset class="mb-4">
                
                    <div class="col-12 col-md-12">
								<div class="form-group">
                            <input type="number" pattern="[0-9.]{1,25}"  class="form-control"  name="producto_disponibilidad_up" id="producto_disponibilidad" maxlength="10" value="<?php echo $campos['producto_disponibilidad']; ?>">
                            <label for="producto_disponibilidad" class="form-label">Nª productos disponibles </label>
                        </div>
                    </div>
                   
                  
            <p class="text-center" style="margin-top: 40px;">
                <button type="submit" class="btn btn-raised btn-success"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
            </p>
           
        </form>
        <?php
            }
        ?>
    </div>
</div>