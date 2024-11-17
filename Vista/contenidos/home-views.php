<?php if(isset($_SESSION['privilegio_Ser']) && ($_SESSION['privilegio_Ser']==1 || $_SESSION['privilegio_Ser']==3 || $_SESSION['privilegio_Ser']==2 )){ ?>
				<!-- Page header -->
				<div class="full-box page-header">
					<h3 class="text-center">
						<i class="fab fa-dashcube fa-fw"></i> &nbsp; VISTA GENERAL		
					<h3 class="text-center">
						 Este es el panel principal del sistema acá podrá encontrar atajos para acceder a los distintos listados de cada módulo del sistema.
				
				</div>
				
				
				<div class="full-box tile-container">
							<!-- nivel privilegio 1 -->
							<?php if( $_SESSION['privilegio_Ser']==1){								
								require_once "./Controladores/usuarioControlador.php";
								$ins_usuario = new usuarioControlador();
							$total_usuarios=$ins_usuario->datos_usuario_controlador("Conteo",0);
							 
																
								?>	
					<a href="<?php echo SERVERURL.DASHBOARD; ?>/admin-list/" class="tile">
						<div class="tile-tittle">Usuarios</div>
						<div class="tile-icon">
							<i class="fas fa-user-secret fa-fw"></i>
							<!-- aqui muestra cuantos estan registrados-->

							<p><?php echo $total_usuarios->rowCount(); ?> Registrados</p>
						</div>
					</a>
					<?php  } ?>
			
									


					<?php {								
								require_once "./Controladores/delyverysControlador.php";
								$ins_delyverys = new delyverysControlador();
							$total_delyverys=$ins_delyverys->datos_delyverys_controlador("Conteo",0);
							 
																
								?>	

					<a href="<?php echo SERVERURL.DASHBOARD; ?>/delyverys-list/" class="tile">
						<div class="tile-tittle">Delivery</div>
						<div class="tile-icon">
							<i class="fas fa-truck fa-fw"></i>
							
							<p><?php echo $total_delyverys->rowCount(); ?> Registrados</p>
						</div>
					</a>
					<?php  } ?>
					
			
					<?php {								
								require_once "./Controladores/clienteControlador.php";
								$ins_cliente = new clienteControlador();
							$total_cliente=$ins_cliente->datos_cliente_controlador("Conteo",0);
							 
																
								?>	
						
					<a  href="<?php echo SERVERURL.DASHBOARD; ?>/cliente-list/" class="tile">
						<div class="tile-tittle">Clientes</div>
						<div class="tile-icon">
							<i class="fas fa-users fa-fw"></i>
							<p><?php echo $total_cliente->rowCount(); ?> Registrados</p>
						</div>
					</a>
					<?php  } ?>

					<?php {								
								require_once "./Controladores/categoriacontrolador.php";
								$ins_categoria = new categoriaControlador();
							$total_categoria=$ins_categoria->datos_categoria_controlador("Conteo",0);
							 
																
								?>	

<?php if( $_SESSION['privilegio_Ser']==1){	?>	
					<a href="<?php echo SERVERURL.DASHBOARD; ?>/categoria-list/" class="tile">
						<div class="tile-tittle">Categoria</div>
						<div class="tile-icon">
							<i class="fas fa-tag fa-fw"></i>
							<p><?php echo $total_categoria->rowCount(); ?> Registradas</p>
						</div>
							<?php  } ?>
					</a>
					
					<?php  } ?>


					<?php if( $_SESSION['privilegio_Ser']==1 || $_SESSION['privilegio_Ser']==3 ){	?>	
					<?php {		
      
        $total_productos=$Lc->datos_tabla("Normal","producto","producto_id",0);
    ?>
					<a href="<?php echo SERVERURL.DASHBOARD; ?>/product-list/" class="tile">
						<div class="tile-tittle">Productos</div>
						<div class="tile-icon">
							<i class="fas fa-box-open  fa-fw"></i>
							<p><?php echo $total_productos->rowCount(); ?> Registrado</p>
						
						</div>
						<?php  } ?>
					</a>	
					<?php  } ?>

					<?php if( $_SESSION['privilegio_Ser']==1){	?>	
					<?php {		
      
	  $total_portada=$Lc->datos_tabla("Normal","portada","image_id",0);
  ?>
				  <a href="<?php echo SERVERURL.DASHBOARD; ?>/portadal-ist/" class="tile">
					  <div class="tile-tittle">Imagenes</div>
					  <div class="tile-icon">
						  <i class="far fa-image  fa-fw"></i>
						  <p><?php echo $total_portada->rowCount(); ?> Registrada</p>
						  <?php  } ?>
					  </div>
				  </a>	
				  <?php  } ?>
				  <?php if( $_SESSION['privilegio_Ser']==1 || $_SESSION['privilegio_Ser']==2 || $_SESSION['privilegio_Ser']==3){	?>	
				
					<?php {		
						
					require_once "./Controladores/empresaControlador.php";
								$ins_empresa = new empresaControlador();
							$total_empresa=$ins_empresa->conteo_empresa_controlador("Conteo",0);
							 
																
								?>	
					<a href="<?php echo SERVERURL.DASHBOARD; ?>/empresa/" class="tile">
					<div class="tile-tittle">Empresa</div>
						<div class="tile-icon">
							<i class="fas fa-store-alt fa-fw"></i>
							<p><?php echo $total_empresa->rowCount(); ?> Registrada</p>
						</div>
						<?php  } ?>
					</a>
					<?php  } ?>
				</div>
				</div>
				
				<?php
            }else{ include "./Vista/inc/".LANG."/error_alert.php";}
        ?>
			</section>
		</main>
		
		
		