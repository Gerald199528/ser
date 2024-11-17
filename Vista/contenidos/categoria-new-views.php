
    <div class="full-box page-header">
        <h3 class="text-center roboto-condensed-regular text-uppercase">
            <i class="fas fa-plus fa-fw"></i> &nbsp; Nueva categoría
        </h3>
    </div>

    <div class="container-fluid">
                        <ul class="full-box list-unstyled page-nav-tabs">
                            <li>
                                <a class="active"  href="<?php echo SERVERURL.DASHBOARD;  ?>/categoria-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVA CATEGORIA </a>
                            </li>
                            <li>
                                <a  href="<?php echo SERVERURL.DASHBOARD; ?>/categoria-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CATEGORIA </a>
                            </li>
                            <li>
                                <a  href="<?php echo SERVERURL.DASHBOARD;  ?>/categoria-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR CATEGORIA </a>
                            </li>
                        </ul>	
                    </div>


    <div class="container-fluid">
    <form  class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/categoriaAjax.php"  method="POST" data-form="save" autocomplete="off" >

            <fieldset class="mb-4">
                <legend><i class="fas fa-tag fa-fw"></i> &nbsp; Información de categoría</legend>
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-12 col-md-6">
                                            <div class="form-group">
                                <select class="form-control" name="categoria_nombre_reg" id="categoria_nombre">
                                <option value="" selected="" >Seleccione una categoria</option>
                                <?php
                                        echo $Lc->generar_select(PRODUTS_UNITS,"");
                                    ?>
                                
                                </select>
                                <label for="categoria_nombre" class="form-label"></label>
                            </div>
                        </div>
                
                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                <select class="form-control" name="categoria_estado_reg" id="categoria_estado">
                                <option value="" selected="" >Seleccione Estado</option>
                                    <option value="Habilitada" >Habilitada</option>
                                    <option value="Deshabilitada" >Deshabilitada</option>
                                </select>
                                <label for="categoria_estado" class="form-label"></label>
                            </div>
                        </div>
                        <div class="col-12">
                    
                                            <div class="form-group">
                                <textarea pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\s ]{4,700}" class="form-control" name="categoria_descripcion_reg" id="categoria_descripcion" maxlength="700" rows="7"></textarea>
                                <label for="categoria_descripcion" class="form-label">Descripción</label>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <p class="text-center" style="margin-top: 40px;">
            <button type="reset" class="btn btn-raised btn-secondary "><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
            </p>
        
        </form>
    </div>