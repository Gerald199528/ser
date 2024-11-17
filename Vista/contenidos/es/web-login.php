

		<div class="login-container">
			<div class="login-content">
				<p class="text-center">
					<i class="fas fa-user-circle fa-5x"></i>
				</p>
				<p class="text-center">
					Inicia sesión con tu cuenta
				</p>
				<form action="" method="POST" autocomplete="off" >
					<div class="form-group">
						<label for="UserName" class="bmd-label-floating"><i class="fas fa-user-secret"></i> &nbsp; Usuario</label>
						<input type="text" class="form-control" id="UserName" name="usuario_log" pattern="[a-zA-Z0-9]{1,35}" maxlength="35"  >
					</div>
					<div class="form-group">
						<label for="UserPassword" class="bmd-label-floating"><i class="fas fa-key"></i> &nbsp; Contraseña</label>
						<input type="password" class="form-control" id="UserPassword" name="clave_log" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100"  >
					</div>
					<button type="submit" class="btn-login text-center">LOG IN</button>
				</form>
				
				</div>
    <a href="<?php echo SERVERURL;?>" class="login-icon-home" data-toggle="tooltip" data-placement="top" title="Inicio" ><i class="fas fa-home"></i></a>
</div>
</div>
<?php
if(isset($_POST['usuario_log']) && isset($_POST['clave_log'])){
 require_once "./Controladores/loginControlador.php";
 require_once "./Vista/inc/js/js.php";

 $ins_login= new loginControlador();
 echo $ins_login->iniciar_sesion_controlador();

}

?>
