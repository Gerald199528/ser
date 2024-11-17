
<div class="full-box page-header">
    <h3 class="text-center roboto-condensed-regular text-uppercase">
        <i class="fas fa-sync-alt fa-fw"></i> &nbsp; Actualizar datos de imagen
    </h3>
</div>

     

<div class="container-fluid">
                        <ul class="full-box list-unstyled page-nav-tabs">
        <li class="nav-item" role="presentation">
            <a    href="<?php echo SERVERURL.DASHBOARD; ?>/portada/" ><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR IMAGEN</a>
        </li>
        <li class="nav-item" role="presentation">
            <a   href="<?php echo SERVERURL.DASHBOARD; ?>/portadal-ist/" ><i class="fas fa-boxes fa-fw"></i> &nbsp;LISTA DE IMAGEN</a>
        </li>
     
       
    </ul>
</div>
<div class="container-fluid">
    <div class="dashboard-container">
        <?php
      
            
            $datos_portada=$Lc->datos_tabla("Unico","portada","image_id",$pagina[2]);
            if($datos_portada->rowCount()==1){
                $campos=$datos_portada->fetch();
        ?>
        <h4 class="font-weight-bold text-center poppins-regular tittle-details"><?php echo $campos['image_nombre']; ?></h4>
        <br>
        <form class="FormularioAjax" method="POST" data-form="update" autocomplete="off" action="<?php echo SERVERURL;?>ajax/portadaAjax.php" >
            <input type="hidden" name="modulo_portada" value="actualizar">
            <input type="hidden" name="image_id_up" value="<?php echo $pagina[2]; ?>">
            <fieldset class="mb-4">
              
                 
            </fieldset>
            <fieldset class="mb-4">
                <legend><i class="fas fa-box"></i> &nbsp; Información de la imagen</legend>
                <div class="container-fluid">
                    <div class="row">
                              <div class="col-12 col-md-6">
								<div class="form-group">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\- ]{1,97}" class="form-control" name="image_nombre_up" id="image_nombre" maxlength="97" value="<?php echo $campos['image_nombre']; ?>">
                            <label for="image_nombre" class="form-label">Nombre  Portada</label>
                        </div>
                    </div>
                    
                        <div class="col-12 col-md-6">
                            <div class="mb-4">
                                <label for="image_estado" class="form-label">Estado de producto</label>
                                <select class="form-control" name="image_estado_up" id="image_estado">
                                    <?php
                                        $array_estado=["Habilitada","Deshabilitada"];
                                        echo $Lc->generar_select($array_estado,$campos['image_estado']);
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
                                <textarea pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\s ]{4,520}" class="form-control" name="image_descripcion_up" id="image_descripcion" maxlength="520" rows="7"><?php echo $campos['image_descripcion']; ?></textarea>
                            
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