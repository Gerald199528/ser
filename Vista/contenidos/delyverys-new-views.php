
                <!-- Page header -->
                <div class="full-box page-header">
                    <h3 class="text-center">
                        <i class="fas fa-truck fa-fw"></i> &nbsp; NUEVO DELIVERY.
                    </h3>
                    <p class="text-center">
                      LLENA LOS DATOS CORRECTAMENTE PARA PODER  REGISTRAR UN DELIVERY!
                    </p>
                </div>

                <div class="container-fluid">
                    <ul class="full-box list-unstyled page-nav-tabs">
                        <li>
                            <a class="active" href="<?php echo SERVERURL.DASHBOARD; ?>/delyverys-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO DELIVERY</a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL.DASHBOARD; ?>/delyverys-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE DELIVERY</a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL.DASHBOARD; ?>/delyverys-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR DELIVERY</a>
                        </li>
                    </ul>
                </div>
                
                <!--CONTENT-->
                <div class="container-fluid">
    				<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/delyverysAjax.php"  method="POST" data-form="save" autocomplete="off">
    					<fieldset>
    						<legend><i class="fas fa-truck"></i> &nbsp; Información Delyverys</legend>
    						<div class="container-fluid">
    							<div class="row">
    								<div class="col-12 col-md-4">
    									<div class="form-group">
    										<label for="codigo" class="bmd-label-floating">Codigo</label>
    										<input type="text" pattern="[0-9-]{8,20}" class="form-control" name="codigo_reg" id="codigo" maxlength="8" required="">
    									</div>
    								</div>
    								
    								<div class="col-12 col-md-4">
    									<div class="form-group">
    										<label for="nombre" class="bmd-label-floating">Nombre</label>
    										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="nombre_reg" id="nombre" maxlength="35">
    									</div>
    								</div>
    								<div class="col-12 col-md-4">
    									<div class="form-group">
    										<label for="apellido" class="bmd-label-floating">Apellido</label>
    										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="apellido_reg" id="apellido" maxlength="35">
    									</div>
    								</div>
    								<div class="col-12 col-md-6">
    									<div class="form-group">
    										<label for="estado" class="bmd-label-floating">Estado</label>
    										<select class="form-control" name="estado_reg" id="estado">
    											<option value="" selected="" disabled="">Seleccione una opción</option>
    											<option value="Habilitado">Habilitado</option>
												<option value="Deshabilitado">Deshabilitado</option>
												
    											
    										</select>
    									</div>
    								</div>
								
									<div class="col-12 col-md-6">
    									<div class="form-group">
    										<label for="telefono" class="bmd-label-floating">telefono</label>
    										<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="telefono_reg" id="telefono" maxlength="15">
    									</div>

    								</div>
    							</div>
									
								<div class="col-12 col-md-12">
    									<div class="form-group">
    										<label for="direccion" class="bmd-label-floating">Direccion</label>
    										<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="direccion_reg" id="direccion" maxlength="190">
    									</div>
    						</div>
    					</fieldset>
    					<br><br><br>
    					<p class="text-center" style="margin-top: 40px;">
						<button type="reset" class="btn btn-raised btn-secondary "><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
    					</p>
    				</form>
    			</div>
                
