<?php

if($peticionAjax){
    require_once "../Modelo/mainModelo.php";
}else{
    require_once "./Modelo/mainModelo.php";
}


	class portadaControlador extends mainModelo{

        /*--------- Controlador registrar portada - Controller register product ---------*/
        public function registrar_portada_controlador(){

            $nombre=mainModelo::limpiar_cadena($_POST['image_nombre_reg']);

             $descripcion=mainModelo::limpiar_cadena($_POST['image_descripcion_reg']);



       
           

            /*-- Comprobando campos vacios - Checking empty fields --*/
            if($nombre==""  ){
                $alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No has llenado todos los campos que son obligatorios",
                    "Icono"=>"error"
                    
				];
				echo json_encode($alerta);
				exit();
            }


            if(mainModelo::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\- ]{1,97}",$nombre)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Formato no valido",
					"Texto"=>"El NOMBRE no coincide con el formato solicitado",
                    "Icono"=>"error"
                   
				];
				echo json_encode($alerta);
				exit();
            }


            /*-- Directorios de imagenes - Image Directories --*/
			$img_dir='../Vista/assets/product/cover/';

            /*-- Comprobando si se ha seleccionado una imagen - Checking if an image has been selected --*/
            if($_FILES['image_portada']['name']!="" && $_FILES['image_portada']['size']>0){

                /*-- Comprobando formato de las imagenes - Checking image format --*/
                if(mime_content_type($_FILES['image_portada']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['producto_portada']['tmp_name'])!="image/png"){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Formato no valido",
                        "Texto"=>"El FORMATO DE LA IMAGEN que acaba de seleccionar no está permitido.",
                        "Icono"=>"error"
                      
                    ];
                    echo json_encode($alerta);
                    exit();
                }

                /*-- Comprobando que la imagen no supere el peso permitido - Checking that the image does not exceed the allowed weight --*/
                $img_max_size=COVER_PRODUCT*1024;
                if(($_FILES['image_portada']['size']/1024)>$img_max_size){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Tamaño excedido",
                        "Texto"=>"El tamaño de la imagen supera el límite de peso máximo que son ".COVER_PRODUCT."MB.",
                        "Icono"=>"error"
                     
                    ];
                    echo json_encode($alerta);
                    exit();
                }

                /*-- Extencion de las imagenes - extension of the images --*/
                switch(mime_content_type($_FILES['image_portada']['tmp_name'])) {
					case 'image/jpeg':
						$img_ext=".jpg";
					break;
					case 'image/png':
						$img_ext=".png";
					break;
				}

                /*-- Cambiando permisos al directorio - Changing permissions to the directory --*/
                chmod($img_dir, 0777);

                /*-- Generando un codigo para la imagen - Generating a code for the image --*/
                $correlativo=mainModelo::ejecutar_consulta_simple("SELECT image_id FROM portada");
                $correlativo=($correlativo->rowCount())+1;
                $codigo_img=mainModelo::generar_codigo_aleatorio(10,$correlativo);

                /*-- Nombre final de la imagen - Final image name --*/
                $img_portada=$codigo_img.$img_ext;

                /* Moviendo imagen al directorio - Moving image to directory */
                if(!move_uploaded_file($_FILES['image_portada']['tmp_name'], $img_dir.$img_portada)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Error al cargar archivos",
                        "Texto"=>"No podemos subir la imagen al sistema en este momento, por favor intente nuevamente.",
                        "Icono"=>"error"
                        
                    ];
                    echo json_encode($alerta);
                    exit();
                }

            }else{
                $img_portada="";
            }

            /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
            $datos_portada_reg=[
                     "image_nombre"=>[
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				],
                "image_descripcion"=>[
					"campo_marcador"=>":Descripcion",
					"campo_valor"=>$descripcion
				],
                "image_portada"=>[
					"campo_marcador"=>":Portada",
                    "campo_valor"=>$img_portada
                ],
                "image_estado"=>[
					"campo_marcador"=>":Estado",
                    "campo_valor"=>"Habilitada"
                ]
				
            ];

            /*-- Guardando datos del producto - Saving product data --*/
			$agregar_portada=mainModelo::guardar_datos("portada",$datos_portada_reg);

			if($agregar_portada->rowCount()==1){
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Titulo"=>"¡Portada registrado!",
                    "Texto"=>"Los datos de imagen de la portada se registraron con éxito",
                    "Icono"=>"success"
                    
                ];
			}else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"No hemos podido registrar los datos, por favor intente nuevamente",
                    "Icono"=>"error"
                  
                ];
			}

			$agregar_portada->closeCursor();
			$agregar_portada=mainModelo::desconectar($agregar_portada);

			echo json_encode($alerta);
        } 
         /*--------- Controlador paginador productos (administrador) - Product Pager Controller (admin) ---------*/
         public function portada_paginador_controlador($pagina,$registros,$url,$busqueda){
            $pagina=mainModelo::limpiar_cadena($pagina);
			$registros=mainModelo::limpiar_cadena($registros);

			$url=mainModelo::limpiar_cadena($url);

            $tipo_lista=["poertada-search","portadal-ist"];

			if(!in_array($url, $tipo_lista)){
				return '
                    <div class="alert alert-danger text-center" role="alert" data-mdb-color="danger">
                        <p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
                        <h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
                        <p class="mb-0">Lo sentimos, no podemos realizar la búsqueda ya que al parecer a ingresado un dato incorrecto.</p>
                    </div>
				';
				exit();
			}else{
				$tipo=$url;
			}

            $busqueda=mainModelo::limpiar_cadena($busqueda);
			$tabla="";

            if($tipo=="portadal-ist"){
                $url=SERVERURL.DASHBOARD."/".$url."/".$busqueda."/";
			}else{
                $url=SERVERURL.DASHBOARD."/".$url."/";
			}

			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;

            $campos="*";
            
            if(isset($busqueda) && $busqueda!="" && $tipo=="portada-search"){
				$consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM portada WHERE image_id LIKE '%$busqueda%' OR image_estado LIKE '%$busqueda%'   ORDER BY image_nombre  ASC LIMIT $inicio,$registros";
			}elseif($tipo=="portadal-ist"){
				$consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM portada ORDER BY image_nombre ASC LIMIT $inicio,$registros";
					}

			$conexion = mainModelo::conectar();

			$datos = $conexion->query($consulta);

			$datos = $datos->fetchAll();

			$total = $conexion->query("SELECT FOUND_ROWS()");
			$total = (int) $total->fetchColumn();

            $Npaginas =ceil($total/$registros);

            if($total>=1 && $pagina<=$Npaginas){
				$contador=$inicio+1;
				$pag_inicio=$inicio+1;
				foreach($datos as $rows){

                    $total_price=$rows['image_id']-($rows['image_id']);

					$tabla.='
                        <div class="product-list mb-12">
                            <div class="product-list-img">
                                <figure>';
                                if(is_file("./Vista/assets/product/cover/".$rows['image_portada'])){
                                    $tabla.='<img src="'.SERVERURL.'Vista/assets/product/cover/'.$rows['image_portada'].'" class="img-fluid" alt="'.$rows['image_id'].'" />';
                                }else{
                                    $tabla.='<img src="'.SERVERURL.'Vista/assets/product/cover/default.jpg" class="img-fluid" alt="'.$rows['image_portada'].'" />';
                                }
                                $tabla.='</figure>
                            </div>
                            <div class="portadal-ist-body">
                              
                                <div class="container-fluid" style="padding-top: 50px;">
                                    <div class="row">
                                    
                                   
                                        <div class="col-6 col-lg-4 mb-2">
                                        <strong class="text-center"><i class="far fa-address-card fa-fw"></i> Nombre:</strong> '.$rows['image_nombre'].'
                                    </div>
                                   
                                 
                                    <div class="col-6 col-lg-4 mb-2">
                                    <strong class="text-center"><i class="fas fa-box fa-fw"></i>  imagen id:</strong> '.$rows['image_id'].' 
                                </div>
                                <div class="col-6 col-lg-4 mb-2">
                                <strong class="text-center"><i class="fas fa-box fa-fw"></i> Estado:</strong> '.$rows['image_estado'].' 
                            </div>
                                <div class="col- col-lg-4 mb-2">
                                <strong class="text-lef"><i class="far fa-comment-dots fa-fw"></i> Descripcion:</strong> '.$rows['image_descripcion'].'
                                </div>
                            
                                </div>
                            </div>
                                <div class="full-box text-end">
                                <div class="btn-group shadow-10">
                                    <button type="button" class="btn btn-link dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false" ><i class="fas fa-tools"></i> &nbsp; Opciones</button>
                                    <ul class="dropdown-menu">
                                        ';

                                        if( $_SESSION['privilegio_Ser']==1){
                                            $tabla.='<li>
                                                <a class="dropdown-item" href="'.SERVERURL.DASHBOARD.'/portada-cover/'.mainModelo::encryption($rows['image_id']).'/" >
                                                    <i class="far fa-image"></i> &nbsp; Actualizar foto
                                                </a>
                                            </li>
                                            
                                            <li>
                                            <a class="dropdown-item" href="'.SERVERURL.DASHBOARD.'/portada-update/'.mainModelo::encryption($rows['image_id']).'/" >
                                            <i class="fas fa-sync-alt"></i> &nbsp; Actualizar 
                                        </a>
                                    </li>
                                    
                                            <li><hr class="dropdown-divider" /></li>
                                            <li>
                                            
                                                <form class="FormularioAjax" action="'.SERVERURL.'ajax/portadaAjax.php" method="POST" data-form="delete"  >
                                                    <input type="hidden" name="modulo_portada" value="eliminar">
                                                    <input type="hidden" name="image_id_del" value="'.mainModelo::encryption($rows['image_id']).'">
                                                    <button type="submit" class="abtn-raised btn-danger" >
                                                        <i class="far fa-trash-alt"></i> &nbsp; Eliminar
                                                    </button>
                                                </form>
                                            </li>';
                                        }

                                    $tabla.='</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
					$contador++;
				}
				$pag_final=$contador-1;
			}else{
				if($total>=1){
                    $tabla.='
                        <div class="list-group">
                            <a href="'.$url.'" class="list-group-item text-center list-group-item-action  active">
                                <h5 class="mb-4 text-center">Haga clic acá para recargar el listado</h5>
                                <p><i class="fas fa-boxes fa-fw fa-5x"></i></p>
                                <p class="mb-1">
                                    Haga clic para listar nuevamente  imagen  que estan registrados en el sistema
                                </p>
                            </a>
                        </div>
					';
				}else{
					$tabla.='
                        <div class="list-group">
                            <div class="list-group-item text-center list-group-item-action">
                                <h5 class="mb-4 text-center">No hay  imagen  en inventario</h5>
                                <p><i class="fas fa-broadcast-tower fa-fw fa-5x"></i></p>
                                <p class="mb-1">
                                    No hemos encontrado una imagen  registrada en el sistema
                                </p>
                            </div>
                        </div>
					';
				}
			}

			if($total>0 && $pagina<=$Npaginas){
				$tabla.='<hr><p class="text-end">Mostrando  imagen  <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
			}

			/*--Paginacion - Pagination --*/
			if($total>=1 && $pagina<=$Npaginas){
				$tabla.=mainModelo::paginador_tablas($pagina,$Npaginas,$url,7,LANG);
			}

			return $tabla;
        } /*-- Fin controlador - End controller --*/
        /*---------- Controlador actualizar portada de producto----------*/




		public function actualizar_portada_image_controlador(){

            /*-- Recuperando id del portada - Retrieving product id --*/
    $id=mainModelo::decryption($_POST['image_id']);
    $id=mainModelo::limpiar_cadena($id);

    /*-- Comprobando portada en la DB - Checking product in DB --*/
    $check_portada=mainModelo::ejecutar_consulta_simple("SELECT * FROM portada WHERE image_id='$id'");
    if($check_portada->rowCount()<=0){
        $alerta=[
            "Alerta"=>"simple",
            "Titulo"=>"Ocurrió un error inesperado",
            "Texto"=>"No hemos encontrado el portada registrada en el sistema.",
            "Icono"=>"error"
        ];
        echo json_encode($alerta);
        exit();
    }else{
        $campos=$check_portada->fetch();
    }
    $check_portada->closeCursor();
    $check_portada=mainModelo::desconectar($check_portada);


    /*-- Comprobando si se ha seleccionado una imagen - Checking if an image has been selected --*/
    if($_FILES['image_portada']['name']=="" && $_FILES['image_portada']['size']<=0){
        $alerta=[
            "Alerta"=>"simple",
            "Titulo"=>"Ocurrió un error inesperado",
            "Texto"=>"Parece que no ha seleccionado una imagen.",
            "Icono"=>"error"
        
        ];
        echo json_encode($alerta);
        exit();
    }

    /*-- Comprobando formato de las imagenes - Checking image format --*/
    if(mime_content_type($_FILES['image_portada']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['image_portada']['tmp_name'])!="image/png"){
        $alerta=[
            "Alerta"=>"simple",
            "Titulo"=>"Formato no valido",
            "Texto"=>"El FORMATO DE LA IMAGEN que acaba de seleccionar no está permitido.",
            "Icono"=>"error"
         
        ];
        echo json_encode($alerta);
        exit();
    }

    /*-- Comprobando que la imagen no supere el peso permitido - Checking that the image does not exceed the allowed weight --*/
    $img_max_size=COVER_PRODUCT*1024;
    if(($_FILES['image_portada']['size']/1024)>$img_max_size){
        $alerta=[
            "Alerta"=>"simple",
            "Titulo"=>"Tamaño excedido",
            "Texto"=>"El tamaño de la imagen supera el límite de peso máximo que son ".COVER_PRODUCT."MB.",
            "Icono"=>"error"
         
        ];
        echo json_encode($alerta);
        exit();
    }

    /*-- Extencion de las imagenes - extension of the images --*/
    switch(mime_content_type($_FILES['image_portada']['tmp_name'])) {
        case 'image/jpeg':
            $img_ext=".jpg";
        break;
        case 'image/png':
            $img_ext=".png";
        break;
    }

    /*-- Nombre final de la imagen - Final image name --*/
    $codigo_img=mainModelo::generar_codigo_aleatorio(10,$id);
    $img_portada=$codigo_img.$img_ext;

    /*-- Directorios de imagenes - Image Directories --*/
    $img_dir='../Vista/assets/product/cover/';

    /*-- Cambiando permisos al directorio - Changing permissions to the directory --*/
    chmod($img_dir, 0777);

    /* Moviendo imagen al directorio - Moving image to directory */
    if(!move_uploaded_file($_FILES['image_portada']['tmp_name'], $img_dir.$img_portada)){
        $alerta=[
            "Alerta"=>"simple",
            "Titulo"=>"Error al cargar archivos",
            "Texto"=>"No podemos subir la imagen al sistema en este momento, por favor intente nuevamente.",
            "Icono"=>"error"
       
        ];
        echo json_encode($alerta);
        exit();
    }

    /* Eliminando la imagen anterior - Deleting the previous image */
    if(is_file($img_dir.$campos['image_portada'])){
        chmod($img_dir, 0777);
        unlink($img_dir.$campos['image_portada']);
    }

    /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
	$datos_portada_up=[
        "image_portada"=>[
            "campo_marcador"=>":Portada",
            "campo_valor"=>$img_portada
        ]
    ];

    $condicion=[
        "condicion_campo"=>"image_id",
        "condicion_marcador"=>":ID",
        "condicion_valor"=>$id
    ];

    if(mainModelo::actualizar_datos("portada",$datos_portada_up,$condicion)){
        $alerta=[
            "Alerta"=>"recargar",
            "Titulo"=>"¡Imagen actualizada!",
            "Texto"=>"La imagen de portada se actualizo con éxito",
            "Icono"=>"success"
          
        ];
    }else{

        if(is_file($img_dir.$img_portada)){
            chmod($img_dir, 0777);
            unlink($img_dir.$img_portada);
        }

        $alerta=[
            "Alerta"=>"simple",
            "Titulo"=>"Ocurrió un error inesperado",
            "Texto"=>"No hemos podido actualizar la imagen, por favor intente nuevamente",
            "Icono"=>"error"
         
        ];
    }
    echo json_encode($alerta);
} /*-- Fin controlador - End controller --*/



        /*---------- Controlador eliminar portadade portada  - Controller remove product cover ----------*/
		public function eliminar_portada_controlador(){      

			/*-- Recuperando id del portada - Retrieving portada  id --*/
			$id=mainModelo::decryption($_POST['image_id']);
			$id=mainModelo::limpiar_cadena($id);

			/*-- Comprobando portadaen la DB - Checking portada  in DB --*/
            $check_portada=mainModelo::ejecutar_consulta_simple("SELECT * FROM portada WHERE image_id='$id'");
            if($check_portada ->rowCount()<=0){
            	$alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"No hemos encontrado la imagen registrada en el sistema.",
                    "Icono"=>"error"
                   
                ];
				echo json_encode($alerta);
				exit();
            }else{
            	$campos=$check_portada->fetch();
			}
			$check_portada->closeCursor();
			$check_portada=mainModelo::desconectar($check_portada);

			/*-- Directorios de imagenes - Image Directories --*/
			$img_dir='../Vista/assets/product/cover/';

			/* Eliminando la imagen anterior - Deleting the previous image */
			if(is_file($img_dir.$campos['image_portada'])){
				chmod($img_dir, 0777);
				if(!unlink($img_dir.$campos['image_portada'])){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrió un error inesperado",
                        "Texto"=>"No hemos podido eliminar la imagen de portada por favor intente nuevamente.",
                        "Icon"=>"error"
                     
                    ];
					echo json_encode($alerta);
					exit();
				}
			}

			/*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
			$datos_portada_up=[
				"image_portada"=>[
					"campo_marcador"=>":Portada",
					"campo_valor"=>""
				]
			];

			$condicion=[
				"condicion_campo"=>"image_id",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

			if(mainModelo::actualizar_datos("portada",$datos_portada_up,$condicion)){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"¡Imagen eliminada!",
                    "Texto"=>"La imagen del portada se elimino con éxito.",
                    "Icono"=>"success"
                   
                ];
			}else{
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"¡Imagen eliminada!",
                    "Texto"=>"Hemos tratado de eliminar la imagen del portada , sin embargo, tuvimos algunos inconvenientes en caso de que la imagen no este eliminada por favor intente nuevamente.",
                    "Icono"=>"error"
                  
                ];
			}
			echo json_encode($alerta);
		} /*-- Fin controlador - End controller --*/



      


        /*--------- Controlador paginador portada (cliente) - Product Pager Controller (client) ---------*/
        public function cliente_paginador_image_controlador($pagina,$registros,$url,$orden,$portada,$busqueda){
            $pagina=mainModelo::limpiar_cadena($pagina);
			$registros=mainModelo::limpiar_cadena($registros);

			$url=mainModelo::limpiar_cadena($url);
            $orden=mainModelo::limpiar_cadena($orden);
            $portada=mainModelo::limpiar_cadena($portada);
            $busqueda=mainModelo::limpiar_cadena($busqueda);
            $url=SERVERURL.$url."/".$portada."/".$orden."/";
			$tabla="";


            /*-- Lista blanca para orden de busqueda - Whitelist for search order --*/
            $orden_lista=["ASC","DESC","MAX","MIN"];

			if(!in_array($orden, $orden_lista)){
				return '
                    <div class="alert alert-danger text-center" role="alert" data-mdb-color="danger">
                        <p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
                        <h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
                        <p class="mb-0">Lo sentimos, no podemos realizar la búsqueda de las imagenes  ya que al parecer a ingresado un dato incorrecto.</p>
                    </div>
				';
				exit();
			}

            /*-- Estableciendo orden de busqueda - Establishing search order --*/
            if($orden=="ASC" || $orden=="DESC"){
                $campo_orden="image_nombre $orden";
            }elseif($orden=="MAX" || $orden=="MIN"){
                if($orden=="MAX"){
                    $campo_orden="image_descripcion DESC";
                }else{
                    $campo_orden="image_estado ASC";
                }
            }else{
                $campo_orden="image_nombre ASC";
            }
             
            /*-- Comprobandoimagen de portada- Checking category --*/
            if($portada!="all"){
                $check_portada=mainModelo::ejecutar_consulta_simple("SELECT image_id FROM portada WHERE image_id='$portada' AND image_estado='Habilitada'");
                if($check_portada->rowCount()<=0){
                    return '
                        <div class="alert alert-danger text-center" role="alert" data-mdb-color="danger">
                            <p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
                            <h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
                            <p class="mb-0">Lo sentimos, no podemos realizar la búsqueda de productos ya que al parecer a ingresado una categoría incorrecta.</p>
                        </div>
                    ';
                    exit();
                }
                $check_portada->closeCursor();
                $check_portada=mainModelo::desconectar($check_portada);
            }

			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;


            $campos="*";
            
            if(isset($busqueda) && $busqueda!=""){
                if($portada!="all"){
                    $condicion_busqueda="image_id='$portada' AND";
                }else{
                    $condicion_busqueda="";
                }
				$consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM portada WHERE $condicion_busqueda image_estado='Habilitada' AND image_nombre LIKE '%$busqueda%' ORDER BY $campo_orden LIMIT $inicio,$registros";
			}elseif($portada!="all"){
				$consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM portada WHERE image_estado='Habilitada' ORDER BY $campo_orden LIMIT $inicio,$registros";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS $campos FROM portada WHERE image_estado='Habilitada'  ORDER BY $campo_orden LIMIT $inicio,$registros";
			}

			$conexion = mainModelo::conectar();

			$datos = $conexion->query($consulta);

			$datos = $datos->fetchAll();

			$total = $conexion->query("SELECT FOUND_ROWS()");
			$total = (int) $total->fetchColumn();

            $Npaginas =ceil($total/$registros);

            $tabla.='<div class="container-cards full-box">';

            if($total>=1 && $pagina<=$Npaginas){
				$contador=$inicio+1;
				$pag_inicio=$inicio+1;
				foreach($datos as $rows){

                 
					$tabla.='
                        <div class="card shadow-2-strong">
                        
                            <figure class="card-product-img" >';
                                if(is_file("./Vista/assets/product/cover/".$rows['image_portada'])){
                                    $tabla.='<img src="'.SERVERURL.'Vista/assets/product/cover/'.$rows['image_portada'].'" class="card-img-top" alt="'.$rows['image_nombre'].'" />';
                                }else{
                                    $tabla.='<img src="'.SERVERURL.'Vista/assets/product/cover/default.jpg" class="img-fluid" alt="'.$rows['image_nombre'].'" />';
                                }
                                $tabla.='</figure>
                                <div class="card-product-body">
                                    <div class="card-product-content scroll">
                                        <h5 class="text-center fw-bolder">'.mainModelo::limpiar_cadena($rows['image_nombre'],70,"...").'</h5>
                                       ';
                                      
                                            $tabla.='<span  class="full-box text-left fw-bolder" style="display: block;">Descripcion : '.$rows['image_descripcion'].'</span>';

                                            
                                        
                                        
                                    $tabla.='</div>
                                    </div>
                                     
                                    </div>
                             
                        ';
                        $contador++;
				}
				$pag_final=$contador-1;
			}else{
				if($total>=1){
                    $tabla.='
                        <div class="alert alert-default text-center" role="alert" data-mdb-color="danger">
                            <p><i class="fas fa-boxes fa-fw fa-5x"></i></p>
                            <h4 class="alert-heading">Haga clic en el botón para listar nuevamente los productos que están registrados en la tienda.</h4>
                            <a href="'.$url.'" class="btn btn-primary btn-rounded btn-lg" data-mdb-ripple-color="dark">Haga clic acá para recargar el listado</a>
                        </div>
					';
				}else{
					$tabla.='
                        <div class="alert alert-default text-center" role="alert" data-mdb-color="danger">
                            <p><i class="fas fa-broadcast-tower fa-fw fa-5x"></i></p>
                            <h4 class="alert-heading">¡No hay productos en inventario!</h4>
                            <p class="mb-0">No hemos encontrado productos registrados en la tienda.</p>
                            
                         
			
                          
                     
                        </div>
					';
				}
			}

            $tabla.='</div>';

			if($total>0 && $pagina<=$Npaginas){
				
			}

		

			return $tabla;
        } /*-- Fin controlador - End controller --*/




        /*--------- Controlador eliminar portada - Controller delete product ---------*/
        public function eliminar_image_controlador(){


            /*-- Recuperando id del portada - Retrieving product id - --*/
			$id=mainModelo::decryption($_POST['image_id_del']);
			$id=mainModelo::limpiar_cadena($id);

            /*-- Comprobando  portada en la BD - Checking  portada in DB --*/
			$check_portada=mainModelo::ejecutar_consulta_simple("SELECT * FROM  portada WHERE image_id='$id'");
			if($check_portada->rowCount()<=0){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Portada no encontrado",
					"Texto"=>"La imagen de portada que intenta eliminar no existe en el sistema",
                    "Icono"=>"error"
                  
				];
				echo json_encode($alerta);
				exit();
			}else{
            	$campos=$check_portada->fetch();
			}
			$check_portada->closeCursor();
			$check_portada=mainModelo::desconectar($check_portada);


			/* Eliminando la portada - Deleting cover */
			if(is_file('../Vista/assets/product/cover/'.$campos['image_portada'])){
				chmod('../Vista/assets/product/cover/', 0777);
				if(!unlink('../Vista/assets/product/cover/'.$campos['image_portada'])){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrió un error inesperado",
                        "Texto"=>"No hemos podido eliminar la imagen , por favor intente nuevamente.",
                        "Icono"=>"error"
                  
                    ];
					echo json_encode($alerta);
					exit();
				}
			}

            /*-- Eliminando portada - Deleting product --*/
			$eliminar_portada=mainModelo::eliminar_registro("portada","image_id",$id);

			if($eliminar_portada->rowCount()==1){
				$alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"¡Portada eliminada!",
                    "Texto"=>"La imagen ha sido eliminado del sistema exitosamente",
                    "Icono"=>"success"
                   
                ];
			}else{
				$alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"No hemos podido eliminar la imagen del sistema, por favor intente nuevamente",
                    "Icono"=>"error"
                  
                ];
			}

			$eliminar_portada->closeCursor();
			$eliminar_portada=mainModelo::desconectar($eliminar_portada);

			echo json_encode($alerta);
        } /*-- Fin controlador - End controller --*/



        
        
        /*--------- Controlador actualizar portada - Controller update product ---------*/
        public function actualizar_portada_controlador(){

            /*-- Recuperando id del portada - Retrieving product id - --*/
    $id=mainModelo::decryption($_POST['image_id_up']);
    $id=mainModelo::limpiar_cadena($id);

    /*-- Comprobando portada en la BD - Checking portada in DB --*/
    $check_portada=mainModelo::ejecutar_consulta_simple("SELECT * FROM portada WHERE image_id='$id'");
    if($check_portada->rowCount()<=0){
        $alerta=[
            "Alerta"=>"simple",
            "Titulo"=>"Datos no encontrados",
            "Texto"=>"Los datos que intenta actualizar no existe en el sistema",
            "Icono"=>"error"
         
        ];
        echo json_encode($alerta);
        exit();
    }else{
        $campos=$check_portada->fetch();
    }
    $check_portada->closeCursor();
    $check_portada=mainModelo::desconectar($check_portada);


   /*-- Recibiendo datos del formulario - Receiving form data --*/

   $nombre=mainModelo::limpiar_cadena($_POST['image_nombre_up']);

   $descripcion=mainModelo::limpiar_cadena($_POST['image_descripcion_up']);
   $estado=mainModelo::limpiar_cadena($_POST['image_estado_up']);


   if($nombre==""  ){
    $alerta=[
        "Alerta"=>"simple",
        "Titulo"=>"Ocurrió un error inesperado",
        "Texto"=>"No has llenado todos los campos que son obligatorios",
        "Icono"=>"error"
        
    ];
    echo json_encode($alerta);
    exit();
}

  
 
   if(mainModelo::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\- ]{1,97}",$nombre)){
    $alerta=[
        "Alerta"=>"simple",
        "Titulo"=>"Formato no valido",
        "Texto"=>"El NOMBRE no coincide con el formato solicitado",
        "Icono"=>"error"
       
    ];
    echo json_encode($alerta);
    exit();
}



   if($descripcion!=""){
       if(mainModelo::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\s ]{4,520}",$descripcion)){
           $alerta=[
               "Alerta"=>"simple",
               "Titulo"=>"Formato no valido",
               "Texto"=>"La DESCRIPCIÓN no coincide con el formato solicitado",
               "Icono"=>"error"
               
           ];
           echo json_encode($alerta);
           exit();
       }
   }


   /*-- Comprobando estado - Checking status --*/
   if($estado!="Habilitada" && $estado!="Deshabilitada"){
       $alerta=[
           "Alerta"=>"simple",
           "Titulo"=>"Opción no valida",
           "Texto"=>"Ha seleccionado un ESTADO de imagen no valido",
           "Icono"=>"error"
           
       ];
       echo json_encode($alerta);
       exit();
   }
 
     /*-- Comprobando nombre - Checking name --*/
     if($campos['image_nombre']!=$nombre){
        $check_nombre=mainModelo::ejecutar_consulta_simple("SELECT image_nombre FROM portada WHERE image_id='$id' AND image_nombre='$nombre'");
        if($check_nombre->rowCount()>0){
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"Ya existe una imagen  registrada con el mismo nombre.",
                "Icono"=>"error"
             
            ];
            echo json_encode($alerta);
            exit();
        }
        $check_nombre->closeCursor();
        $check_nombre=mainModelo::desconectar($check_nombre);
    }
       /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
       $datos_portada_up=[
            "image_nombre"=>[
            "campo_marcador"=>":Nombre",
            "campo_valor"=>$nombre
        ],
        "image_descripcion"=>[
            "campo_marcador"=>":Descripcion",
            "campo_valor"=>$descripcion
        ],
       
        "image_estado"=>[
            "campo_marcador"=>":Estado",
            "campo_valor"=>$estado
        ]
    
       
    ];


    $condicion=[
        "condicion_campo"=>"image_id",
        "condicion_marcador"=>":ID",
        "condicion_valor"=>$id
    ];

    if(mainModelo::actualizar_datos("portada",$datos_portada_up,$condicion)){
        $alerta=[
            "Alerta"=>"recargar",
            "Titulo"=>"¡Portada actualizado!",
            "Texto"=>"Los datos de imagen de portada se actualizaron con éxito en el sistema",
            "Icono"=>"success"
        
        ];
    }else{
        $alerta=[
            "Alerta"=>"simple",
            "Titulo"=>"Ocurrió un error inesperado",
            "Texto"=>"No hemos podido actualizar los datos de portada, por favor intente nuevamente",
            "Icono"=>"error"
        
        ];
    }
    echo json_encode($alerta);
} /*-- Fin controlador - End controller --*/
}


        
        