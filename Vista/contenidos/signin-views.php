

		<div class="logiin-container">
			<div class="login-content">
				<p class="text-center">
					<i class="fas fa-user-circle fa-5x"></i>
				</p>
				<p class="text-center">
					Inicia sesión con tu cuenta
				</p>
				<form action="" method="POST" autocomplete="off" >
					<div class="form-group">
                    <label for="UserName" class="bmd-label-floating"><i class="fas fa-user-secret"></i> &nbsp; Email</label>
						<input type="email" class="form-control" id="UserName" name="email_log" maxlength="35"  >
					</div>
					<div class="form-group">
                    <label for="UserPassword" class="bmd-label-floating"><i class="fas fa-key"></i> &nbsp; Contraseña</label>
						<input type="password" class="form-control" id="UserPassword" name="clave_log" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100"  >
					</div>
                    <button type="submit" class="  btn-info btn-sm btn-login text-center">LOG IN</button>
				</form>
				
			    </form>
	                <hr>
                    <p class="text-center poppins-regular">¿No tienes cuenta? <a href="<?php echo SERVERURL; ?>registration/" class="font-weight-bold">Regístrate aquí</a></p>
	                
	            </div>
</div>
</div>
<?php
    if(isset($_POST['email_log']) && isset($_POST['clave_log'])){
         require_once "./Vista/inc/js/sweealert.php";
		require_once "./controladores/signinControlador.php";
   		$ins_login= new signinControlador();
		$ins_login->iniciar_sesion_cliente_controlador();
	}?>
