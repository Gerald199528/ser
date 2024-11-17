
<div class="full-box page-header">
    <h3 class="text-center roboto-condensed-regular text-uppercase">
        <i class="fas fa-plus fa-fw"></i> &nbsp; Agregar Imagen de portada
    </h3>
</div>

<div class="container-fluid">
                        <ul class="full-box list-unstyled page-nav-tabs">
        <li class="nav-item" role="presentation">
            <a  class="active"  href="<?php echo SERVERURL.DASHBOARD; ?>/product-new/" ><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR IMAGEN</a>
        </li>
        <li class="nav-item" role="presentation">
            <a  href="<?php echo SERVERURL.DASHBOARD; ?>/portadal-ist/" ><i class="fas fa-boxes fa-fw"></i> &nbsp;LISTA DE IMAGEN</a>
        </li>
     
       
    </ul>
</div>
<div class="container-fluid">
    <form class="dashboard-container FormularioAjax" method="POST" data-form="save"  autocomplete="off" action="<?php echo SERVERURL;?>ajax/portadaAjax.php" enctype="multipart/form-data" >
        <input type="hidden" name="modulo_portada" value="registro">
        <fieldset class="mb-4">
                         
        </fieldset>
        <fieldset class="mb-4">
            <legend><i class="fas fa-box"></i> &nbsp; Información de portada</legend>
            <div class="container-fluid">
                <div class="row">
                <div class="col-12 col-md-12">
								<div class="form-group">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\- ]{1,97}" class="form-control" name="image_nombre_reg" id="image_nombre" maxlength="97">
                            <label for="image_nombre" class="form-label">Nombre Portada</label>
                        </div>
                    </div>
                  
                	
        <fieldset class="mb-4">
            
            <legend><i class="far fa-comment-dots"></i> &nbsp; Descripción</legend>
            <div class="container-fluid">
                <div class="row">
                <div class="col-12">
                    
                    <div class="form-group">
                            <textarea pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\s ]{4,520}" class="form-control" name="image_descripcion_reg" id="image_descripcion" maxlength="520" rows="7"></textarea>
                            <label for="image_descripcion" class="form-label">Descripción</label>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset class="mb-4">          
            <legend><i class="far fa-file-image"></i> &nbsp; Foto o portada </legend>
            <div class="container-fluid">
                       <div class="col-4">                    
                         <div class="form-group">
                        <label for="image_portada" class="form-label">Tipos de archivos permitidos: JPG, JPEG, PNG. Tamaño máximo <?php echo COVER_PRODUCT; ?>MB. Resolución recomendada 500px X 500px o superior manteniendo el aspecto cuadrado (1:1)</label>
                        <input class="form-control " id="image_portada" name="image_portada" type="file" />
                    </div>
                </div>
            </div>
        </fieldset>
        <p class="text-center" style="margin-top: 40px;">
        <button type="reset" class="btn btn-raised btn-secondary "><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
            <button type="submit"  class="btn btn-primary"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
        </p>
        <p class="text-center">
        
        </p>
    </form>
</div>