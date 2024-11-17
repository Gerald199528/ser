<?php

if($peticionAjax){
    require_once "../Modelo/delyverysModelo.php";
}else{
    require_once "./Modelo/delyverysModelo.php";

}
class delyverysControlador extends delyverysModelo{

    /*---------- controlador delyverys -------*/

public function agregar_delyverys_Controlador(){
        $codigo=mainModelo::limpiar_cadena($_POST['codigo_reg']);
        $nombre=mainModelo::limpiar_cadena($_POST['nombre_reg']);
        $apellido=mainModelo::limpiar_cadena($_POST['apellido_reg']);
        $estado=mainModelo::limpiar_cadena($_POST['estado_reg']);
        $telefono=mainModelo::limpiar_cadena($_POST['telefono_reg']);
        $direccion=mainModelo::limpiar_cadena($_POST['direccion_reg']);

    

        


    /*-- Comprobando campos vacios - Checking empty fields --*/
    if($codigo=="" || $nombre=="" || $apellido=="" || $telefono=="" ||  $estado=="" )
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
      /*-- Validad datos en el navegador --*/
      if(mainModelo::verificar_datos("[0-9-]{8,20}",$codigo)){
        $alerta=[
            "Alerta" => "simple",
            "Titulo" =>"Ocurrió un error inesperado",
            "Texto" =>"El codigo no coincide con el formato solicitado",
            "Icono"  =>"warning"
            
        ];
        echo json_encode($alerta);
        exit();
    }

if(mainModelo::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" ,$nombre)){
        $alerta=[
            "Alerta" => "simple",
            "Titulo" =>"Ocurrió un error inesperado",
            "Texto" =>"El Nombre  no coincide con el formato solicitado",
            "Icono"  =>"warning"
            
        ];
        echo json_encode($alerta);
        exit();
    }
    if(mainModelo::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" ,$apellido)){
        $alerta=[
            "Alerta" => "simple",
            "Titulo" =>"Ocurrió un error inesperado",
            "Texto" =>"El Apellido no coincide con el formato solicitado",
            "Icono"  =>"warning"
            
        ];
        echo json_encode($alerta);
        exit();
    }

if(mainModelo::verificar_datos("[0-9()+]{8,20}",$telefono)){
        $alerta=[
            "Alerta" => "simple",
            "Titulo" =>"Ocurrió un error inesperado",
            "Texto" =>"El Telefono no coincide con el formato solicitado ",
            "Icono"  =>"warning"
            
        ];
        echo json_encode($alerta);
        exit();
    }
    if(mainModelo::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}",$direccion)){
        $alerta=[
            "Alerta" => "simple",
            "Titulo" =>"Ocurrió un error inesperado en Direccion",
            "Texto" =>"Llena el campo correctamente ",
            "Icono"  =>"warning"
            
        ];
        echo json_encode($alerta);
        exit();
    }
   
    /*-- comprobar codigo--*/
    $check_codigo=mainModelo::ejecutar_consulta_simple("SELECT codigo FROM  delyverys WHERE codigo='$codigo'");
    if($check_codigo->rowCount()>0){
        $alerta=[
            "Alerta" => "simple",
            "Titulo" =>"Ocurrió un error inesperado",
            "Texto" =>"El codigo ingresado ya se encuentra registrada en el sistema ",
            "Icono"  =>"error"
            
        ];
        echo json_encode($alerta);
        exit();
    }
  
  
$datos_delyverys_reg=[
                "CODIGO"=>$codigo,
                "Nombre"=>$nombre,
                "Apellido"=>$apellido,
                "Estado"=>$estado,
                "Telefono"=>$telefono,
                "Direccion"=>$direccion
                
    ];

    /*-- Guardando datos del delyverys- Saving user data --*/
    $agregar_delyverys=delyverysModelo::agregar_delyverys_modelo($datos_delyverys_reg);

