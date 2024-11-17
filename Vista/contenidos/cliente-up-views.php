<div class="container container-web-page">
    <h3 class="font-weight-bold poppins-regular text-center" ><i class="fas fa-user-circle fa-4x" ></i><br>PERFIL USUARIO</h3>
  
    <div class="row">
        <div class="col-12">
         <div class="container-fluid">
		 <?php
          
	  $datos_cliente=$Lc->datos_tabla("Unico","cliente","cliente_id",$pagina[1]);
	  if($datos_cliente->rowCount()==1){
		  $campos=$datos_cliente->fetch();
  ?>
				<form class="form-neon FormularioAjax" method="POST" data-form="update"  autocomplete="off" action="<?php echo SERVERURL;?>ajax/clienteAjax.php" >
				<input type="hidden" name="modulo_cliente" value="actualizar">				
				<input type="hidden" name="cliente_id_up" value="<?php echo $pagina[1]; ?>">
				<fieldset>
					<legend><i  class="far fa-address-card  "></i> &nbsp;Datos  Personales</legend>
					<div class="container-fluid">
						<div class="row">
							
								<div class="col-12 col-md-6">
													<div class="form-group">
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}" class="form-control" name="cliente_nombre_up" id="cliente_nombre" maxlength="35" value="<?php echo $campos['cliente_nombre']; ?>">
										<label for="cliente_nombre" class="form-label">Nombre</label>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}" class="form-control" name="cliente_apellido_reg" id="cliente_apellido" maxlength="35" value="<?php echo $campos['cliente_apellido']; ?>">
										<label for="cliente_apellido" class="form-label">Apellido</label>
									</div>
								</div>
								<div class="col-12 col-md-6">
										<div class="form-group">
										<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="cliente_telefono_reg" id="cliente_telefono" maxlength="10" value="<?php echo $campos['cliente_telefono']; ?>">
										<label for="cliente_telefono" class="form-label">Teléfono</label>
									</div>
								</div>
					
				
								<div class="col-12 col-md-6">
									<div class="form-group">
									<label for="cliente_genero" class="form-label">Estado de producto</label>
                                <select class="form-control" name="cliente_genero_up" id="cliente_genero">
                                    <?php
                                        $array_genero=["Mujer","Hombre"];
                                        echo $Lc->generar_select($array_genero,$campos['cliente_genero']);
                                    ?>		
															
												</select>
																
                        </div>
                    </div>
							
												
				
					</fieldset>
					<fieldset class="mb-4">
						<legend><i class="fas fa-map-marked-alt"></i> &nbsp; Información Detallada</legend>
						<div class="container-fluid">
							<div class="row">
							
							<div class="col-12 col-md-6">
									<div class="form-group">
									<label for="cliente_provincia" class="form-label">Estado actual de evenzuela</label>
                                <select class="form-control" name="cliente_provincia_up" id="cliente_provincia">
                                    <?php
                                        $array_provincia=["Edo-Trujillo"];
                                        echo $Lc->generar_select($array_provincia,$campos['cliente_provincia']);
                                    ?>		
															
												</select>
															
											
                        </div>
                    </div>
								
							
						<div class="col-12 col-md-6">
										<div class="form-group">
																			
										<label for="cliente_ciudad" class="form-label">Ciudad o Municipio</label>
                                <select class="form-control" name="cliente_ciudad_up" id="cliente_ciudad">
                                    <?php
                                        $array_ciudad=["Andrés Bello","Boconó","Bolívar","Candelaria","Carache","Escuque","J. Felipe Marquez Cañizales","Juan Vicente Campo Elías","La Ceiba","Miranda","Monte Carmelo","Motatán","Pampán","Pampanito","Rafael Rangel","San Rafael de Carvajal","Sucre","Trujillo","Urdaneta","Valera"];
                                        echo $Lc->generar_select($array_ciudad,$campos['cliente_ciudad']);
                                    ?>		
															
												</select>
							</div>
						</div>
								
							
								<div class="col-12 col-md-12">
									<div class="form-group">
										<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,70}" class="form-control" name="cliente_direccion_reg" id="cliente_direccion" maxlength="100" value="<?php echo $campos['cliente_direccion']; ?>">
										<label for="cliente_direccion" class="form-label">Calle y  dirección de casa </label>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
				
						<legend style="margin-top: 40px;"><i class="fas fa-lock"></i> &nbsp; Nueva contraseña</legend>
						<p>Para actualizar la contraseña de esta cuenta ingrese una nueva y vuelva a escribirla. En caso que no desee actualizarla debe dejar vacíos los dos campos de las contraseñas.</p>
						<div class="container-fluid">
							<div class="row">
							
							<div class="row">
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="usuario_clave_nueva_1" class="bmd-label-floating">Contraseña</label>
										<input type="password" class="form-control" name="usuario_clave_nueva_1" id="usuario_clave_nueva_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="usuario_clave_nueva_2" class="bmd-label-floating">Repetir contraseña</label>
										<input type="password" class="form-control" name="usuario_clave_nueva_2" id="usuario_clave_nueva_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
									</div>
								</div>
							</div>
						</div>
					</fieldset>

                <p class="text-center" style="margin-top: 40px;">
				<button type="submit" class="btn btn-raised btn-success"><i class="fas fa-sync-alt"></i> &nbsp; Actualizar</button>
                </p>
              
            </form>
			<?php
            }else{ include "./Vista/inc/".LANG."/error_alert.php";}
        ?>
        </div>
    </div>
</div>