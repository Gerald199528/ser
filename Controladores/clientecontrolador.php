<?php

if($peticionAjax){
    require_once "../Modelo/clienteModelo.php";
}else{
    require_once "./Modelo/clienteModelo.php";

}
	class clienteControlador extends clienteModelo{

    
        public function agregar_cliente_controlador(){

            /*-- Recibiendo datos del formulario - Receiving form data --*/
            $dni=mainModelo::limpiar_cadena($_POST['cliente_dni_reg']);
            $nombre=mainModelo::limpiar_cadena($_POST['cliente_nombre_reg']);
            $apellido=mainModelo::limpiar_cadena($_POST['cliente_apellido_reg']);
            $telefono=mainModelo::limpiar_cadena($_POST['cliente_telefono_reg']);
            $genero=mainModelo::limpiar_cadena($_POST['cliente_genero_reg']);

            $provincia=mainModelo::limpiar_cadena($_POST['cliente_provincia_reg']);
            $ciudad=mainModelo::limpiar_cadena($_POST['cliente_ciudad_reg']);
            $direccion=mainModelo::limpiar_cadena($_POST['cliente_direccion_reg']);

            $email=mainModelo::limpiar_cadena($_POST['cliente_email_reg']);
            $clave_1=mainModelo::limpiar_cadena($_POST['cliente_clave_1_reg']);
            $clave_2=mainModelo::limpiar_cadena($_POST['cliente_clave_2_reg']);
         
         

         

            /*-- Comprobando campos vacios - Checking empty fields --*/
            if($nombre=="" || $apellido=="" || $telefono=="" || $genero=="" || $provincia=="" || $ciudad=="" || $direccion=="" || $email=="" || $clave_1=="" || $clave_2=="" ){
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
            if(mainModelo::verificar_datos("[0-9-]{8,20}",$dni)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Formato no valido",
					"Texto"=>"El DNI no coincide con el formato solicitado",
                    "Icono"=>"error"
                   
				];
				echo json_encode($alerta);
				exit();
            }
            if(mainModelo::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}",$nombre)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Formato no valido",
					"Texto"=>"El NOMBRE no coincide con el formato solicitado",
                    "Icono"=>"error"
                   
				];
				echo json_encode($alerta);
				exit();
            }

            if(mainModelo::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}",$apellido)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Formato no valido",
					"Texto"=>"El APELLIDO no coincide con el formato solicitado",
                    "Icono"=>"error"
                    
				];
				echo json_encode($alerta);
				exit();
            }

            if(mainModelo::verificar_datos("[0-9()+]{8,20}",$telefono)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Formato no valido",
                    "Texto"=>"El TELÉFONO no coincide con el formato solicitado",
                    "Icono"=>"error"
                   
                ];
                echo json_encode($alerta);
                exit();
            }

            
         

            if(mainModelo::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,70}",$direccion)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Formato no valido",
                    "Texto"=>"La DIRECCIÓN no coincide con el formato solicitado",
                    "Icono"=>"error"
                  
                ];
                echo json_encode($alerta);
                exit();
            }

            if(mainModelo::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_1) || mainModelo::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_2)){
                $alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Formato no valido",
					"Texto"=>"Las CONTRASEÑAS no coincide con el formato solicitado",
                    "Icono"=>"error"
                    
				];
				echo json_encode($alerta);
				exit();
            }

  /*-- comprobar email--*/
  if( $email!=""){
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        $check_email=mainModelo::ejecutar_consulta_simple("SELECT cliente_email FROM  cliente WHERE cliente_email='$email'");
        if($check_email->rowCount()>0){
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Ocurrió un error inesperado",
                    "Texto" =>" El Correo ingresado ya se encuentra registrado en el sistema ",
                    "Icono"  =>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
    }else{
        $alerta=[
            "Alerta" => "simple",
            "Titulo" =>"Ocurrió un error inesperado",
            "Texto" =>" HA ingresado un correo no valido ingresa uno correcto ejemplo pedro_12@gmail.com ",
            "Icono"  =>"error"
        ];
        echo json_encode($alerta);
        exit();
                }
            }

            /*-- Comprobando claves - Checking passwords --*/
			if($clave_1!=$clave_2){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"Las contraseñas que acaba de ingresar no coinciden",
                    "Icono"=>"error"
                   
                ];
				echo json_encode($alerta);
				exit();
			}else{
				$clave=mainModelo::encryption($clave_1);
            }

           
          
          


            /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
			$datos_cliente_reg=[
                "DNI"=>$dni,
                "Nombre"=>$nombre,
                "Apellido"=>$apellido,
                "Telefono"=>$telefono,
                "Genero"=>$genero,
                "Provincia"=>$provincia,
                "Ciudad"=>$ciudad,
                "Direccion"=>$direccion,
                "Email"=>$email,
                "Clave"=>$clave,
                "Privilegio"=>"4",
                "Estado"=>"Activa"
             

			];

            /*-- Guardando datos del cliente - Saving client data --*/
			$agregar_cliente=clienteModelo::agregar_cliente_modelo($datos_cliente_reg);         
			if($agregar_cliente->rowCount()==1){
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Titulo"=>"¡Cliente registrado!",
                    "Texto"=>"Los datos del cliente se registraron con éxito",
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
         

    
    
    /*controlador paginar delyverys */
    public function paginador_cliente_controlador($pagina,$registros,$privilegio,$url,$busqueda){
        $pagina=mainModelo::limpiar_cadena($pagina);
        $registros=mainModelo::limpiar_cadena( $registros);
        $privilegio=mainModelo::limpiar_cadena($privilegio);
     
        $url=mainModelo::limpiar_cadena($url);
        $url=SERVERURL.DASHBOARD."/".$url."/";

        $busqueda=mainModelo::limpiar_cadena($busqueda);
        $tabla="";

        $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina: 1;
        $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0;

        if(isset($busqueda) && $busqueda!=""){
               /*controlador buscar delyverys "tener cuidado con las variables ya que si no estan correctamente definidas no se ejecutara la accion"  */
            $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM cliente WHERE cliente_dni LIKE '%$busqueda%' OR cliente_nombre LIKE '%$busqueda%' OR cliente_apellido LIKE '%$busqueda%' OR cliente_telefono LIKE '%$busqueda%' OR  cliente_genero LIKE '%$busqueda%' OR  cliente_provincia LIKE '%$busqueda%' OR  cliente_ciudad LIKE '%$busqueda%' OR  cliente_direccion LIKE '%$busqueda%' OR  cliente_email LIKE '%$busqueda%' OR  cliente_clave LIKE '%$busqueda%' OR  cliente_estado LIKE '%$busqueda%' ORDER BY cliente_nombre ASC LIMIT $inicio,$registros";
        }else{
            $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM cliente ORDER BY cliente_nombre ASC LIMIT $inicio,$registros";
                
        }
        $conexion = mainModelo::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();
        $Npaginas=ceil($total/$registros);

        $tabla.='
        <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr class="text-center font-weight-bold">
                                <th>#</th>
                                <th>CEDULA O RIF</th>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>TELÉFONO</th>
                                <th>GENERO</th>
                                <th>ESTADO</th>
                                <th>CIUDAD</th>
                                  <th>EMAIL</th> 
                                  <th>ESTATUS</th> 
                                 <th>DIRECCION</th>
                                                             
                                ';
                                if($privilegio==1 || $privilegio==2){
                              
                                    $tabla.='<th>ELIMINAR</th>';

                                    }         
                                
                            $tabla.='</tr>
                        </thead>
                        <tbody>';
                        if($total>=1 && $pagina<=$Npaginas){
                            $contador=$inicio+1;
                            $reg_inicio=$inicio+1;
                            foreach($datos as $rows){
                                $tabla.='
                                <tr class="text-center" >
                                <td>'.$contador.'</td>
                                <td>'.$rows['cliente_dni'].'</td>
                                <td>'.$rows['cliente_nombre'].'</td>
                                <td>'.$rows['cliente_apellido'].'</td>
                                 <td>'.$rows['cliente_telefono'].'</td>
                                 <td>'.$rows['cliente_genero'].'</td>
                                 <td>'.$rows['cliente_provincia'].'</td>
                                 <td>'.$rows['cliente_ciudad'].'</td>                               
                                 <td>'.$rows['cliente_email'].'</td>
                                 <td>'.$rows['cliente_estado'].'</td>
                                 <td><button type="button" class="btn btn-info" data-toggle="popover" data-trigger="hover" title="'.$rows['cliente_direccion'].'  '.$rows['cliente_direccion'].'" data-content="'.$rows['cliente_direccion'].'">
                                 <i class="fas fa-info-circle"></i>
                                
                              
                            </button></td>'; 
                            if($privilegio==1 || $privilegio==2){
                            
                                $tabla.=' <td>
                                <form class="FormularioAjax" action="'.SERVERURL.'ajax/clienteAjax.php"  method="POST" data-form="delete" autocomplete="off">
                                <input type="hidden" name="cliente_id_del" value="'.mainModelo::encryption($rows['cliente_id']).'">
                                    <button type="submit" class="btn btn-warning">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>';


                            }                                    
                              
                                $tabla.=' </tr>';
                            $contador++;

                            }
                            $reg_final=$contador-1;

                        }else{
                            if($total>=1){
                                $tabla.='<tr class="text-center"><td colspan="10">
                                <a href="'.$url.'" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a>
                                </td></tr>';

                            }else{
                                $tabla.='<tr class="text-center"><td colspan="10">No hay registros en el sistema</td></tr>';

                            }
                    

                        }

                        $tabla.='</tbody></table> </div>';
                    
                        if($total>=1 && $pagina<=$Npaginas){
                            $tabla.='<p class="text-right">Paginas cliente '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';

                            $tabla.=mainModelo::paginador_tablas($pagina,$Npaginas,$url,7);


                        }


                        return $tabla;
                    }
                     ///ELIMINAR cliente//
                public function eliminar_cliente_controlador(){

                    $id=mainModelo::decryption($_POST['cliente_id_del']);
                    $id=mainModelo::limpiar_cadena($id);
                    /*-- comprobando el cliente--*/
                    if($id==0){
                        $alerta=[
                            "Alerta" => "simple",
                            "Titulo" =>"Ocurrio un error",
                            "Texto" =>" No podemos eliminar el cliente del sistema",
                            "Icono"  =>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                        }
                        $check_cliente=mainModelo::ejecutar_consulta_simple("SELECT cliente_id FROM cliente WHERE  cliente_id='$id'" );
                        if($check_cliente->rowCount()<=0){
                            $alerta=[
                                "Alerta" => "simple",
                                "Titulo" =>"Ocurrio un error",
                                "Texto" =>" El el cliente que intentas eliminar no existe en el sistema",
                                "Icono"  =>"error"
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
                $eliminar_cliente=clienteModelo::eliminar_cliente_modelo($id);
                if($eliminar_cliente->rowCount()==1){
                    $alerta=[
                        "Alerta" => "recargar",
                        "Titulo" =>"Cliente eliminado",
                        "Texto" =>"EL cliente a sido eliminado del sistema exitosamente",
                        "Icono"  =>"success"
                    ];
    
                }else{
                    $alerta=[
                        "Alerta" => "simple",
                        "Titulo" =>"Ocurrio un error",
                        "Texto" =>" No hemos podido eliminar el cliente por favor intente nuevamente",
                        "Icono"  =>"error"
                    ];
    
                }
                echo json_encode($alerta);
    
                }   
                     //conteo para mostrar en el menu los delyverys registrados//
            public function datos_cliente_controlador($tipo,$id){
                $tipo=mainModelo::limpiar_cadena($tipo);
    
                $id=mainModelo::decryption($id);
                $id=mainModelo::limpiar_cadena($id);
    
                return clienteModelo::datos_cliente_modelo($tipo,$id);
                
                } 
                
            }   
                    
                    
        
    