    if( $agregar_delyverys->rowCount()==1){
        $alerta=[
            "Alerta"=>"limpiar",
            "Titulo"=>"¡registrado!",
            "Texto"=>"Los datos del se registraron con éxito",
            "Icono"=>"success"
        
        ];
    }else{
        $alerta=[
            "Alerta"=>"simple",
            "Titulo"=>"Ocurrió un error inesperado",
            "Texto"=>"No hemos podido registrar el delivery  , por favor intente nuevamente",
            "Icono"=>"error"
                
        ];       
    }
    echo json_encode($alerta);

    }
    
            /*controlador paginar delyverys */
            public function paginador_delyverys_controlador($pagina,$registros,$privilegio,$url,$busqueda){
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
                    $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM delyverys WHERE codigo LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR apellido LIKE '%$busqueda%' OR estado LIKE '%$busqueda%' OR  telefono LIKE '%$busqueda%'  ORDER BY nombre ASC LIMIT $inicio,$registros";
                }else{
                    $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM delyverys ORDER BY nombre ASC LIMIT $inicio,$registros";
                        
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
                                        <th>CODIGO</th>
                                        <th>NOMBRE</th>
                                        <th>APELLIDO</th>
                                        <th>ESTADO</th>
                                        <th>TELÉFONO</th>
                                        <th>DIRECCION</th>';
                                        if($privilegio==1 || $privilegio==2){
                                        $tabla.='<th>ACTUALIZAR</th>';

                                        }   
                                        if($privilegio==1){
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
                                        <td>'.$rows['codigo'].'</td>
                                        <td>'.$rows['nombre'].'</td>
                                        <td>'.$rows['apellido'].'</td>
                                        <td>'.$rows['estado'].'</td>
                                        <td>'.$rows['telefono'].'</td>
                                        <td><button type="button" class="btn btn-info" data-toggle="popover" data-trigger="hover" title="'.$rows['direccion'].'  '.$rows['direccion'].'" data-content="'.$rows['direccion'].'">
                                        <i class="fas fa-info-circle"></i>
                                    </button></td>'; 
                                    if($privilegio==1 || $privilegio==3){
                                        $tabla.='<td>
                                        <a href="'.SERVERURL.DASHBOARD.'/delyverys-update/'.mainModelo::encryption($rows['id']).'/" class="btn btn-success">
                                            <i class="fas fa-sync-alt"></i>	
                                        </a>
                                    </td>';
                                    }                                 
                                    if($privilegio==1){
                                        $tabla.=' <td>
                                        <form class="FormularioAjax" action="'.SERVERURL.'ajax/delyverysAjax.php"  method="POST" data-form="delete" autocomplete="off">
                                        <input type="hidden" name="codigo_del" value="'.mainModelo::encryption($rows['codigo']).'">
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
                                    $tabla.='<p class="text-right">Paginas Delyverys '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';

                                    $tabla.=mainModelo::paginador_tablas($pagina,$Npaginas,$url,7);


                                }


                                return $tabla;
                
            } 
          
                ///ELIMINAR DELYVERY//
                public function eliminar_delyverys_controlador(){

                    $codigo=mainModelo::decryption($_POST['codigo_del']);
                    $codigo=mainModelo::limpiar_cadena($codigo);
                    /*-- comprobando el delyvery--*/
                    if($codigo==1){
                        $alerta=[
                            "Alerta" => "simple",
                            "Titulo" =>"Ocurrio un error",
                            "Texto" =>" No podemos eliminar el delivery   del sistema",
                            "Icono"  =>"error"
                        ];
                        echo json_encode($alerta);
                        exit();
                        }
                        $check_delyverys=mainModelo::ejecutar_consulta_simple("SELECT codigo FROM delyverys WHERE  codigo='$codigo'" );
                        if($check_delyverys->rowCount()<=0){
                            $alerta=[
                                "Alerta" => "simple",
                                "Titulo" =>"Ocurrio un error",
                                "Texto" =>" El delivery  que intentas eliminar no existe en el sistema",
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
                $eliminar_delyverys=delyverysModelo::eliminar_delyverys_modelo($codigo);
                if($eliminar_delyverys->rowCount()==1){
                    $alerta=[
                        "Alerta" => "recargar",
                        "Titulo" =>"Delivery  eliminado",
                        "Texto" =>"EL delivery   a sido eliminado del sistema exitosamente",
                        "Icono"  =>"success"
                    ];
    
                }else{
                    $alerta=[
                        "Alerta" => "simple",
                        "Titulo" =>"Ocurrio un error",
                        "Texto" =>" No hemos podido eliminar el delivery , por favor intente nuevamente",
                        "Icono"  =>"error"
                    ];
    
                }
                echo json_encode($alerta);
    
                }   
                  //conteo para mostrar en el menu los delyverys registrados//
            public function datos_delyverys_controlador($tipo,$id){
                $tipo=mainModelo::limpiar_cadena($tipo);
    
                $id=mainModelo::decryption($id);
                $id=mainModelo::limpiar_cadena($id);
    
                return delyverysModelo::datos_delyverys_modelo($tipo,$id);
                
                } 
                
                
                 /*----------  controlador actualizar administrador ----------*/
            public function actualizar_delyverys_controlador(){

                //recibiendo datos el id//
                $id=mainModelo::decryption($_POST['id_up']);
                $id=mainModelo::limpiar_cadena($id);
        
                //comprobar el usuario de la BD//
                $check_delyverys=mainModelo::ejecutar_consulta_simple("SELECT * FROM delyverys WHERE id='$id'");
        
                if($check_delyverys->rowCount()<=0){
                    $alerta=[
                        "Alerta" => "simple",
                        "Titulo"  =>"Ocurrió un error inesperado",
                        "Texto"   =>"No hemos encontrado el delivery  en el sistema",
                        "Icono"  =>"error"
                    
                    ];
                    echo json_encode($alerta);
                    exit();
                }else{
                $campos=$check_delyverys->fetch();
        
                    }
                    
                $codigo=mainModelo::limpiar_cadena($_POST['codigo_up']);
                $nombre=mainModelo::limpiar_cadena($_POST['nombre_up']);
                $apellido=mainModelo::limpiar_cadena($_POST['apellido_up']);
                             
               
                //comprobar el estado de la cuenta//
        
                    if(isset($_POST['estado_up'])){
                        $estado=mainModelo::limpiar_cadena($_POST['estado_up']);
                    }else{
                        $estado=$campos['estado'];
        
                    }
                   
                    $telefono=mainModelo::limpiar_cadena($_POST['telefono_up']); 
                    $direccion=mainModelo::limpiar_cadena($_POST['direccion_up']);
        
                    /*-- Comprobando campos vacios  --*/
                    if($codigo=="" || $nombre=="" || $apellido=="" || $telefono==""  )
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
        
                    /*-- Validad datos en el navegador --*/
                    if(mainModelo::verificar_datos("[0-9-]{8,20}",$codigo)){
                        $alerta=[
                            "Alerta" => "simple",
                            "Titulo" =>"Ocurrió un error inesperado",
                            "Texto" =>"La Cedula no coincide con el formato solicitado",
                            "Icono"  =>"warning"
                            
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
        
                if(mainModelo::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" ,$nombre)){
                        $alerta=[
                            "Alerta" => "simple",
                            "Titulo" =>"Ocurrió un error inesperado",
                            "Texto" =>"El Nombre  no coincide con el formato solicitado",
                            "Icono"  =>"warning"
                            
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                    if(mainModelo::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" ,$apellido)){
                        $alerta=[
                            "Alerta" => "simple",
                            "Titulo" =>"Ocurrió un error inesperado",
                            "Texto" =>"El Apellido no coincide con el formato solicitado",
                            "Icono"  =>"warning"
                            
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                    if(mainModelo::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}",$direccion)){
                        $alerta=[
                            "Alerta" => "simple",
                            "Titulo" =>"Ocurrió un error inesperado en Direccion",
                            "Texto" =>"Llena el campo correctamente ",
                            "Icono"  =>"warning"
                            
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                if(mainModelo::verificar_datos("[0-9()+]{8,20}",$telefono)){
                        $alerta=[
                            "Alerta" => "simple",
                            "Titulo" =>"Ocurrió un error inesperado",
                            "Texto" =>"El Telefono no coincide con el formato solicitado ",
                            "Icono"  =>"warning"
                            
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                                   
                
                    
                    if($codigo!=$campos['codigo']){   
                    $check_codigo=mainModelo::ejecutar_consulta_simple("SELECT codigo FROM  delyverys WHERE codigo='$codigo'");
                    if($check_codigo->rowCount()>0){
                        $alerta=[
                            "Alerta" => "simple",
                            "Titulo" =>"Ocurrió un error inesperado",
                            "Texto" =>"El codigo del delivery ingresado ya se encuentra registrado en el sistema ",
                            "Icono"  =>"error"
                            
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                    }
               
                /*-- preparando datos apra enviar datos a modelo--*/
                $datos_delyverys_up=[
                    "CODIGO"=>$codigo,
                    "Nombre"=>$nombre,
                    "Apellido"=>$apellido,
                    "Estado"=>$estado,
                    "Direccion"=>$direccion,
                    "Telefono"=>$telefono,
                    "ID"=>$id
                ];
        
                if(delyverysModelo::actualizar_delyverys_modelo($datos_delyverys_up)){
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
        