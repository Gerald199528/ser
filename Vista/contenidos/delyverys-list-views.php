
                <!-- Page header -->
                <div class="full-box page-header">
                    <h3 class="text-center">
                        <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE DELIVERY.
                    </h3>
                    <p class="text-center">
                    SI ERES ADMINISTRADOR NIVEL "1" TIENES ACCESO A ELIMINAR, ACTUALIZAR ,AGREGAR Y BUSCAR .
                    </p>
                </div>

                <div class="container-fluid">
                    <ul class="full-box list-unstyled page-nav-tabs">
                        
                        <li>
                        <?php if( $_SESSION['privilegio_Ser']==1){ ?>
                        <a  href="<?php echo SERVERURL.DASHBOARD; ?>/delyverys-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO DELIVERY</a>   
                        
                        
                        <?php  } ?>
                        
                        </li>
                        <li>
                          <a  class="active" href="<?php echo SERVERURL.DASHBOARD; ?>/delyverys-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE DELIVERY</a>
                        </li>
                        <li>
                        <a href="<?php echo SERVERURL.DASHBOARD; ?>/delyverys-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCARDELIVERY</a>
                        </li>
                    </ul>
                </div>
                
                <!--CONTENT-->
                <div class="container-fluid">
    				
                <div class="container-fluid">
					<?php
					require_once "./Controladores/delyverysControlador.php";
					$ins_delyverys = new delyverysControlador();


					echo $ins_delyverys->paginador_delyverys_controlador($pagina[2],4, $_SESSION['privilegio_Ser'],$pagina[1],"");


					?>
    			</div>
       
    	