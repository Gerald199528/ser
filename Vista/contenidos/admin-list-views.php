
		<!-- nivel privilegio 1 -->
		<?php 
if( $_SESSION['privilegio_Ser']!=1){
	echo $Lc->forzar_cierre_sesion_controlador();
	exit();

	
}	
	?>
	
	<!-- Page header -->
				<div class="full-box page-header">
					<h3 class="text-center">
						<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE USUARIO  ACTIVOS CON SU RESPECTIVO PRIVILEGIO.
					</h3>
					<p class="text-center">
						SI ERES ADMINISTRADOR NIVEL "1" TIENES ACCESO A ELIMINAR, ACTUALIZAR ,AGREGAR Y BUSCAR.
					</p>
				</div>
				
				<div class="container-fluid">
					<ul class="full-box list-unstyled page-nav-tabs">
						<li>
						<a  href="<?php echo SERVERURL.DASHBOARD; ?>/admin-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO  ADMINISTRADOR </a>
						</li>
						<li>
						<a class="active"  href="<?php echo SERVERURL.DASHBOARD; ?>/admin-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE ADMINISTRADOR </a>
						</li>
						<li>
						<a  href="<?php echo SERVERURL.DASHBOARD; ?>/admin-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR ADMINISTRADOR </a>
						</li>
					</ul>	
				</div>
				
				<!-- Content -->
				<div class="container-fluid">
					<?php
					require_once "./Controladores/usuarioControlador.php";
					$ins_usuario = new usuarioControlador();


					echo $ins_usuario->paginador_usuario_controlador($pagina[2],4, $_SESSION['privilegio_Ser'], $_SESSION['id_Ser'],$pagina[1],"");


					?>
				</div>

