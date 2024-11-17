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
		
		&nbsp; Perfil de Usuario
				</h3>
				<p class="text-center">
				</p>
			</div>
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
											<label for="usuario_telefono" class="bmd-label-floating">Teléfono</label>
											<input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="usuario_telefono_up" id="usuario_telefono" maxlength="12" value="<?php echo $campos['usuario_telefono']; ?>">
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
									

						

					<?php if($Lc->encryption( $_SESSION['id_Ser'])!=$pagina[1]){ ?>
					<input type="hidden" name="tipo_cuenta" value="Impropia" >

				    <?php }else{ ?>
						<input type="hidden" name="tipo_cuenta" value="Propia" >

					<?php }	?>	

					<p class="text-center" style="margin-top: 40px;">
											</p>
				</form>
				<?php }else { ?>
				<div class="alert alert-danger text-center" role="alert">
					<p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
					<h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
					<p class="mb-0">Lo sentimos, no podemos mostrar la información solicitada debido a un error.</p>
				</div>
				<?php } ?>
			</div>
