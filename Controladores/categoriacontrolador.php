<?php

if($peticionAjax){
    require_once "../Modelo/categoriaModelo.php";
}else{
    require_once "./Modelo/categoriaModelo.php";

}

class categoriaControlador extends categoriaModelo{

    
	public function agregar_categoria_controlador(){

       
            /*-- Recibiendo datos del formulario - Receiving form data --*/
            $nombre=mainModelo::limpiar_cadena($_POST['categoria_nombre_reg']);
            $estado=mainModelo::limpiar_cadena($_POST['categoria_estado_reg']);
            $descripcion=mainModelo::limpiar_cadena($_POST['categoria_descripcion_reg']);

            /*-- Comprobando campos vacios - Checking empty fields --*/
            if($nombre=="" ){
                $alerta=[
					"Alerta"=>"simple", 
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No has llenado todos los campos que son obligatorios",
                    "Icono"=>"error"
                    
				];
				echo json_encode($alerta);
				exit();
            }

            /*-- Verificando integridad de los datos - Checking data integrity --*/
            if(mainModelo::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,49}",$nombre)){
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
                if(mainModelo::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\s ]{4,700}",$descripcion)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Formato no valido",
                        "Texto"=>"La descripcion no coincide con el formato solicitado. Solo se permiten caracteres alfanuméricos y los siguientes símbolos: () . , #",
                        "Icono"=>"error"
                      
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }

