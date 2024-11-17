
                <!-- Page header -->
                <div class="full-box page-header">
                    <h3 class="text-center">
                        <i class="fas fa-users fa-fw"></i> &nbsp; NUEVO CLIENTE
                    </h3>
                    <p class="text-center">
                 PUEDES REGISTRAR UN CLIENTE POR ESTE MODULO SI LO DESEA!
                    </p>
                </div>

                <div class="container-fluid">
                    <ul class="full-box list-unstyled page-nav-tabs">
                        <li>
                            <a class="active" href="<?php echo SERVERURL.DASHBOARD; ?>/cliente-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO CLIENTE</a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL.DASHBOARD; ?>/cliente-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CLIENTE</a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL.DASHBOARD; ?>/delyverys-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR CLIENTE</a>
                        </li>
                    </ul>
                </div>
                

			<div class="container-fluid">
				<form class="form-neon FormularioAjax" method="POST" data-form="save"  autocomplete="off" action="<?php echo SERVERURL;?>ajax/clienteAjax.php" >
				
				<fieldset>
					<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-4">
								<div class="form-group">
								<input type="text" pattern="[0-9-]{8,20}" class="form-control" name="cliente_dni_reg" id="cliente_dni" maxlength="8">
										<label for="cliente_dni" class="form-label">Cedula o Rif</label>
									</div>
								</div>
								<div class="col-12 col-md-4">
													<div class="form-group">
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}" class="form-control" name="cliente_nombre_reg" id="cliente_nombre" maxlength="35">
										<label for="cliente_nombre" class="form-label">Nombres</label>
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}" class="form-control" name="cliente_apellido_reg" id="cliente_apellido" maxlength="35">
										<label for="cliente_apellido" class="form-label">Apellidos</label>
									</div>
								</div>
								<div class="col-12 col-md-6">
										<div class="form-group">
										<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="cliente_telefono_reg" id="cliente_telefono" maxlength="10">
										<label for="cliente_telefono" class="form-label">Teléfono</label>
									</div>
								</div>
					
				
								<div class="col-12 col-md-6">
									<div class="form-group">
																		
														<select class="form-control" name="cliente_genero_reg" id="cliente_genero">
															<option value="" selected="" disabled="">Seleccione Genero</option>
															<option value="Mujer">Mujer</option>
															<option value="Hombre">Hombre</option>
													
															
												</select>
																	<label for="cliente_genero" class="form-label"> Genero</label>
                        </div>
                    </div>
							
												
				
					</fieldset>
					<fieldset class="mb-4">
						<legend><i class="fas fa-map-marked-alt"></i> &nbsp; Información de envió</legend>
						<div class="container-fluid">
							<div class="row">
							
							<div class="col-12 col-md-6">
									<div class="form-group">
																		
														<select class="form-control" name="cliente_provincia_reg" id="cliente_provincia">
															<option value="" selected="" disabled="">Seleccione Estado </option>
															<?php
																	echo $Lc->generar_select(CIUDAD,"");
																?>
															
												</select>
												<label for="cliente_provincia" class="form-label">Estado Actual de Venezuela</label>
                        </div>
                    </div>
								
							
						<div class="col-12 col-md-6">
										<div class="form-group">
																			
															<select class="form-control" name="cliente_ciudad_reg" id="cliente_ciudad">
																<option value="" selected="" disabled="">Seleccione Ciudad o Municipio</option>
																<?php
																		echo $Lc->generar_select(MUNICIPIO,"");										?>
																
													</select>
													<label for="cliente_ciudad" class="form-label">Ciudad o Municipio</label>
							</div>
						</div>
								
							
								<div class="col-12 col-md-12">
									<div class="form-group">
										<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,70}" class="form-control" name="cliente_direccion_reg" id="cliente_direccion" maxlength="100">
										<label for="cliente_direccion" class="form-label">Calle y  dirección de casa </label>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<fieldset class="mb-4">
						<legend><i class="fas fa-user-lock"></i> &nbsp; Datos de la cuenta</legend>
						<div class="container-fluid">
							<div class="row">
							
								<div class="col-12 col-md-6">
									<div class="form-group">
										<input type="email" class="form-control" name="cliente_email_reg" id="cliente_email" maxlength="47">
										<label for="cliente_email" class="form-label">Email </label>
									</div>
								</div>
							
								<div class="col-12 col-md-6">
									<div class="form-group">
										<input type="password" class="form-control" name="cliente_clave_1_reg" id="cliente_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
										<label for="cliente_clave_1" class="form-label">Contraseña </label>
									</div>
								</div>
							
								<div class="col-12 col-md-12">
									<div class="form-group">
										<input type="password" class="form-control" name="cliente_clave_2_reg" id="cliente_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
										<label for="cliente_clave_2" class="form-label">Repita contraseña </label>
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