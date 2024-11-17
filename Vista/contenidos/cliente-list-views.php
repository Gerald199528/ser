
                <!-- Page header -->
                <div class="full-box page-header">
                    <h3 class="text-center">
                        <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CLIENTES.
                    </h3>
                    <p class="text-center">
                    SI ERES ADMINISTRADOR NIVEL "1" TIENES ACCESO A ELIMINAR, AGREGAR Y BUSCAR .
                    </p>
                </div>

                <div class="container-fluid">
                    <ul class="full-box list-unstyled page-nav-tabs">
                        
                        <li>
                        <?php if( $_SESSION['privilegio_Ser']==1){ ?>
                        <a  href="<?php echo SERVERURL.DASHBOARD; ?>/cliente-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO CLIENTE</a>   
                        
                        
                        <?php  } ?>
                        
                        </li>
                        <li>
                            <a class="active"  href="<?php echo SERVERURL.DASHBOARD; ?>/cliente-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CLIENTE</a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL.DASHBOARD; ?>/cliente-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR CLIENTE</a>
                        </li>
                    </ul>
                </div>
                
                <!--CONTENT-->
                <div class="container-fluid">
    				
                <div class="container-fluid">
					<?php
					require_once "./Controladores/clienteControlador.php";
					$ins_cliente = new clienteControlador();


					echo $ins_cliente->paginador_cliente_controlador($pagina[2],4, $_SESSION['privilegio_Ser'],$pagina[1],"");


					?>
    			</div>
       
    	