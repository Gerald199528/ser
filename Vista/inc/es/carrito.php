
    <a   data-toggle="modal" data-target="#ModalItem" class="header-button fulll-box text-center" style="left:40%;" title="Carrito"  >
                                                       
        <i class="fa-sharp fa-solid fa-cart-shopping"  >  </i> 


        </a>
		<div class="modal fade" id="ModalItem" tabindex="-1" role="dialog" aria-labelledby="ModalItem" aria-hidden="true">
                <div class="modal-dialog" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalItem">Agregar Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>    <br>
                                <?php
                        include "./Vista/inc/".LANG."/carrito-2.php";

                        ?>
    </br>




                            <div class="container-fluid" >
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered align-middle">
                                            <thead class="table-dark">
                                            <tr class="text-center roboto-medium">
                                                            <th>CODIGO</th>
                                                         
                                                            <th>CANTIDAD</th>
                                                            <th>PRECIO</th>
                                                            <th>FECHA</th>
                                                            <th>HORA</th>
                                                            <th>SUBTOTAL</th>
                                                            <th>DETALLE</th>
                                                            <th>ELIMINAR</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 

                                                        if(isset( $_SESSION['datos_producto']) && count($_SESSION['datos_producto'])>=1){
                                                    $_SESSION['producto_total']=0;
                                                    $_SESSION['producto_item']=0;

                                                    foreach( $_SESSION['datos_producto'] as $item){
                                                        $subtotal=$item['Cantidad']*($item['Venta']);
                                                     $subtotal=number_format($subtotal,2,'.','');
                                                    

                                                        ?>
                                                        <tr class="text-center" >
                                                            <td><?php echo $item['Codigo']; ?></td>                                                           
                                                           <td><?php echo $item['Cantidad']; ?></td>
                                                            <td><?php echo MONEDA.$item['Venta']; ?></td>
                                                            <td><?php echo $item['Fecha']; ?></td>
                                                            <td><?php echo $item['Hora']; ?></td>
                                                            <td><?php echo  MONEDA.$subtotal; ?></td>
                                                            <td>
                                                                <button type="button" class="btn btn-info" data-toggle="popover" data-trigger="hover" title="<?php echo $item['Nombre']; ?>" data-content="Detalle completo del item">
                                                                    <i class="fas fa-info-circle"></i>
                                                                </button>
                                                            </td>
                                                            <td>
                                                                <form class=" FormularioAjax" action="<?php echo SERVERURL; ?>ajax/carritoAjax.php"  method="POST" data-form="delete" autocomplete="off">
                                                                <input type="hidden" name="id_eliminar_producto" value="<?php   echo $item['ID']; ?> ">
                                                                    <button type="submit" class="btn btn-warning">
                                                                        <i class="far fa-trash-alt"></i>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                      <?php   
                                                      
                                                      $_SESSION['producto_total']+=$subtotal;
                                                      $_SESSION['producto_item']+=$item['Cantidad'];
                                                      
                                                       } 
                                                      
                                                      
                                                      ?>    
                                                       
                                                       <tr class="table table-hover table-bordered align-middle">                                                                                                            
                                                            <td><strong>TOTAL</strong></td>
                                                            <td><strong><?php echo $_SESSION['producto_item']; ?> en cola</strong></td>                                                  
                                                            
                                                            <td colspan="3"></td>                                                          
                                                            <td><?php echo  MONEDA.number_format($_SESSION['producto_total'],2,'.',''); ?></td>
                                                            
                                                            </tr>
                                                           
                                                     <?php 
                                                        }else{
                                                          

                                                     ?>

                                                    <tr class="text-center" >
                                                            <td colspan="7">No has seleccionado productos</td>
                                                            
                                                        </tr>            
                                                       <?php 
                                                       

                                                        }

                                                     ?>
                                                              </td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
         
                        <p class="text-center" style="margin-top: 40px;">
                        <a  href="<?php echo SERVERURL; ?>details/" class="btn btn-raised btn-info" ><i class="fas fa-box-open fa-fw"></i> &nbsp;Confirmar</a>
                        <button type="button" class="btn btn-raised btn-danger" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times fa-fw"></i> &nbsp; Cerrar</button>
                            </p>
                        </div>
                    </div>
                </div>
                
             
             </div>
    </div>





    
    <?php   include_once "./Vista/inc/venta.php"; ?>