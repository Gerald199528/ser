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
						<i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR USUARIO O ADMINISTRADOR!
					</h3>
					<p class="text-center">
					COLOCA EL NOMBRE O CODIGO DEL ADMINISTRADOR QUE DESEA BUSCAR "NO SE PERMITEN CARÀCTERES"
					</p>
				</div>
				
				<div class="container-fluid">
					<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a  href="<?php echo SERVERURL.DASHBOARD; ?>/admin-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO ADMINISTRADOR </a>
						</li>
						<li>
						<a  href="<?php echo SERVERURL.DASHBOARD; ?>/admin-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE ADMINISTRADOR </a>
						</li>
						<li>
						<a  class="active"  href="<?php echo SERVERURL.DASHBOARD; ?>/admin-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR ADMINISTRADOR </a>
						</li>
					</ul>	
				</div>
				<?php
        if(!isset($_SESSION['busqueda_usuario']) && empty($_SESSION['busqueda_usuario'])){
    ?>
				<!-- Content -->
				<div class="container-fluid">

					<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php"  method="POST" data-form="default" autocomplete="off">
						<!-- definimos variable modulo -->
						<input type="hidden" name="modulo" value="usuario">


						<div class="container-fluid">
							<div class="row justify-content-md-center">
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="inputSearch" class="bmd-label-floating">¿Qué usuario estas buscando?</label>
										<input type="text" class="form-control" name="busqueda_inicial" id="inputSearch" maxlength="30">
									</div>
								</div>
								<div class="col-12">
									<p class="text-center" style="margin-top: 40px;">
										<button type="submit" class="btn btn-raised btn-info"><i class="fas fa-search"></i> &nbsp;Buscar</button>
									</p>
								</div>
							</div>
						</div>
					</form>
				</div>
				<?php }else{ ?>
				<div class="container-fluid">
					
					<form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php"  method="POST" data-form="search" autocomplete="off">
							<!-- definimos variable modulo -->
					<input type="hidden" name="modulo" value="usuario">

						<input type="hidden" name="eliminar_busqueda" value="eliminar">
						<div class="container-fluid">
							<div class="row justify-content-md-center">
								<div class="col-12 col-md-6">
									<p class="text-center" style="font-size: 20px;">

										Resultados de la busqueda <strong>"<?php echo $_SESSION['busqueda_usuario']; ?>"</strong>
									</p>
								</div>
								<div class="col-12">
									<p class="text-center" style="margin-top: 20px;">
										<button type="submit" class="btn btn-raised btn-danger"><i class="far fa-trash-alt"></i> &nbsp; Eliminar búsqueda</button>
									</p>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="container-fluid">
					<?php
					require_once "./Controladores/usuarioControlador.php";
					$ins_usuario = new usuarioControlador();


					echo $ins_usuario->paginador_usuario_controlador($pagina[1],4, $_SESSION['privilegio_Ser'],$_SESSION['id_Ser'],$pagina[0], $_SESSION['busqueda_usuario']);


					?>
	         <?php } ?>
			 	