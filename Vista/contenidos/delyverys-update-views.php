<?php 
	if($Lc->encryption( $_SESSION['id_Ser'])!=$pagina[1]){
		if( $_SESSION['privilegio_Ser']!=1  &&  $_SESSION['privilegio_Ser']!=3 ){
			echo $Lc->forzar_cierre_sesion_controlador();
			exit();		
		}	
	}	
	
	?>			
	
                <!-- Page header -->
                <div class="full-box page-header">
                    <h3 class="text-center">
                        <i class="fas fa-truck fa-fw"></i> &nbsp; ACTUALIZAR DELIVERY.
                    </h3>
                    <p class="text-center">
                     SI DESEAS ACTUALIZAR LLENA CORRECTAMENTE LOS DATOS Y HABILITA LA OPCION DE ESTADO!
                    </p>
                </div>

                <div class="container-fluid">
                    <ul class="full-box list-unstyled page-nav-tabs">
                        <li>
                            <a  href="<?php echo SERVERURL.DASHBOARD; ?>/delyverys-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO DELIVERY</a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL.DASHBOARD; ?>/delyverys-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE DELIVERY</a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL.DASHBOARD; ?>/delyverys-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR DELIVERY</a>
                        </li>
                    </ul>
                </div>
                
			<!-- Content -->
			<div class="container-fluid">
				<?php
				require_once "./Controladores/delyverysControlador.php";
				$ins_delyverys = new delyverysControlador();

				$datos_delyverys=$ins_delyverys->datos_delyverys_controlador("Unico",$pagina[2]);

					if($datos_delyverys->rowCount()==1){
						$campos=$datos_delyverys->fetch();			


				?>				
				<form  class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/delyverysAjax.php"  method="POST" data-form="update" autocomplete="off" >
				<input type="hidden" name="id_up"  value="<?php echo $pagina[2]; ?>">
					<fieldset>
						<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-4">
								<div class="form-group">
											<label for="codigo" class="bmd-label-floating">codigo</label>
											<input type="text" pattern="[0-9-]{8,20}" class="form-control" name="codigo_up" id="codigo" maxlength="8"  value="<?php echo $campos['codigo']; ?>">
										</div>
								</div>
								
								<div class="col-12 col-md-4">
										<div class="form-group">
											<label for="nombre" class="bmd-label-floating">Nombre</label>
											<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="nombre_up" id="nombre" maxlength="35" value="<?php echo $campos['nombre']; ?>">
										</div>
									</div>
									<div class="col-12 col-md-4">
										<div class="form-group">
											<label for="apellido" class="bmd-label-floating">Apellido</label>
											<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="apellido_up" id="apellido" maxlength="35" value="<?php echo $campos['apellido']; ?>"> 
										</div>
									</div>
									
							
									
									<div class="col-12 col-md-6">
										<div class="form-group">
											<label for="telefono" class="bmd-label-floating">Telefono</label>
											<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="telefono_up" id="telefono" maxlength="190"  value="<?php echo $campos['telefono']; ?>">
										</div>
								</div>
									<div class="col-12 col-md-6">
										<div class="form-group">
											<label for="direccion" class="bmd-label-floating">Dirección</label>
											<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="direccion_up" id="direccion" maxlength="190"  value="<?php echo $campos['direccion']; ?>">
										</div>
								</div>
								<div class="col-12">
										<div class="form-group">
											<span>Estado de la cuenta  &nbsp; 
												<?php if($campos['estado']=="Habilitado"){

												echo '<span class="badge badge-info">Habilitado</span>';
											}
												else{
													echo '<span class="badge badge-danger">Deshabilitada</span>';
													
												} ?></span>
											<select class="form-control" name="estado_up">
											
													<option value="Habilitado" 
												<?php if($campos['estado']=="Habilitado"){
													echo 'selected=""';  } ?> >Habilitado</option>

												<option value="Deshabilitado" 
												<?php if($campos['estado']=="Deshabilitado"){
													echo 'selected=""';  } ?> >Deshabilitado</option>


											</select>
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
