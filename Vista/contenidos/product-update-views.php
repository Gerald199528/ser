
<div class="full-box page-header">
    <h3 class="text-center roboto-condensed-regular text-uppercase">
        <i class="fas fa-sync-alt fa-fw"></i> &nbsp; Actualizar producto
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
        <h4 class="font-weight-bold text-center poppins-regular tittle-details"><?php echo $campos['producto_nombre']; ?></h4>
        <br>
        <form class="FormularioAjax" method="POST" data-form="update" autocomplete="off" action="<?php echo SERVERURL;?>ajax/productoAjax.php" >
            <input type="hidden" name="modulo_producto" value="actualizar">
            <input type="hidden" name="producto_id_up" value="<?php echo $pagina[2]; ?>">
            <fieldset class="mb-4">
                <legend><i class="fas fa-barcode"></i> &nbsp; Código de producto</legend>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-12">
                                 <div class="form-group">
                                <input type="text" pattern="[0-9.]{1,8}"  class="form-control" name="producto_codigo_up" value="<?php echo $campos['producto_codigo']; ?>" id="producto_codigo" maxlength="8">
                                <label for="producto_codigo" class="form-label">Código de barras </label>
                            </div>
                        </div>
                 
            </fieldset>
            <fieldset class="mb-4">
                <legend><i class="fas fa-box"></i> &nbsp; Información del producto</legend>
                <div class="container-fluid">
                    <div class="row">
                              <div class="col-12 col-md-6">
								<div class="form-group">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\- ]{1,97}" class="form-control" name="producto_nombre_up" id="producto_nombre" maxlength="97" value="<?php echo $campos['producto_nombre']; ?>">
                            <label for="producto_nombre" class="form-label">Nombre del producto</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
								<div class="form-group">
                            <input type="text" pattern="[0-9.]{1,25}" class="form-control" name="producto_precio_venta_up"  id="producto_precio_venta" maxlength="25" value="<?php echo $campos['producto_precio_venta']; ?>">
                            <label for="producto_precio_venta" class="form-label">Precio de venta  </label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
								<div class="form-group">
                            <input type="number" pattern="[0-9.]{1,25}"  class="form-control"  name="producto_disponibilidad_up" id="producto_disponibilidad" maxlength="10" value="<?php echo $campos['producto_disponibilidad']; ?>">
                            <label for="producto_disponibilidad" class="form-label">Nª productos disponibles </label>
                        </div>
                    </div>
                   
                    <div class="col-12 col-md-6">
								<div class="form-group">
                            <input type="text" pattern="[0-9]{1,2}" class="form-control" name="producto_descuento_up" id="producto_descuento" maxlength="2" value="<?php echo $campos['producto_descuento']; ?>">
                            <label for="producto_descuento" class="form-label">Descuento (opcional) </label>
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
                            <div class="mb-4">
                                <label for="producto_tipo" class="form-label">Tipo de producto</label>
                                <select class="form-control" name="producto_tipo_up" id="producto_tipo">
                                    <?php
                                        $array_tipo=["Fisico"];
                                        echo $Lc->generar_select($array_tipo,$campos['producto_tipo']);
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <div class="mb-4">
                                <label for="producto_categoria" class="form-label">Categoría de producto</label>
                                <select class="form-control" name="producto_categoria_up" id="producto_categoria">
                                    <?php
                                        $datos_categoria=$Lc->datos_tabla("Normal","categoria WHERE categoria_estado='Habilitada'","categoria_id,categoria_nombre,categoria_estado",0);
                                        $cc=1;
                                        $txt_selected='';
                                        $txt_current='';
                                        while($campos_categoria=$datos_categoria->fetch()){

                                            if($campos['categoria_id']==$campos_categoria['categoria_id']){
                                                $txt_selected='selected=""';
                                                $txt_current=' (Actual)'; 
                                            }

                                            echo '<option value="'.$campos_categoria['categoria_id'].'" '.$txt_selected.' >'.$cc.' - '.$campos_categoria['categoria_nombre'].$txt_current.'</option>';

                                            $txt_selected='';
                                            $txt_current='';
                                            $cc++;
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="mb-4">
                                <label for="producto_estado" class="form-label">Estado de producto</label>
                                <select class="form-control" name="producto_estado_up" id="producto_estado">
                                    <?php
                                        $array_estado=["Habilitado","Deshabilitado"];
                                        echo $Lc->generar_select($array_estado,$campos['producto_estado']);
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="mb-4">
            <div class="form-group">
                <legend><i class="far fa-comment-dots"></i> &nbsp; Descripción</legend>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-outline mb-4">
                                <textarea pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\s ]{4,520}" class="form-control" name="producto_descripcion_up" id="producto_descripcion" maxlength="520" rows="7"><?php echo $campos['producto_descripcion']; ?></textarea>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <p class="text-center" style="margin-top: 40px;">
                <button type="submit" class="btn btn-raised btn-success"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
            </p>
           
        </form>
        <?php
            }else{ include "./Vista/inc/".LANG."/error_alert.php";}
        ?>
    </div>
</div>