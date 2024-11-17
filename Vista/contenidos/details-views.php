<div class="full-box bg-white">
    <div class="container container-web-page">
        <h3 class="font-weight-bold poppins-regular text-center">Detalles del producto</h3>
        <hr>
        <div class="container-fluid">
            <div class="row">
                <?php
                   
                    
                    $datos_producto=$Lc->datos_tabla("Unico","producto","producto_id",$pagina[1]);
                    if($datos_producto->rowCount()==1){
                        $campos=$datos_producto->fetch();
                        $total_price=$campos['producto_precio_venta']-($campos['producto_precio_venta']*($campos['producto_descuento']/100));
                ?>
                <div class="product-list mb-12" style="padding-top: 50px;">
                            <div class="product-list-img">
                    <figure class="full-box">
                        <?php if(is_file("./Vista/assets/product/cover/".$campos['producto_portada'])){ ?>
                            <img class="img-fluid" src="<?php echo SERVERURL."Vista/assets/product/cover/".$campos['producto_portada']; ?>" alt="<?php echo $campos['producto_nombre']; ?>">
                        <?php }else{ ?>
                            <img class="img-fluid" src="<?php echo SERVERURL; ?>Vista/assets/product/cover/default.jpg" alt="<?php echo $campos['producto_nombre']; ?>">
                        <?php } ?>
                    </figure>
                </div>
                <div class="product-list-body">
                              
                              <div class="container-fluid" style="padding-top: 10px;">
                                  <div class="row">
                                  <div class="col-6 col-lg-4 mb-2">
                                  <strong class="text-center"><i class="fas fa-barcode fa-fw"></i> Código:</strong><?php echo $campos['producto_codigo']; ?></h4>
                                  </div>
                                        
                                  <div class="col-6 col-lg-4 mb-2">
                            <strong class="text-center"><i class="far fa-address-card fa-fw"></i> Nombre:</strong> <?php echo $campos['producto_nombre']; ?>
                            </div>
                            <div class="col-6 col-lg-4 mb-2">
                            <strong class="text-center"><i class="fas fa-dollar-sign fa-fw"></i> Precio:</strong> <?php echo COIN_SYMBOL.number_format($total_price,COIN_DECIMALS,COIN_SEPARATOR_DECIMAL,COIN_SEPARATOR_THOUSAND).' '.COIN_NAME; ?>
                            </div>
                            <div class="col-6 col-lg-4 mb-2">
                            <strong class="text-center"><i class="fa-duotone fa-percent fa-fw"></i> Decuento:</strong> &nbsp: <?php echo $campos['producto_descuento'] .COIN_SYMBOLO; ?> Descuento
                            </div>
                            <div class="col-6 col-lg-4 mb-2">
                            <strong class="text-center"><i class="fas fa-box fa-fw"></i> Estado:</strong> <?php if($campos['producto_tipo']=="Fisico"){ echo $campos['producto_estado']; }else{ echo "Disponible"; } ?>
                            </div>
                           
                            <div class="col-6 col-lg-4 mb-2">
                            <strong class="text-center"><i class="fas fa-clipboard-list fa-fw"></i> Disponibilidad:</strong></strong> &nbsp: <?php echo $campos['producto_disponibilidad']; ?>
                            </div>
                         
                              <div class="col-6 col-lg-4 mb-2">
                            <strong class="text-center"><i class="far fa-comment-dots fa-fw"></i> Descripcion:</strong> <?php echo $campos['producto_descripcion']; ?>
                            </div>
                            <div class="col-6 col-lg-4 mb-2">
                            <strong class="text-center"><i class="far fa-registered fa-fw"></i> Fabricante:</strong>  <?php echo $campos['producto_marca']; ?>
                            </div>
                            <div class="col-6 col-lg-4 mb-2">
                            <strong class="text-center"><i class="fas fa-tag fa-fw"></i> Categloria:</strong>  <?php echo $campos['categoria_id']; ?>
                
                            
                   

                 
                  
                    </div>
                    </div>
                    
                    <!-- Agregar al carrito -->
                    <form action="" style="padding-top: 50px;">
                        <div class="container-fluid">
                          
                        <div class="col-12 col-md-12">
    									<div class="form-group">
                                        <input type="number" value="1" class="form-control text-center" id="product_cant" pattern="[0-9]{1,10}" maxlength="10" >
                                        <label for="product_cant" class="form-label">Cantidad</label>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-12 text-center">
                                <button type="reset" class="btn btn-raised btn-secondary "><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
                                <button type="submit" class="btn btn-raised btn-info"><i class="fas fa-shopping-bag fa-fw"></i> &nbsp; Agregar al carrito</button>
                                </div>
                            </div>
                        
                 
    

                <?php
                    $datos_galeria=$Lc->datos_tabla("Normal","imagen WHERE producto_id='".$campos['producto_id']."'","*",0);

                    if($datos_galeria->rowCount()>0){
                ?>
                <div class="col-12">
                    <h5 class="poppins-regular text-uppercase" style="padding-top: 70px;">Galería de imágenes</h5>
                    <hr>
                    <div class="galery-details full-box">
                        
                        <?php while($campos_galeria=$datos_galeria->fetch()){ ?>
                        <figure class="full-box">
                            <?php if(is_file("./Vista/assets/product/gallery/".$campos_galeria['imagen_nombre'])){ ?>
                            <a data-fslightbox="gallery" href="<?php echo SERVERURL; ?>Vista/assets/product/gallery/<?php echo $campos_galeria['imagen_nombre']; ?>">
                                <img class="img-fluid" src="<?php echo SERVERURL; ?>Vista/assets/product/gallery/<?php echo $campos_galeria['imagen_nombre']; ?>" alt="<?php echo $campos['producto_nombre']; ?>">
                            </a>
                            <?php }else{ ?>
                            <a data-fslightbox="gallery" href="<?php echo SERVERURL; ?>Vista/assets/product/gallery/default.jpg">
                                <img class="img-fluid" src="<?php echo SERVERURL; ?>Vista/assets/product/gallery/default.jpg" alt="<?php echo $campos['producto_nombre']; ?>">
                            </a>
                            <?php } ?>
                        </figure>
                        <?php } ?>
    
                    </div>
                </div>
                <script src="<?php echo SERVERURL; ?>Vista/js/fslightbox.js"></script>
                <?php 
                        }
                    }else{ include "./Vista/inc/".LANG."/error_alert.php";}
                ?>
            </div>
        </div>
    </div>
</div>