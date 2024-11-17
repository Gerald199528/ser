        <?php

        if($peticionAjax){
            require_once "../Modelo/usuarioModelo.php";
        }else{
            require_once "./Modelo/usuarioModelo.php";

        }
        class usuarioControlador extends usuarioModelo{

            /*---------- controlador agregar administrador ----------*/

        public function agregar_usuario_Controlador(){
                $cedula=mainModelo::limpiar_cadena($_POST['usuario_cedula_reg']);
                $nombre=mainModelo::limpiar_cadena($_POST['usuario_nombre_reg']);
                $apellido=mainModelo::limpiar_cadena($_POST['usuario_apellido_reg']);
                $telefono=mainModelo::limpiar_cadena($_POST['usuario_telefono_reg']);
                $direccion=mainModelo::limpiar_cadena($_POST['usuario_direccion_reg']);

                $usuario=mainModelo::limpiar_cadena($_POST['usuario_usuario_reg']);
                $email=mainModelo::limpiar_cadena($_POST['usuario_email_reg']);
                $clave1=mainModelo::limpiar_cadena($_POST['usuario_clave_1_reg']);
                $clave2=mainModelo::limpiar_cadena($_POST['usuario_clave_2_reg']);
            

                $privilegio=mainModelo::limpiar_cadena($_POST['usuario_privilegio_reg']);   
                
                $avatar=mainModelo::limpiar_cadena($_POST['usuario_avatar_reg']);
                


            /*-- Comprobando campos vacios - Checking empty fields --*/
            if($cedula=="" || $nombre=="" || $apellido=="" || $usuario=="" ||  $clave1=="" || $clave2=="" || $privilegio=="")
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
            if(mainModelo::verificar_datos("[0-9-]{8,20}",$cedula)){
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
        if(mainModelo::verificar_datos("[0-9-]{8,20}",$telefono)){
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
            if(mainModelo::verificar_datos("[a-zA-Z0-9]{1,35}"   ,$usuario)){
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Error inesperado en Usuario",
                    "Texto" =>" Usuario no permite ningún tipo de simbolo",
                    "Icono"  =>"error"
                    
                ];
                echo json_encode($alerta);
                exit();
            }
            /*-- comprobar cedula--*/
            $check_cedula=mainModelo::ejecutar_consulta_simple("SELECT usuario_cedula FROM  usuario WHERE usuario_cedula='$cedula'");
            if($check_cedula->rowCount()>0){
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Ocurrió un error inesperado",
                    "Texto" =>"La cedula ingresada ya se encuentra registrada en el sistema ",
                    "Icono"  =>"error"
                    
                ];
                echo json_encode($alerta);
                exit();
            }
            /*-- comprobar nombre--*/
            $check_usuario=mainModelo::ejecutar_consulta_simple("SELECT usuario_usuario FROM  usuario WHERE usuario_usuario='$usuario'");
            if($check_usuario->rowCount()>0){
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Ocurrió un error inesperado",
                    "Texto" =>" Usuario ingresado ya se encuentra registrado en el sistema ",
                    "Icono"  =>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
        /*-- comprobar email--*/
        if( $email!=""){
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $check_email=mainModelo::ejecutar_consulta_simple("SELECT usuario_email FROM  usuario WHERE usuario_email='$email'");
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
                    }/*comprobando contraseña */

            if(mainModelo::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave1) || 
            mainModelo::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave2)){
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Ocurrió un error inesperado",
                    "Texto" =>" Las Contraseña no coincide ",
                    "Icono"  =>"warning"
                    
                ];
                echo json_encode($alerta);
                exit();
            }

        if($clave1!=$clave2){
                $alerta=[
                        "Alerta" => "simple",
                        "Titulo" =>"Error en las contraseñas",
                        "Texto" =>" Las claves que acaba de ingresar no coinside ",
                        "Icono"  =>"warning"
                    ];
                    echo json_encode($alerta);
                    exit();


                }else{
                $clave=mainModelo::encryption($clave1);
            }

            if($privilegio<1 || $privilegio>3){
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Error en nivel de usuario",
                    "Texto" =>"Seleccione nivel de privilegio",
                    "Icono"  =>"error"
                ];
                echo json_encode($alerta);
                exit();


            }
            /*-- Comprobando foto o avatar - Checking photo or avatar --*/
            if(!is_file("../Vista/assets/avatar/".$avatar)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"No hemos encontrado el avatar en el sistema, por favor seleccione otro e intente nuevamente",
                    "Icon"=>"error"           
                ];
                echo json_encode($alerta);
                exit();
            }
        $datos_usuario_reg=[
                        "CEDULA"=>$cedula,
                        "Nombre"=>$nombre,
                        "Apellido"=>$apellido,
                        "Telefono"=>$telefono,
                        "Direccion"=>$direccion,
                        "Email"=>$email,
                        "Usuario"=>$usuario,
                        "Clave"=>$clave,
                        "Estado"=>"Activa",
                        "Privilegio"=>$privilegio,
                        "Avatar"=>$avatar
            ];

            /*-- Guardando datos del usuario - Saving user data --*/
            $agregar_usuario=usuarioModelo::agregar_usuario_modelo($datos_usuario_reg);

            if( $agregar_usuario->rowCount()==1){
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
                    "Texto"=>"No hemos podido registrar el , por favor intente nuevamente",
                    "Icono"=>"error"
                        
                ];       
            }
            echo json_encode($alerta);

            }/*fin del controlador */


            /*controlador paginar usuario */
            public function paginador_usuario_controlador($pagina,$registros,$privilegio,$id,$url,$busqueda){
                $pagina=mainModelo::limpiar_cadena($pagina);
                $registros=mainModelo::limpiar_cadena( $registros);
                $privilegio=mainModelo::limpiar_cadena($privilegio);
                $id=mainModelo::limpiar_cadena($id);

                $url=mainModelo::limpiar_cadena($url);
                $url=SERVERURL.DASHBOARD."/".$url."/";

                $busqueda=mainModelo::limpiar_cadena($busqueda);
                $tabla="";

                $pagina= (isset($pagina) && $pagina>0) ? (int) $pagina: 1;
                $inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0;

                if(isset($busqueda) && $busqueda!=""){
                       /*controlador buscar usuario  "tener cuidado con las variables ya que si no estan correctamente definidas no se ejecutara la accion"  */
                    $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM usuario WHERE ((usuario_id!='$id' AND usuario_id!='1') AND (usuario_cedula LIKE '%$busqueda%' OR usuario_nombre LIKE '%$busqueda%' OR usuario_apellido LIKE '%$busqueda%' OR usuario_telefono LIKE '%$busqueda%' OR  usuario_email LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%')) ORDER BY usuario_nombre ASC LIMIT $inicio,$registros";
                }else{
                    $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM usuario WHERE usuario_id!='$id'
                        AND usuario_id!='1' ORDER BY usuario_nombre ASC LIMIT $inicio,$registros";
                        
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
                                        <th>CEDULA</th>
                                        <th>NOMBRE</th>
                                        <th>APELLIDO</th>
                                        <th>TELÉFONO</th>
                                        <th>DIRECCION</th>
                                        <th>EMAIL</th>
                                        <th>USUARIO</th>
                                        <th>Privilegio</th>
                                        
                                        
                                        <th>ACTUALIZAR</th>
                                        <th>ELIMINAR</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                if($total>=1 && $pagina<=$Npaginas){
                                    $contador=$inicio+1;
                                    $reg_inicio=$inicio+1;
                                    foreach($datos as $rows){
                                        $tabla.='
                                        <tr class="text-center" >
                                        <td>'.$contador.'</td>
                                        <td>'.$rows['usuario_cedula'].'</td>
                                        <td>'.$rows['usuario_nombre'].'</td>
                                        <td>'.$rows['usuario_apellido'].'</td>
                                        <td>'.$rows['usuario_telefono'].'</td>
                                        <td>'.$rows['usuario_direccion'].'</td>
                                        <td>'.$rows['usuario_email'].'</td>
                                        <td>'.$rows['usuario_usuario'].'</td>
                                        <td>'.$rows['usuario_privilegio'].'</td>
                                        
                                        <td>
                                            <a href="'.SERVERURL.DASHBOARD.'/admin-update/'.mainModelo::encryption($rows['usuario_id']).'/" class="btn btn-success">
                                                <i class="fas fa-sync-alt"></i>	
                                            </a>
                                        </td>
                                        <td>
                                            <form class="FormularioAjax" action="'.SERVERURL.'ajax/usuarioAjax.php"  method="POST" data-form="delete" autocomplete="off">
                                            <input type="hidden" name="usuario_id_del" value="'.mainModelo::encryption($rows['usuario_id']).'">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>';
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
                                    $tabla.='<p class="text-right">Paginas Administrador '.$reg_inicio.' al '.$reg_final.' de un total de '.$total.'</p>';

                                    $tabla.=mainModelo::paginador_tablas($pagina,$Npaginas,$url,7);


                                }


                                return $tabla;
                
            } /*-- fin controlador--*/

            public function eliminar_usuario_controlador(){

                $id=mainModelo::decryption($_POST['usuario_id_del']);
                $id=mainModelo::limpiar_cadena($id);
                /*-- comprobando el usuario--*/
                if($id==1){
                    $alerta=[
                        "Alerta" => "simple",
                        "Titulo" =>"Ocurrio un error",
                        "Texto" =>" No podemos eliminar el Administrador del sistema",
                        "Icono"  =>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                    }
                    $check_usuario=mainModelo::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE  usuario_id='$id'" );
                    if($check_usuario->rowCount()<=0){
                        $alerta=[
                            "Alerta" => "simple",
                            "Titulo" =>"Ocurrio un error",
                            "Texto" =>" El administrador que intentas eliminar no existe en el sistema",
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
            $eliminar_usuario=usuarioModelo::eliminar_usuario_modelo($id);
            if($eliminar_usuario->rowCount()==1){
                $alerta=[
                    "Alerta" => "recargar",
                    "Titulo" =>"Usuario o Administrador eliminado",
                    "Texto" =>"EL administrador o usuario a sido eliminado del sistema exitosamente",
                    "Icono"  =>"success"
                ];

            }else{
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Ocurrio un error",
                    "Texto" =>" No hemos podido eliminar el administrador, por favor intente nuevamente",
                    "Icono"  =>"error"
                ];

            }
            echo json_encode($alerta);

            }    
        public function datos_usuario_controlador($tipo,$id){
            $tipo=mainModelo::limpiar_cadena($tipo);

            $id=mainModelo::decryption($id);
            $id=mainModelo::limpiar_cadena($id);

            return usuarioModelo::datos_usuario_modelo($tipo,$id);
            
            } 

            /*----------  controlador actualizar administrador ----------*/
            public function actualizar_usuario_controlador(){

        //recibiendo datos el id//
        $id=mainModelo::decryption($_POST['usuario_id_up']);
        $id=mainModelo::limpiar_cadena($id);

        //comprobar el usuario de la BD//
        $check_user=mainModelo::ejecutar_consulta_simple("SELECT * FROM usuario WHERE usuario_id='$id'");

        if($check_user->rowCount()<=0){
            $alerta=[
                "Alerta" => "simple",
                "Titulo"  =>"Ocurrió un error inesperado",
                "Texto"   =>"No hemos encontrado el usuario en el sistema",
                "Icono"  =>"error"
            
            ];
            echo json_encode($alerta);
            exit();
        }else{
        $campos=$check_user->fetch();

            }
            
        $cedula=mainModelo::limpiar_cadena($_POST['usuario_cedula_up']);
        $nombre=mainModelo::limpiar_cadena($_POST['usuario_nombre_up']);
        $apellido=mainModelo::limpiar_cadena($_POST['usuario_apellido_up']);
        $telefono=mainModelo::limpiar_cadena($_POST['usuario_telefono_up']);
        $direccion=mainModelo::limpiar_cadena($_POST['usuario_direccion_up']);

        $usuario=mainModelo::limpiar_cadena($_POST['usuario_usuario_up']);
        $email=mainModelo::limpiar_cadena($_POST['usuario_email_up']);
        $estado=mainModelo::limpiar_cadena($_POST['usuario_estado_up']);

        //comprobar el usuario avatar/
        if(isset($_POST['usuario_avatar_up'])){
            $avatar=mainModelo::limpiar_cadena($_POST['usuario_avatar_up']);
        }else{
            $avatar=$campos['usuario_avatar'];

        }
      

         
            //comprobar el nivel de privilegio//

            if(isset($_POST['usuario_privilegio_up'])){
                $privilegio=mainModelo::limpiar_cadena($_POST['usuario_privilegio_up']);
            }else{
                $privilegio=$campos['usuario_privilegio'];

            }
            $admin_usuario=mainModelo::limpiar_cadena($_POST['usuario_admin']);

            $admin_clave=mainModelo::limpiar_cadena($_POST['clave_admin']);
            

        //para ver que tipo de cuenta es/
            $tipo_cuenta=mainModelo::limpiar_cadena($_POST['tipo_cuenta']);

            /*-- Comprobando campos vacios  --*/
            if($cedula=="" || $nombre=="" || $apellido=="" || $usuario=="" || $admin_usuario=="" || $admin_clave=="" )
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
            if(mainModelo::verificar_datos("[0-9-]{8,20}",$cedula)){
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
        if(mainModelo::verificar_datos("[0-9-]{8,12}",$telefono)){
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Ocurrió un error inesperado",
                    "Texto" =>"El Telefono no coincide con el formato solicitado ",
                    "Icono"  =>"error"
                    
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
            if(mainModelo::verificar_datos("[a-zA-Z0-9]{1,35}"   ,$usuario)){
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Error inesperado en Usuario",
                    "Texto" =>" Usuario no permite ningún tipo de simbolo",
                    "Icono"  =>"error"
                    
                ];
                echo json_encode($alerta);
                exit();
            }
            if(mainModelo::verificar_datos("[a-zA-Z0-9]{1,35}"   , $admin_usuario)){
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Ocurrio un error inesperado",
                    "Texto" =>" Tu nombre de usuario no coincide con el formato solicitado",
                    "Icono"  =>"error"
                    
                ];
                echo json_encode($alerta);
                exit();
            }

            if(mainModelo::verificar_datos("[a-zA-Z0-9$@.-]{7,100}"   ,  $admin_clave)){
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Ocurrio un error inesperado",
                    "Texto" =>" Tu clave de usuario no coincide con el formato solicitado",
                    "Icono"  =>"error"
                    
                ];
                echo json_encode($alerta);
                exit();
            }
        //encriptar y poner la cuenta en hasch para seguridad//
            $admin_clave=mainModelo::encryption($admin_clave);

            if($privilegio<1 || $privilegio>3){
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Ocurrio un error inesperado",
                    "Texto" =>" EL privilegio no corresponde a un valor valido",
                    "Icono"  =>"error"
                    
                ];
                echo json_encode($alerta);
                exit();
            }

            if($estado=!"Activa" && $estado=!"Deshabilitada" ){
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Ocurrio un error inesperado",
                    "Texto" =>"El estado de la cuenta no coincide con el formato solicitado",
                    "Icono"  =>"error"
                    
                ];
                echo json_encode($alerta);
                exit();
            }
            /*-- comprobar cedula--*/

            
            if($cedula!=$campos['usuario_cedula']){   
            $check_cedula=mainModelo::ejecutar_consulta_simple("SELECT usuario_cedula FROM  usuario WHERE usuario_cedula='$cedula'");
            if($check_cedula->rowCount()>0){
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Ocurrió un error inesperado",
                    "Texto" =>"La cedula ingresada ya se encuentra registrada en el sistema ",
                    "Icono"  =>"error"
                    
                ];
                echo json_encode($alerta);
                exit();
            }
            }
            /*-- comprobar  usuario--*/
            if($usuario!=$campos['usuario_usuario']){  
            $check_user=mainModelo::ejecutar_consulta_simple("SELECT usuario_usuario FROM  usuario WHERE usuario_usuario='$usuario'");
            if($check_user->rowCount()>0){
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Ocurrió un error inesperado",
                    "Texto" =>" Usuario ingresado ya se encuentra registrado en el sistema ",
                    "Icono"  =>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            }
            /*-- comprobar  email--*/
            if($email!=$campos['usuario_email'] && $email!=""){
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                $check_email=mainModelo::ejecutar_consulta_simple("SELECT 
            usuario_email FROM usuario WHERE usuario_email='$email'");
                if($check_email->rowCount()>0){
                    $alerta=[
                        "Alerta" => "simple",
                        "Titulo" =>"Ocurrió un error inesperado",
                        "Texto" =>"El nuevo email ingresado ya se encuentra registrado en el sistema ",
                        "Icono"  =>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }else{
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Ocurrió un error inesperado",
                    "Texto" =>" Ha ingresado un correo no valido ",
                    "Icono"  =>"error"
                ];
                echo json_encode($alerta);
                exit();

            } 

            }
            /*-- comprobar  clave--*/
            if($_POST['usuario_clave_nueva_1']!="" || $_POST['usuario_clave_nueva_2']!=""){
                if($_POST['usuario_clave_nueva_1']!=$_POST['usuario_clave_nueva_2'] ){
                    $alerta=[
                        "Alerta" => "simple",
                        "Titulo" =>"Ocurrió un error inesperado",
                        "Texto" =>" Las nuevas claves ingresadas no coinciden",
                        "Icono"  =>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }else{
                if(mainModelo::verificar_datos("[a-zA-Z0-9$@.-]{7,100}"   ,  $_POST['usuario_clave_nueva_1']) || mainModelo::verificar_datos("[a-zA-Z0-9$@.-]{7,100}"   ,  $_POST['usuario_clave_nueva_2'])){
                    $alerta=[
                        "Alerta" => "simple",
                        "Titulo" =>"Ocurrió un error inesperado",
                        "Texto" =>" Las nuevas claves ingresadas no coinciden con el formato solicitado",
                        "Icono"  =>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
                $clave=mainModelo::encryption($_POST['usuario_clave_nueva_1']);
                    
                }
            }else{
                $clave=$campos['usuario_clave'];
            }
                    /*-- comprobar  credenciales para actualizar datos--*/
            if($tipo_cuenta=="Propia"){
                $check_cuenta=mainModelo::ejecutar_consulta_simple("SELECT 
                usuario_id FROM usuario WHERE usuario_usuario='$admin_usuario' AND usuario_clave='$admin_clave' AND usuario_id='$id'");


            }else{
                session_start(['name'=>'Ser']);
                if($_SESSION['privilegio_Ser']!=1){
                    $alerta=[
                        "Alerta" => "simple",
                        "Titulo" =>"Ocurrió un error inesperado",
                        "Texto" =>" No tienes los permisos necesario para realizar esta operacion",
                        "Icono"  =>"error"
                    ];
                    echo json_encode($alerta);
                    exit();


                }
                $check_cuenta=mainModelo::ejecutar_consulta_simple("SELECT 
                usuario_id FROM usuario WHERE usuario_usuario='$admin_usuario' AND usuario_clave='$admin_clave'");
            
            }
            
            if($check_cuenta->rowCount()<=0){
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Ocurrió un error inesperado",
                    "Texto" =>"Nombre y clave de administrador no validas",
                    "Icono"  =>"error"
                ];
                echo json_encode($alerta);
                exit();

            }
        /*-- preparando datos apra enviar datos a modelo--*/
        $datos_usuario_up=[
            "CEDULA"=>$cedula,
            "Nombre"=>$nombre,
            "Apellido"=>$apellido,
            "Telefono"=>$telefono,
            "Direccion"=>$direccion,
            "Email"=>$email,
            "Usuario"=>$usuario,
            "Clave"=>$clave,
            "Estado"=>"Activa",
            "Privilegio"=>$privilegio,
            "Avatar"=>$avatar,
            "ID"=>$id
        ];

        if(usuarioModelo::actualizar_usuario_modelo($datos_usuario_up)){
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