            /*-- Comprobando estado de categoria - Checking category status --*/
			if($estado!="Habilitada" && $estado!="Deshabilitada"){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Opción no valida",
					"Texto"=>"Ha seleccionado un ESTADO DE CATEGORÍA no valido",
                    "Icono"=>"error"
                  
				];
				echo json_encode($alerta);
				exit();
            }

        

            /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
			$datos_categoria_reg=[
				"NOMBRE"=>$nombre,
				"Estado"=>$estado,
                "Descripcion"=>$descripcion
                
            ];

			$agregar_categoria=categoriaModelo::agregar_categoria_modelo($datos_categoria_reg);         
			if($agregar_categoria->rowCount()==1){
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Titulo"=>"¡Categoria registrado!",
                    "Texto"=>"Los datos de la categoria se registraron con éxito",
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
        echo json_encode($alerta);

        }	
        
        /*--------- Controlador paginador categorias - categories Pager Controller ---------*/
        public function paginador_categoria_controlador($pagina,$registros,$url,$busqueda){
            $pagina=mainModelo::limpiar_cadena($pagina);
			$registros=mainModelo::limpiar_cadena($registros);

			$url=mainModelo::limpiar_cadena($url);
			$url=SERVERURL.DASHBOARD."/".$url."/";

            $busqueda=mainModelo::limpiar_cadena($busqueda);
			$tabla="";

			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
            
            if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM categoria WHERE (categoria_nombre LIKE '%$busqueda%') ORDER BY categoria_nombre ASC LIMIT $inicio,$registros";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM categoria ORDER BY categoria_nombre ASC LIMIT $inicio,$registros";
			}

			$conexion = mainModelo::conectar();

			$datos = $conexion->query($consulta);

			$datos = $datos->fetchAll();

			$total = $conexion->query("SELECT FOUND_ROWS()");
			$total = (int) $total->fetchColumn();

            $Npaginas =ceil($total/$registros);
            
            /*-- Encabezado de la tabla - Table header --*/
			$tabla.='
            <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr class="text-center font-weight-bold">
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>';

            if($total>=1 && $pagina<=$Npaginas){
				$contador=$inicio+1;
				$pag_inicio=$inicio+1;
				foreach($datos as $rows){
					$tabla.='
						<tr class="text-center" >
							<td>'.$contador.'</td>
							<td>'.$rows['categoria_nombre'].'</td>
							<td>'.$rows['categoria_estado'].'</td>
	<td><a class="btn btn-link text-success" href="'.SERVERURL.DASHBOARD.'/categoria-update/'.mainModelo::encryption($rows['categoria_id']).'/"><i class="btn btn-success">
    <i class="fas fa-sync-alt"></i>	
    </i></a></td>
    
    
							<td>
                                <form class="FormularioAjax" action="'.SERVERURL.'ajax/categoriaAjax.php" method="POST" data-form="delete"  >
                                 
									<input type="hidden" name="categoria_id_del" value="'.mainModelo::encryption($rows['categoria_id']).'">
                                    
									<button type="submit" class="btn btn-warning">  <i class="far fa-trash-alt"></i></i></button>
								</form>
							
						</tr>
					';
					$contador++;
				}
				$pag_final=$contador-1;
			}else{
				if($total>=1){
					$tabla.='
						<tr class="text-center" >
							<td colspan="5">
								<a href="'.$url.'" class="btn btn-primary btn-sm">
									Haga clic acá para recargar el listado
								</a>
							</td>
						</tr>
					';
				}else{
					$tabla.='
						<tr class="text-center" >
							<td colspan="5">
								No hay registros en el sistema
							</td>
						</tr>
					';
				}
			}

            $tabla.='</tbody></table></div>';

			if($total>0 && $pagina<=$Npaginas){
				$tabla.='<p class="text-end">Mostrando categorías <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
			}

			/*--Paginacion - Pagination --*/
			if($total>=1 && $pagina<=$Npaginas){
				$tabla.=mainModelo::paginador_tablas($pagina,$Npaginas,$url,7);
			}

			return $tabla;
        } /*-- Fin controlador - End controller --*/

	
    
                ///ELIMINAR CATEGORIA//
                public function eliminar_categoria_controlador(){

                    $id=mainModelo::decryption($_POST['categoria_id_del']);
                    $id=mainModelo::limpiar_cadena($id);
                    /*-- comprobando el delyvery--*/
                    if($id==0){
                        $alerta=[
                            "Alerta" => "simple",
                            "Titulo" =>"Ocurrio un error",
                            "Texto" =>" No podemos eliminar la categoria del sistema",
                            "Icono"  =>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                        }
                        $check_categoria=mainModelo::ejecutar_consulta_simple("SELECT categoria_id FROM categoria WHERE  categoria_id='$id'" );
                        if($check_categoria->rowCount()<=0){
                            $alerta=[
                                "Alerta" => "simple",
                                "Titulo" =>"Ocurrio un error",
                                "Texto" =>"La categoria que intentas eliminar no existe en el sistema",
                                "Icono"  =>"error"
                            ];
                            echo json_encode($alerta);
                            exit();
    
                        }
                          /*-- Comprobando productos - Checking products --*/
			$check_producto=mainModelo::ejecutar_consulta_simple("SELECT categoria_id FROM producto WHERE categoria_id='$id' LIMIT 1");
			if($check_producto->rowCount()>0){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No podemos eliminar la categoría debido a que tiene productos asociados, recomendamos deshabilitar esta categoría si ya no será usada en el sistema",
                    "Icono"=>"error"
                 
				];
				echo json_encode($alerta);
				exit();
			}
                  
                session_start(['name'=>'Ser']);
                if($_SESSION['privilegio_Ser']!=1){
                    $alerta=[
                        "Alerta" => "simple",
                        "Titulo" =>"Ocurrio un error",
                        "Texto" =>" No tienes los permisos necesarios para realizar esta operacion",
                        "Icono"  =>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
                $eliminar_categoria=categoriaModelo::eliminar_categoria_modelo($id);
                if($eliminar_categoria->rowCount()==1){
                    $alerta=[
                        "Alerta" => "recargar",
                        "Titulo" =>"Categoria eliminado",
                        "Texto" =>"Categoria  a sido eliminada del sistema exitosamente",
                        "Icono"  =>"success"
                    ];
    
                }else{
                    $alerta=[
                        "Alerta" => "simple",
                        "Titulo" =>"Ocurrio un error",
                        "Texto" =>" No hemos podido eliminar la categoria, por favor intente nuevamente",
                        "Icono"  =>"error"
                    ];
    
                }
                echo json_encode($alerta);
    
                }   
                  //conteo para mostrar en el menu los categoria egistrados//
            public function datos_categoria_controlador($tipo,$id){
                $tipo=mainModelo::limpiar_cadena($tipo);
    
                $id=mainModelo::decryption($id);
                $id=mainModelo::limpiar_cadena($id);
    
                return categoriaModelo::datos_categoria_modelo($tipo,$id);
            }
                 /*----------  controlador actualizar _categoria ----------*/
                 public function actualizar_categoria_controlador(){

                    //recibiendo datos el id//
                    $id=mainModelo::decryption($_POST['categoria_id_up']);
                    $id=mainModelo::limpiar_cadena($id);
            
                    //comprobar el usuario de la BD//
                    $check_categoria=mainModelo::ejecutar_consulta_simple("SELECT * FROM categoria WHERE categoria_id='$id'");
            
                    if($check_categoria->rowCount()<=0){
                        $alerta=[
                            "Alerta" => "simple",
                            "Titulo"  =>"Ocurrió un error inesperado",
                            "Texto"   =>"No hemos encontrado la categoria en el sistema",
                            "Icono"  =>"error"
                        
                        ];
                        echo json_encode($alerta);
                        exit();
                    }else{
                    $campos=$check_categoria->fetch();
            
                        }
                        
                
                    $nombre=mainModelo::limpiar_cadena($_POST['categoria_nombre_up']);
                    $descripcion=mainModelo::limpiar_cadena($_POST['categoria_descripcion_up']);
                                 
                   
                    //comprobar el estado de la cuenta//
            
                        if(isset($_POST['categoria_estado_up'])){
                            $estado=mainModelo::limpiar_cadena($_POST['categoria_estado_up']);
                        }else{
                            $estado=$campos['categoria_estado'];
            
                        }
                       
                      
                        /*-- Comprobando campos vacios  --*/
                        if($descripcion=="" )
                        {
                            $alerta=[
                                "Alerta" => "simple",
                                "Titulo"  =>"Ocurrió un error inesperado",
                                "Texto"   =>"No has llenado todos los campos que son obligatorios",
                                "Icono"  =>"error"
                                
                            ];
                            echo json_encode($alerta);
                            exit();
                        }
            
                     
            
                    if(mainModelo::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,49}" ,$nombre)){
                            $alerta=[
                                "Alerta" => "simple",
                                "Titulo" =>"Ocurrió un error inesperado",
                                "Texto" =>"El Nombre  no coincide con el formato solicitado",
                                "Icono"  =>"warning"
                                
                            ];
                            echo json_encode($alerta);
                            exit();
                        }
                      
                             
                    
                    
                    /*-- preparando datos apra enviar datos a modelo--*/
                    $datos_categoria_up=[
                        "NOMBRE"=>$nombre,
                        "Estado"=>$estado,
                        "Descripcion"=>$descripcion,
                        "ID"=>$id
                    ];
            
                    if(categoriaModelo::actualizar_categoria_modelo($datos_categoria_up)){
                        $alerta=[
                            "Alerta" => "recargar",
                            "Titulo" =>"¡Actualizado!",
                            "Texto" =>"Datos han sido actualizado con exito",
                            "Icono"  =>"success"
                        ];
                        
                    }else{
                        $alerta=[
                            "Alerta" => "simple",
                            "Titulo" =>"Ocurrió un error inesperado",
                            "Texto" =>"No hemos podido actualizar los datos por favor intente nuevamente",
                            "Icono"  =>"error"
                        ];
                    
                    }
                    echo json_encode($alerta);
            
                    }	 
            
                    }
            
                
        


      
    