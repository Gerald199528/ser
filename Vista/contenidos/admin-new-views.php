	<!-- nivel privilegio -->
<?php 
if( $_SESSION['privilegio_Ser']!=1){
	echo $Lc->forzar_cierre_sesion_controlador();
	exit();

	
}	
	?>

				<!-- Page header -->
				<div class="full-box page-header">
					<h3 class="text-center">
						<i class="fas fa-user-secret fa-fw"></i> &nbsp; NUEVO USUARIO O ADMINISTRADOR
					</h3>
					<p class="text-center">
					PUEDES REGISTRAR UN ADMINISTRADOR O USUARIOS CON SUS PRIVILEGIOS  "POR FAVOR RELLENE TODO LOS CAMPOS CORRECTAMENTE".
					</p>
				</div>
				
				<div class="container-fluid">
					<ul class="full-box list-unstyled page-nav-tabs">
						<li>
							<a class="active"  href="<?php echo SERVERURL.DASHBOARD; ?>/admin-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO  ADMINISTRADOR </a>
						</li>
						<li>
							<a  href="<?php echo SERVERURL.DASHBOARD; ?>/admin-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE  ADMINISTRADOR </a>
						</li>
						<li>
							<a  href="<?php echo SERVERURL.DASHBOARD; ?>/admin-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR ADMINISTRADOR </a>
						</li>
					</ul>	
				</div>
				
				<!-- Content -->
				<div class="container-fluid">
					<form  class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php"  method="POST" data-form="save" autocomplete="off" >
						<fieldset>
							<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
							<div class="container-fluid">
								<div class="row">
									<div class="col-12 col-md-4">
										<div class="form-group">
											<label for="usuario_cedula" class="bmd-label-floating">Cedula</label>
											<input type="text" pattern="[0-9-]{8,20}" class="form-control" name="usuario_cedula_reg" id="usuario_cedula" maxlength="8" required="">
										</div>
									</div>
									
									<div class="col-12 col-md-4">
										<div class="form-group">
											<label for="usuario_nombre" class="bmd-label-floating">Nombre</label>
											<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="usuario_nombre_reg" id="usuario_nombre" maxlength="35" required="" >
										</div>
									</div>
									<div class="col-12 col-md-4">
										<div class="form-group">
											<label for="usuario_apellido" class="bmd-label-floating">Apellido</label>
											<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="usuario_apellido_reg" id="usuario_apellido" maxlength="35"  required="">
										</div>
									</div>
									<div class="col-12 col-md-6">
										<div class="form-group">
											<label for="usuario_telefono" class="bmd-label-floating">Teléfono</label>
											<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="usuario_telefono_reg" id="usuario_telefono" maxlength="12">
										</div>
									</div>
									<div class="col-12 col-md-6">
										<div class="form-group">
											<label for="usuario_direccion" class="bmd-label-floating">Dirección</label>
											<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="usuario_direccion_reg" id="usuario_direccion" maxlength="190">
										</div>
									</div>
								</div>
							</div>
						</fieldset>
						<br><br><br>
						<fieldset>
							<legend><i class="fas fa-user-lock"></i> &nbsp; Información de la cuenta</legend>
							<div class="container-fluid">
								<div class="row">
									<div class="col-12 col-md-6">
										<div class="form-group">
											<label for="usuario_usuario" class="bmd-label-floating">Nombre de usuario</label>
											<input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="usuario_usuario_reg" id="usuario_usuario" maxlength="35" required="">
										</div>
									</div>
									<div class="col-12 col-md-6">
										<div class="form-group">
											<label for="usuario_email" class="bmd-label-floating">Email</label>
											<input type="email" class="form-control" name="usuario_email_reg" id="usuario_email" maxlength="35">
										</div>
									</div>
									<div class="col-12 col-md-6">
										<div class="form-group">
											<label for="usuario_clave_1" class="bmd-label-floating">Contraseña</label>
											<input type="password" class="form-control" name="usuario_clave_1_reg" id="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="15" required="" >
										</div>
									</div>
									<div class="col-12 col-md-6">
										<div class="form-group">
											<label for="usuario_clave_2" class="bmd-label-floating">Repetir contraseña</label>
											<input type="password" class="form-control" name="usuario_clave_2_reg" id="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="15"  required="">
										</div>
									</div>
								</div>
							</div>
						</fieldset>
						<br><br><br>
						<fieldset>
							<legend><i class="fas fa-medal"></i> &nbsp; Nivel de privilegio</legend>
							<div class="container-fluid">
								<div class="row">
									<div class="col-12">
										<p><span class="badge badge-info">Control total</span> Permisos para registrar, actualizar y eliminar "Administrador general"</p>
										<p><span class="badge badge-success">Edición</span> Permisos para registrar y actualizar "Administrador actualizar"</p>
										<p><span class="badge badge-dark">Registrar</span> Solo permisos para registrar y resivir pedidos "Empleado"</p>
										<div class="form-group">
											<select class="form-control" name="usuario_privilegio_reg">
												<option selected="">Seleccione una opción</option>
												<option value="1">Control total "Administrador general"</option>
												<option value="2">Edición "Administrador actualizar"</option>
												<option value="3">Registrar   "Empleado"</option>
											</select>
										</div>
									
										<fieldset class="mb-4">
            <legend><i class="fas fa-user-circle"></i> &nbsp; Seleccione una imagen para el perfil </legend>
            <div class="container-fluid">
                <div class="row">
                    <?php 
                        $directorio_avatar=opendir("./Vista/assets/avatar/");
                        $check="checked";
                        $c=1;
                        while($avatar=readdir($directorio_avatar)){
                            if(is_file("./Vista/assets/avatar/".$avatar)){
                                echo '
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <div class="form-check radio-avatar-form">
                                            <input type="radio" class="form-check-input" name="usuario_avatar_reg" id="radio_avatar'.$c.'" value="'.$avatar.'" '.$check.' >
                                            <label class="form-check-label" for="radio_avatar'.$c.'" ><img src="'.SERVERURL.'Vista/assets/avatar/'.$avatar.'" alt="'.$avatar.'" class="img-fluid radio-avatar-img" style="height: 45px; width="45px;"></label>
                                        </div>
                                    </div>
                                ';
                                $check="";
                                $c++;
                            }
                        } 
                    ?>
                </div>
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

