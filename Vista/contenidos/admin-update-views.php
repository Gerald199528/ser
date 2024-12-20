	<?php 
	if($Lc->encryption( $_SESSION['id_Ser'])!=$pagina[1]){
		if( $_SESSION['privilegio_Ser']!=1){
			echo $Lc->forzar_cierre_sesion_controlador();
			exit();		
		}	
	}	
	
	?>			
		<!-- Page header -->
			<div class="full-box page-header">
				<h3 class="text-center">
					<i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR USUARIO O ADMINISTRADOR
				</h3>
				<p class="text-center">
					Puedes actualizar datos deshabilitar el tipo de cuenta y colocar nivel de usuario.
				</p>
			</div>
			
			<?php if( $_SESSION['privilegio_Ser']==1){ ?>		
			<div class="container-fluid">
					<ul class="full-box list-unstyled page-nav-tabs">
						<li>
						<a  href="<?php echo SERVERURL.DASHBOARD; ?>/admin-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO  ADMINISTRADOR </a>
						</li>
						<li>
						<a   href="<?php echo SERVERURL.DASHBOARD; ?>/admin-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA  ADMINISTRADOR </a>
						</li>
						<li>
						<a  href="<?php echo SERVERURL.DASHBOARD; ?>/admin-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR ADMINISTRADOR </a>
						</li>
					</ul>	
				</div>
			<?php } ?>
			<!-- Content -->
			<div class="container-fluid">
				<?php
				require_once "./Controladores/usuarioControlador.php";



				
				$ins_usuario = new usuarioControlador();

				$datos_usuario=$ins_usuario->datos_usuario_controlador("Unico",$pagina[2]);

					if($datos_usuario->rowCount()==1){
						$campos=$datos_usuario->fetch();			


				?>				
				<form  class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php"  method="POST" data-form="update" autocomplete="off" >
				<input type="hidden" name="usuario_id_up"  value="<?php echo $pagina[2]; ?>">
					<fieldset>
						<legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-4">
								<div class="form-group">
											<label for="usuario_cedula" class="bmd-label-floating">Cedula</label>
											<input type="text" pattern="[0-9-]{8,20}" class="form-control" name="usuario_cedula_up" id="usuario_cedula" maxlength="8"  value="<?php echo $campos['usuario_cedula']; ?>">
										</div>
								</div>
								
								<div class="col-12 col-md-4">
										<div class="form-group">
											<label for="usuario_nombre" class="bmd-label-floating">Nombre</label>
											<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="usuario_nombre_up" id="usuario_nombre" maxlength="35" value="<?php echo $campos['usuario_nombre']; ?>">
										</div>
									</div>
									<div class="col-12 col-md-4">
										<div class="form-group">
											<label for="usuario_apellido" class="bmd-label-floating">Apellido</label>
											<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="usuario_apellido_up" id="usuario_apellido" maxlength="35" value="<?php echo $campos['usuario_apellido']; ?>"> 
										</div>
									</div>
									<div class="col-12 col-md-6">
								<div class="form-group">
											<label for="usuario_telefono" class="bmd-label-floating">Telefono</label>
											<input type="text" pattern="[0-9-]{8,12}" class="form-control" name="usuario_telefono_up" id="usuario_telefono" maxlength="12"  value="<?php echo $campos['usuario_telefono']; ?>">
										</div>
								</div>
								
									<div class="col-12 col-md-6">
										<div class="form-group">
											<label for="usuario_direccion" class="bmd-label-floating">Dirección</label>
											<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="usuario_direccion_up" id="usuario_direccion" maxlength="190"  value="<?php echo $campos['usuario_direccion']; ?>">
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
											<input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="usuario_usuario_up" id="usuario_usuario" maxlength="35"  value="<?php echo $campos['usuario_usuario']; ?>">
										</div>
									</div>
									<div class="col-12 col-md-6">
										<div class="form-group">
											<label for="usuario_email" class="bmd-label-floating">Email</label>
											<input type="email" class="form-control" name="usuario_email_up" id="usuario_email" maxlength="50" value="<?php echo $campos['usuario_email']; ?>">
									</div>									
									</div>
									<?php  if($_SESSION['privilegio_Ser']==1 && $campos['usuario_id']!=1){ ?>

								<div class="col-12">
									<div class="form-group">
										<span>Estado de la cuenta  &nbsp; 
											
											<?php if($campos['usuario_estado']=="Activa"){

											echo '<span class="badge badge-info">Activa</span>';
										}
											else{
												echo '<span class="badge badge-danger">Deshabilitada</span>';
												
											} ?></span>
										<select class="form-control" name="usuario_estado_up">
											<option value="Activa" 
											<?php if($campos['usuario_estado']=="Activa"){
											 echo 'selected=""'; } ?> >Activa</option>
											<option value="Deshabilitada" 
											 <?php if($campos['usuario_estado']=="Deshabilitada"){
												 echo 'selected=""';  } ?> >Deshabilitada</option>
										</select>
									</div>
								
								
								</div>
								<?php } ?>
							</div>
							<!-- inicio imagen -->
							<fieldset class="mb-4">
            <legend><i class="fas fa-user-circle"></i> &nbsp; Seleccione una avatar si desea actualizar la imagen de perfil</legend>
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
                                            <input type="radio" class="form-check-input" name="usuario_avatar_up" id="radio_avatar'.$c.'" value="'.$avatar.'" '.$check.' >
                                            <label class="form-check-label" for="radio_avatar'.$c.'" ><img src="'.SERVERURL.'Vista/assets/avatar/'.$avatar.'" alt="'.$avatar.'" class="img-fluid radio-avatar-img" style="height:40px; width="45px;"></label>
                                        </div>
                                    </div>
                                ';
                                $check="";
                                $c++;
                            }
                        } 
                    ?>
					<!-- fin imagen -->
						</div>
					</fieldset>
					<br><br><br>
					<fieldset>
						<legend style="margin-top: 40px;"><i class="fas fa-lock"></i> &nbsp; Nueva contraseña</legend>
						<p>Para actualizar la contraseña de esta cuenta ingrese una nueva y vuelva a escribirla. En caso que no desee actualizarla debe dejar vacíos los dos campos de las contraseñas.</p>
						<div class="container-fluid">
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
										<select class="form-control" name="usuario_privilegio_up">
											<option value="" selected="" disabled="">Seleccione una opción</option>
											
											<option value="1" <?php if($campos['usuario_privilegio']==1){ echo 'selected=""'; } ?> >"Administrador general"
											<?php if($campos['usuario_privilegio']==1){ echo '(Actual)'; } ?></option>

											<option value="2" <?php if($campos['usuario_privilegio']==2){ echo 'selected=""';}?>>Edición "Administrador actualizar"
											<?php if($campos['usuario_privilegio']==2){ echo '(Actual)'; } ?> </option>

											<option value="3" <?php if($campos['usuario_privilegio']==3){ echo 'selected=""';} ?> >Registrar "Empleado"
											<?php if($campos['usuario_privilegio']==3){ echo '(Actual)'; } ?> </option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<br><br><br>
					<fieldset>
						<p class="text-center">Para poder guardar los cambios en esta cuenta debe de ingresar su nombre de usuario y contraseña</p>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="usuario_admin" class="bmd-label-floating">Nombre de usuario</label>
										<input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="usuario_admin" id="usuario_admin" maxlength="35"  >
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="clave_admin" class="bmd-label-floating">Contraseña</label>
										<input type="password" class="form-control" name="clave_admin" id="clave_admin" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100"  >
									</div>
								</div>
								
							</div>
							
						</div>
			
					</fieldset>

					<?php if($Lc->encryption( $_SESSION['id_Ser'])!=$pagina[1]){ ?>
					<input type="hidden" name="tipo_cuenta" value="Impropia" >

				    <?php }else{ ?>
						<input type="hidden" name="tipo_cuenta" value="Propia" >

					<?php }	?>	

					<p class="text-center" style="margin-top: 40px;">
						<button type="submit" class="btn btn-raised btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
					</p>
				</form>
				


				<?php
        }else{ include "./Vista/inc/".LANG."/error_alert.php";}
    ?>
				
			</div>
