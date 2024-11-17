


<div class="full-box page-header">
    <h3 class="text-center roboto-condensed-regular text-uppercase">
        <i class="fas fa-boxes fa-fw"></i> &nbsp; Informacion de la imagen
    </h3>
</div>

<div class="container-fluid">
                        <ul class="full-box list-unstyled page-nav-tabs">
        <li class="nav-item" role="presentation">
            <a   href="<?php echo SERVERURL.DASHBOARD; ?>/product-new/" ><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR PRODUCTO</a>
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
    <div class="full-box dashboard-container">
        <?php
  
            
            $datos_producto=$Lc->datos_tabla("Unico","producto","producto_id",$pagina[2]);
            if($datos_producto->rowCount()==1){
                $campos=$datos_producto->fetch();
        ?>
        <h3 class="text-center"><?php echo $campos['producto_nombre']; ?></h3>
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6">
                    <?php if(is_file("./Vista/assets/product/cover/".$campos['producto_portada'])){ ?>
                        <form class="FormularioAjax" data-lang="<?php echo LANG; ?>" action="<?php echo SERVERURL; ?>ajax/productoAjax.php" method="POST" data-form="delete" autocomplete="off" >
                            <input type="hidden" name="modulo_producto" value="portada_eliminar">
                            <input type="hidden" name="producto_id" value="<?php echo $pagina[2]; ?>">
                            <figure>
                                <img class="img-fluid img-product-info" src="<?php echo SERVERURL; ?>Vista/assets/product/cover/<?php echo $campos['producto_portada']; ?>" alt="<?php echo $campos['producto_nombre']; ?>">
                            </figure>
                            <p class="text-center" style="margin-top: 40px;">
                                <button type="submit" class="btn btn-raised btn-danger">
                                <i class="far fa-trash-alt"></i> &nbsp; ELIMINAR IMAGEN</button>
                            </p>
                        </form>
                    <?php }else{ ?>
                        <figure>
                            <img class="img-fluid img-product-info" src="<?php echo SERVERURL; ?>Vista/assets/product/cover/default.jpg" alt="<?php echo $campos['producto_nombre']; ?>">
                        </figure>
                    <?php } ?>
                </div>
                <div class="col-12 col-md-6">
                    
                    <form class="FormularioAjax dashboard-container" data-lang="<?php echo LANG; ?>" action="<?php echo SERVERURL; ?>ajax/productoAjax.php" method="POST" data-form="update" autocomplete="off"  >
                        <input type="hidden" name="producto_id" value="<?php echo $pagina[2]; ?>">
                        <input type="hidden" name="modulo_producto" value="portada_actualizar">
                        <fieldset>
                            <legend><i class="far fa-file-image"></i> &nbsp; Foto o portada de producto</legend>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                   	<div class="form-group">                                 
                                    <label for="producto_portada" class="form-label">Tipos de archivos permitidos: JPG, JPEG, PNG. Tamaño máximo <?php echo COVER_PRODUCT; ?>MB. Resolución recomendada 500px X 500px o superior manteniendo el aspecto cuadrado (1:1)</label>
                                           <input class="form-control" id="producto_portada" name="producto_portada" type="file" />
                                           </div> 
                                           </div>
                                                                                                                   
                                           <p class="text-center" style="margin-top: 40px;">     
                                                   <button type="reset" class="btn btn-raised btn-secondary "><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>                                   
                                            <button type="submit" class="btn btn-raised btn-success"><i class="fas fa-sync"></i> &nbsp; ACTUALIZAR IMAGEN</button>
                                        </p>                              
                           
                        </fieldset>
                    </form>
               
                    </div>
        <?php
            }else{ include "./Vista/inc/".LANG."/error_alert.php";}
        ?>
   } 
</div>
