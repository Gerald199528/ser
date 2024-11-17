
<?php 
	if($Lc->encryption( $_SESSION['id_Ser'])!=$pagina[1]){
		if( $_SESSION['privilegio_Ser']!=1){
			echo $Lc->forzar_cierre_sesion_controlador();
			exit();		
		}	
	}	
	
	?>			
	


<div class="full-box page-header">
    <h3 class="text-center roboto-condensed-regular text-uppercase">
        <i class="fas fa-sync-alt fa-fw"></i> &nbsp; Actualizar categoría
    </h3>
</div>


<div class="container-fluid">
					<ul class="full-box list-unstyled page-nav-tabs">
						<li>
							<a   href="<?php echo SERVERURL.DASHBOARD; ?>/categoria-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVA CATEGORIA </a>
						</li>
						<li>
							<a  href="<?php echo SERVERURL.DASHBOARD; ?>/categoria-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CATEGORIA </a>
						</li>
						<li>
							<a  href="<?php echo SERVERURL.DASHBOARD; ?>/categoria-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR CATEGORIA </a>
						</li>
					</ul>	
				</div>


<div class="container-fluid">
<?php
				require_once "./Controladores/categoriacontrolador.php";
				$ins_categoria = new categoriaControlador();

				$datos_categoria=$ins_categoria->datos_categoria_controlador("Unico",$pagina[2]);

					if($datos_categoria->rowCount()==1){
						$campos=$datos_categoria->fetch();			


				?>	
	<form  class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/categoriaAjax.php"  method="POST" data-form="update" autocomplete="off" >
				<input type="hidden" name="categoria_id_up"  value="<?php echo $pagina[2]; ?>">
				<fieldset class="mb-4">
            <legend><i class="fas fa-tag fa-fw"></i> &nbsp; Información de categoría</legend>
			
            <div class="container-fluid">
                <div class="row">
                <div class="col-12 col-md-6">
					
										<div class="form-group">
										</span>Categoria Actual
										<select class="form-control" name="categoria_nombre_up">
										
												<option value="Pasteleria" 
											<?php if($campos['categoria_nombre']=="Pasteleria"){
												echo 'selected=""';  } ?> >Pasteleria</option>

											<option value="Confiteria" 
											<?php if($campos['categoria_nombre']=="Confiteria"){

												echo 'selected=""';  } ?> >Confiteria</option>
												<option value="Heladeria" 
											<?php if($campos['categoria_nombre']=="Heladeria"){
												echo 'selected=""';  } ?> >Heladeria</option>


										</select>
									   </div>
                 
									 </div>           
                        
                    <div class="col-12 col-md-6">
					<div class="form-group">
											<span>Estado de la categoria  &nbsp; 
												<?php if($campos['categoria_estado']=="Habilitada"){

												echo '<span class="badge badge-info">Habilitada</span>';
											}
												else{
													echo '<span class="badge badge-danger">Deshabilitada</span>';
													
												} ?></span>
											<select class="form-control" name="categoria_estado_up">
											
													<option value="Habilitada" 
												<?php if($campos['categoria_estado']=="Habilitada"){
													echo 'selected=""';  } ?> >Habilitado</option>

												<option value="Deshabilitada" 
												<?php if($campos['categoria_estado']=="Deshabilitada"){
													echo 'selected=""';  } ?> >Deshabilitada</option>


											</select>
                                           </div>
										   </div>
							
					
                    <div class="col-12 col-md-12">
										<div class="form-group">
                            <textarea pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\s ]{4,700}" class="form-control" name="categoria_descripcion_up" id="categoria_descripcion" maxlength="700" rows="7"><?php echo $campos['categoria_descripcion']; ?></textarea>
                            <label for="categoria_descripcion" class="form-label">Descripción</label>
                        </div>
                    </div>
                </div>
              
            </div>
        </fieldset>
       
					<p class="text-center" style="margin-top: 40px;">
						<button type="submit" class="btn btn-raised btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
					</p>
				</form>
			
    <?php } ?>
</div>