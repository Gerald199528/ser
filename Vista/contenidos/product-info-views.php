<div class="full-box page-header">
    <h3 class="text-center roboto-condensed-regular text-uppercase">
        <i class="fas fa-info-circle fa-fw"></i> &nbsp; Información de producto
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
    <div class="dashboard-container" >
        <?php

            
            $datos_producto=$Lc->datos_tabla("Unico","producto","producto_id",$pagina[2]);
            if($datos_producto->rowCount()==1){
                $campos=$datos_producto->fetch();
                $total_price=$campos['producto_precio_venta']-($campos['producto_precio_venta']*($campos['producto_descuento']/100));
        ?>
        <h4 class="font-weight-bold text-center poppins-regular tittle-details"><?php echo $campos['producto_nombre']; ?></h4>
        <br>
        <fieldset class="mb-4">
            <legend><i class="fas fa-barcode"></i> &nbsp; Código del producto</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-outline mb-4">
                            <input type="text" class="form-control" value="<?php echo $campos['producto_codigo']; ?>" id="producto_codigo"   readonly>
                            <label for="producto_codigo" class="form-label">Código de barras</label>
                        </div>
                    </div>
                   
                </div>
            </div>
        </fieldset>
        <fieldset class="mb-4">
            <legend><i class="fas fa-box"></i> &nbsp; Información del producto</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="form-outline mb-4">
                            <input type="text" class="form-control" value="<?php echo $campos['producto_nombre']; ?>"  id="producto_nombre" readonly >
                            <label for="producto_nombre" class="form-label">Nombre</label>
                        </div>
                    </div>
                   
                    <div class="col-12 col-md-6">
                        <div class="form-outline mb-4">
                            <input type="text" class="form-control" value="<?php echo $campos['producto_precio_venta']; ?>" id="producto_precio_venta" readonly >
                            <label for="producto_precio_venta" class="form-label">Precio de venta </label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-outline mb-4">
                            <input type="text" class="form-control" value="<?php echo $total_price; ?>" id="producto_precio_venta_final"  readonly>
                            <label for="producto_precio_venta_final" class="form-label">Precio de venta final (Con descuento incluido)</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-outline mb-4">
                            <input type="text" class="form-control" value="<?php echo $campos['producto_disponibilidad']; ?>" id="producto_disponibilidad" readonly  >
                            <label for="producto_disponibilidad" class="form-label">Disponibilidad</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="form-outline mb-4">
                            <input type="text" class="form-control" value="<?php echo $campos['producto_descuento']; ?>" id="producto_descuento" readonly >
                            <label for="producto_descuento" class="form-label">Descuento</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="form-outline mb-4">
                            <input type="text" class="form-control" value="<?php echo $campos['producto_marca']; ?>" id="producto_marca" readonly >
                            <label for="producto_marca" class="form-label">Fabricante</label>
                        </div>
                    </div>
                 
                </div>
            </div>
        </fieldset>
        <fieldset class="mb-4">
            <legend><i class="fas fa-parachute-box"></i> &nbsp; Tipo, Presentación, Categoría & Estado</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-outline mb-4">
                            <input type="text" class="form-control" value="<?php echo $campos['producto_tipo']; ?>" id="producto_tipo" readonly >
                            <label for="producto_tipo" class="form-label">Tipo de producto</label>
                        </div>
                    </div>
                
                    <div class="col-12 col-md-6">
                        <div class="form-outline mb-4">
                            <?php
                                $nombre_categoria=$Lc->datos_tabla("Unico","categoria","categoria_id",$Lc->encryption($campos['categoria_id']));
                                $nombre_categoria=$nombre_categoria->fetch();
                            ?>
                            <input type="text" class="form-control" value="<?php echo $nombre_categoria['categoria_nombre']; ?>" id="producto_categoria" readonly >
                            <label for="producto_categoria" class="form-label">Categoría de producto</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="form-outline mb-4">
                            <input type="text" class="form-control" value="<?php echo $campos['producto_estado']; ?>" id="producto_estado" readonly >
                            <label for="producto_estado" class="form-label">Estado de producto</label>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset class="mb-4">
            <legend><i class="far fa-comment-dots"></i> &nbsp; Descripción</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="form-outline mb-4">
                            <textarea class="form-control" id="producto_descripcion" rows="7" readonly ><?php echo $campos['producto_descripcion']; ?></textarea>
                           
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <?php
            }else{ include "./vistas/inc/".LANG."/error_alert.php";}
        ?>
    </div>
</div>