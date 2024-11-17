
<div class="full-box page-header">
    <h3 class="text-center roboto-condensed-regular text-uppercase">
        <i class="fas fa-plus fa-fw"></i> &nbsp; Agregar producto
    </h3>
</div>

<div class="container-fluid">
                        <ul class="full-box list-unstyled page-nav-tabs">
        <li class="nav-item" role="presentation">
            <a  class="active"  href="<?php echo SERVERURL.DASHBOARD; ?>/product-new/" ><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR PRODUCTO</a>
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
    <form class="dashboard-container FormularioAjax" method="POST" data-form="save"  autocomplete="off" action="<?php echo SERVERURL;?>ajax/productoAjax.php" enctype="multipart/form-data" >
        <input type="hidden" name="modulo_producto" value="registro">
        <fieldset class="mb-4">
            <legend><i class="fas fa-barcode"></i> &nbsp; Código del producto</legend>
           
                <div class="row">
                <div class="col-12 col-md-12">
								<div class="form-group">
                            <input type="text" pattern="[0-9.]{1,8}" class="form-control" name="producto_codigo_reg" id="producto_codigo" maxlength="8">
                            <label for="producto_codigo" class="form-label">Código del producto </label>
                        </div>
                    </div>
                  
        </fieldset>
        <fieldset class="mb-4">
            <legend><i class="fas fa-box"></i> &nbsp; Información del producto</legend>
            <div class="container-fluid">
                <div class="row">
                <div class="col-12 col-md-6">
								<div class="form-group">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\- ]{1,97}" class="form-control" name="producto_nombre_reg" id="producto_nombre" maxlength="97">
                            <label for="producto_nombre" class="form-label">Nombre del producto</label>
                        </div>
                    </div>
                  
                	<div class="col-12 col-md-6">
								<div class="form-group">
                            <input type="text" pattern="[0-9.]{1,25}" class="form-control" name="producto_precio_venta_reg"  value="0" id="producto_precio_venta" maxlength="25">
                            <label for="producto_precio_venta" class="form-label">Precio de venta  </label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
								<div class="form-group">
                            <input type="number" pattern="[0-9.]{1,25}" value="0" class="form-control"  name="producto_disponibilidad_reg" id="producto_disponibilidad" maxlength="10">
                            <label for="producto_disponibilidad" class="form-label">Nª productos disponibles </label>
                        </div>
                    </div>
                   
                    <div class="col-12 col-md-6">
								<div class="form-group">
                            <input type="text" pattern="[0-9]{1,2}" class="form-control" name="producto_descuento_reg" value="0" id="producto_descuento" maxlength="2">
                            <label for="producto_descuento" class="form-label">Descuento (opcional) </label>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
								<div class="form-group">                 
                            <select class="form-control" name="producto_marca_reg" id="producto_marca" >
                                <option value="" selected="" > Seleccione fabricante </option>
                                <?php
                                    echo $Lc->generar_select(MARCA,"");
                                ?>
                            </select>
                            <label for="producto_marca" class="form-label">Nombre del Fabricante</label>
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
                            <select class="form-control" name="producto_tipo_reg" id="producto_tipo">
                                <option value="" selected="" > Tipo de producto </option>
                                <option value="Fisico" >Fisico</option>
                            
                            </select>
                        </div>
                   
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-4">
                            <label for="producto_categoria" class="form-label">Categoría de producto</label>
                            <select class="form-control" name="producto_categoria_reg" id="producto_categoria">
                                <option value="" selected="" >Seleccione el tipo de Categoría </option>
                                <?php
                                    $datos_categoria=$Lc->datos_tabla("Normal","categoria WHERE categoria_estado='Habilitada'","categoria_id,categoria_nombre,categoria_estado",0);
                                    $cc=1;
                                    while($campos_categoria=$datos_categoria->fetch()){
                                        echo '<option value="'.$campos_categoria['categoria_id'].'">'.$cc.' - '.$campos_categoria['categoria_nombre'].'</option>';
                                        $cc++;
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="mb-4">
                            <label for="producto_estado" class="form-label">Estado de producto</label>
                            <select class="form-control" name="producto_estado_reg" id="producto_estado">
                                <option value="" selected="" > Estado de producto </option>
                                <option value="Habilitado" >Habilitado</option>
                                <option value="Deshabilitado" >Deshabilitado</option>
                            </select>
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
                    
                    <div class="form-group">
                            <textarea pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\s ]{4,520}" class="form-control" name="producto_descripcion_reg" id="producto_descripcion" maxlength="520" rows="7"></textarea>
                            <label for="producto_descripcion" class="form-label">Descripción</label>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset class="mb-4">          
            <legend><i class="far fa-file-image"></i> &nbsp; Foto o portada de producto</legend>
            <div class="container-fluid">
                       <div class="col-4">                    
                         <div class="form-group">
                        <label for="producto_portada" class="form-label">Tipos de archivos permitidos: JPG, JPEG, PNG. Tamaño máximo <?php echo COVER_PRODUCT; ?>MB. Resolución recomendada 500px X 500px o superior manteniendo el aspecto cuadrado (1:1)</label>
                        <input class="form-control " id="producto_portada" name="producto_portada" type="file" />
                    </div>
                </div>
            </div>
        </fieldset>
        <p class="text-center" style="margin-top: 40px;">
        <button type="reset" class="btn btn-raised btn-secondary "><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
        </p>
        <p class="text-center">
        
        </p>
    </form>
</div>