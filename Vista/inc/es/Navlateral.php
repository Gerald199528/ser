      <!-- Nav lateral -->
            <section class="full-box nav-lateral">
                <div class="full-box nav-lateral-bg show-nav-lateral" ></div>
                <div class="full-box nav-lateral-content">
                    <figure class="full-box nav-lateral-avatar">
                        <i class="far fa-times-circle show-nav-lateral"></i>
                        <img src="<?php echo SERVERURL; ?>Vista/assets/avatar/<?php echo $_SESSION['avatar_Ser']; ?>" class="img-fluid" alt="Avatar">
                        
                        <figcaption class="roboto-medium text-center">
                           <?php echo   $_SESSION['nombre_Ser']." ".  $_SESSION['apellido_Ser'] ?> <br><small class="roboto-condensed-light"><?php echo  $_SESSION['usuario_Ser']?></small>
                        </figcaption>
                    </figure>
                    <div class="full-box nav-lateral-bar"></div>
                    <nav class="full-box nav-lateral-menu">
                        <ul>
                            <li>
                                <a href="<?php echo SERVERURL.DASHBOARD; ?>/home/"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Menu</a>
                            </li>
                            
                            <li>
                          
                          <a href="#" class="nav-btn-submenu"><i class="fas fa-users fa-fw"></i> &nbsp; Clientes <i class="fas fa-chevron-down"></i></a>
                          <ul>
                         
                              <li>
                              <?php if( $_SESSION['privilegio_Ser']==1){ ?>
                                  <a href="<?php echo SERVERURL.DASHBOARD; ?>/cliente-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo Clientes</a>
                                  <?php  } ?>
                              </li>
                              <li>
                              
                                  <a href="<?php echo SERVERURL.DASHBOARD; ?>/cliente-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de Clientes</a>
                              </li>
                              <li>
                                  <a href="<?php echo SERVERURL.DASHBOARD; ?>/cliente-search/"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar Clientes</a>
                                 
                              </li>
                          </ul>
                      </li>
                     
                          
                            	<!-- nivel privilegio  1-->
                                <?php if( $_SESSION['privilegio_Ser']==1){ ?>
                            <li>
                                <a href="#" class="nav-btn-submenu"><i class="fas  fa-user-secret fa-fw"></i> &nbsp; Usuarios <i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <li>
                                        <a href="<?php echo SERVERURL.DASHBOARD; ?>/admin-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo Usuario o Admin</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo SERVERURL.DASHBOARD; ?>/admin-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista Usuario o Admin</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo SERVERURL.DASHBOARD; ?>/admin-search/"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar Usuario o Admin</a>
                                    </li>
                                </ul>
                            </li>
                            <?php  } ?>
                            <li>
                       
                            <li>
                                
                                <a href="#" class="nav-btn-submenu"><i class="fas fa-truck fa-fw"></i> &nbsp; Delivery  <i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <li>
                                    <?php if( $_SESSION['privilegio_Ser']==1){ ?>
                                        <a href="<?php echo SERVERURL.DASHBOARD; ?>/delyverys-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo Delivery  </a>
                                        <?php  } ?>
                                    </li>
                                    <li>
                                
                                        <a href="<?php echo SERVERURL.DASHBOARD; ?>/delyverys-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista Delivery </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo SERVERURL.DASHBOARD; ?>/delyverys-search/"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar Delivery </a>
                                    
                                    </li>
                                </ul>
                            </li>
                            <li>
                            <?php if( $_SESSION['privilegio_Ser']==1){ ?>
                    <a href="javascript:void(0);" class="nav-btn-submenu"><i class="fas fa-tag fa-fw"></i> &nbsp; Categorías <i class="fas fa-chevron-down"></i></a>
                    <ul>
                        <li>
                            <a href="<?php echo SERVERURL.DASHBOARD; ?>/categoria-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; Nueva categoría</a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL.DASHBOARD; ?>/categoria-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de categorías</a>
                        </li>
                        <li>
                            <a href="<?php echo SERVERURL.DASHBOARD; ?>/categoria-search/"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar categoría</a>
                        </li>
                    </ul>
                    <?php  } ?>
                </li>
                <?php if( $_SESSION['privilegio_Ser']==1 || $_SESSION['privilegio_Ser']==2){ ?>
                <li>
                    <a href="javascript:void(0);" class="nav-btn-submenu"><i class="fas fa-box-open fa-fw"></i> &nbsp; Productos <i class="fas fa-chevron-down"></i></a>
                    <ul>
                    <?php if( $_SESSION['privilegio_Ser']==1 ){ ?>
                        <li>
                            <a href="<?php echo SERVERURL.DASHBOARD; ?>/product-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; Agregar producto</a>
                        </li>
                        <?php  } ?>
                        <li>
                            <a href="<?php echo SERVERURL.DASHBOARD; ?>/product-list/"><i class="fas fa-boxes fa-fw"></i> &nbsp; Inventario de productos</a>
                        </li>
                     
                        <li>
                            <a href="<?php echo SERVERURL.DASHBOARD; ?>/product-search/"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar producto</a>
                        </li>
                    </ul>
                </li>      
                <?php  } ?>
            
           
                <li>
                <?php if( $_SESSION['privilegio_Ser']==1 ){ ?>
                    <a href="javascript:void(0);" class="nav-btn-submenu"><i class="far fa-image"></i> &nbsp;  imagen portada<i class="fas fa-chevron-down"></i></a>
                    <ul>
                 
                        <li>
                        <a href="<?php echo SERVERURL.DASHBOARD; ?>/portada/"><i class="fas fa-plus fa-fw"></i> &nbsp;  Agregar Imagen</a>
                        </li>
                    
                        <li>
                            <a href="<?php echo SERVERURL.DASHBOARD; ?>/portadal-ist/"><i class="far fa-image"></i> &nbsp; Lista de Imagen</a>
                        </li>
                      
                        
                     
                    </ul>
                </li>      
                <?php  } ?>
                <li>      
                     
                                <a href="#" class="nav-btn-submenu"><i class="fas fa-cog fa-fw"></i> &nbsp; Configuracion  <i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <li>
                                
                                        <a href="<?php echo SERVERURL.DASHBOARD; ?>/empresa/"><i class="fas fa-store-alt fa-fw"></i> &nbsp;  Empresa</a>
                                    
                                        </li>
                                      
                                    
                                    </li>

                                    <li>                                
                                    
                                    <a href="<?php echo SERVERURL.DASHBOARD."/mi-cuenta/".$Lc->encryption( $_SESSION['id_Ser']); ?>/" title="Cuenta" > <i class="fas fa-user-cog"></i> &nbsp; Mi Cuenta
                                 
                                    </a>  
                                </li>
                          
                                </ul>
                        
                            <li>
            
                         
                          
                            </li>
                         
                          
                        
                    </nav>
                </div>
            </section>
