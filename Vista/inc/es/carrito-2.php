     
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="input_producto" class="bmd-label-floating">Nombre o codigo</label>
                                    <input type="text" pattern="[a-zA-z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="input_producto" id="input_producto" maxlength="30">
                                </div>
                                <button type="button" class="btn btn-raised btn-info" onclick="buscar_producto()"><i class="fas fa-search fa-fw"  ></i> &nbsp; Buscar</button>
                                
                            &nbsp; &nbsp;
                     
                        </button>
                        
                            </div>
                           
                            </div>
                            <br>
                            <div class="container-fluid" id="tabla_productos">
                                                             
                            </div>
                            
                                                     
                            








                           
            <!-- MODAL AGREGAR ITEM -->
            <div  class="modal fade" id="ModalAgregarItem" tabindex="-1" role="dialog" aria-labelledby="ModalAgregarItem" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form class="modal-content FormularioAjax" action="<?php echo SERVERURL; ?>ajax/carritoAjax.php"  method="POST" data-form="save" autocomplete="off">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalAgregarItem">Selecciona el formato, cantidad de items, tiempo y costo del préstamo del item</h5>
                          
                        </div>
                        <div class="modal-body" style="height: 180px;">
                            <input type="hidden" name="id_agregar_producto" id="id_agregar_producto">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="venta_cantidad" class="bmd-label-floating">Cantidad de producto</label>
                                         
                                            <input type="number" pattern="[0-9]{1,7}" class="form-control" name="venta_cantidad" id="venta_cantidad" value="0" required="" >
                                         
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="venta_hora" >Hora</label>
                                            <input type="time" pattern="[0-9]{1,7}" class="form-control" name="venta_hora" id="venta_hora"  required="" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="venta_fecha" >Fecha </label>
                                            <input type="date" pattern="[0-9]{1,7}" class="form-control" name="venta_fecha" id="venta_fecha" maxlength="7" required="" >
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="reset" class="btn btn-raised btn-secondary "><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
                        &nbsp; &nbsp;
                            <button type="submit" class="btn btn-raised btn-success "   ><i class="fas fa-box-open"> Agregar</i></button>
                            &nbsp; &nbsp;
                            <button type="button" class="btn btn-raised btn-info" onclick="modal_cancel_producto()" > <i class="fas fa-times fa-fw"></i> &nbsp;Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>