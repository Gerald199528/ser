<?php

if($peticionAjax){
    require_once "../Modelo/empresaModelo.php";
}else{
    require_once "./Modelo/empresaModelo.php";

}
	class empresaControlador extends empresaModelo{    
        public function datos_empresa_controlador(){
            return empresaModelo::datos_empresa_modelo();
        
        
        }
          /*--------- Controlador registrar empresa - Controller register company ---------*/
          public function agregar_empresa_Controlador(){

            /*-- Recibiendo datos del formulario - Receiving form data --*/
            $rif=mainModelo::limpiar_cadena($_POST['empresa_rif_reg']);
            $nombre=mainModelo::limpiar_cadena($_POST['empresa_nombre_reg']);           
            $telefono=mainModelo::limpiar_cadena($_POST['empresa_telefono_reg']);
            $email=mainModelo::limpiar_cadena($_POST['empresa_email_reg']);
            $direccion=mainModelo::limpiar_cadena($_POST['empresa_direccion_reg']);


            /*-- Comprobando campos vacios - Checking empty fields --*/
            if($rif=="" || $nombre=="" || $telefono=="" || $email=="" || $direccion==""){
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
            if(mainModelo::verificar_datos("[0-9-]{8,20}",$rif)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Formato no valido",
					"Texto"=>"El NÚMERO DE DOCUMENTO no coincide con el formato solicitado",
                    "Icono"=>"error"
                   
				];
				echo json_encode($alerta);
				exit();
            }

            if(mainModelo::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ., ]{3,80}",$nombre)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Formato no valido",
					"Texto"=>"El NOMBRE no coincide con el formato solicitado",
                    "Icono"=>"error"
                   
				];
				echo json_encode($alerta);
				exit();
            }

            if($telefono!=""){
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
            }

            if($direccion!=""){
                if(mainModelo::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,97}",$direccion)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Formato no valido",
                        "Texto"=>"La DIRECCIÓN no coincide con el formato solicitado",
                        "Icono"=>"error"
                      
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }



            /*-- Comprobando email - Checking email --*/
            if($email!=""){
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Formato no valido",
                        "Texto"=>"Ha ingresado un EMAIL no valido",
                        "Icono"=>"error"
                      
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }

       

            /*-- Comprobando empresas en la DB - Checking company in DB --*/
            $check_empresa=mainModelo::ejecutar_consulta_simple("SELECT empresa_id FROM empresa");
            if($check_empresa->rowCount()>=1){
            	$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"Ya existe una empresa registrada, por favor actualice la pagina.",
					"Icono"=>"error"
				];
				echo json_encode($alerta);
				exit();

			}
			$datos_empresa_reg=[
                "RIF"=>$rif,
                "Nombre"=>$nombre,                
                "Telefono"=>$telefono,
                "Email"=>$email,
                "Direccion"=>$direccion
                
    ];

    /*-- Guardando datos del empresa- Saving user data --*/
    $agregar_empresa=empresaModelo::agregar_empresa_modelo($datos_empresa_reg);

    if( $agregar_empresa->rowCount()==1){
        $alerta=[
            "Alerta"=>"recargar",
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

    }
         //conteo para mostrar en el menu los delyverys registrados//
         public function conteo_empresa_controlador($tipo,$id){
            $tipo=mainModelo::limpiar_cadena($tipo);

            $id=mainModelo::decryption($id);
            $id=mainModelo::limpiar_cadena($id);

            return empresaModelo::conteo_empresa_modelo($tipo,$id);
            
            } 
            
            
    
    
     /*--------- Controlador actualizar empresa - Controller update company ---------*/
		public function actualizar_empresa_controlador(){

               
                    

            /*-- Recibiendo datos del formulario - Receiving form data --*/
            $id=mainModelo::limpiar_cadena($_POST['empresa_id_up']);
            $rif=mainModelo::limpiar_cadena($_POST['empresa_rif_up']);
            $nombre=mainModelo::limpiar_cadena($_POST['empresa_nombre_up']);           
            $telefono=mainModelo::limpiar_cadena($_POST['empresa_telefono_up']);
            $email=mainModelo::limpiar_cadena($_POST['empresa_email_up']);
            $direccion=mainModelo::limpiar_cadena($_POST['empresa_direccion_up']);

        
            /*-- Comprobando campos vacios - Checking empty fields --*/
            if($rif=="" || $direccion=="")
            {
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
            if(mainModelo::verificar_datos("[0-9-]{8,20}",$rif)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Formato no valido",
					"Texto"=>"El NÚMERO DE DOCUMENTO no coincide con el formato solicitado",
                    "Icon"=>"error"
                  
				];
				echo json_encode($alerta);
				exit();
            }

            if(mainModelo::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ., ]{3,80}",$nombre)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Formato no valido",
					"Texto"=>"El NOMBRE no coincide con el formato solicitado",
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
                        "Icon"=>"error"
                       
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            

         
                if(mainModelo::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,97}",$direccion)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Formato no valido",
                        "Texto"=>"La DIRECCIÓN no coincide con el formato solicitado",
                        "Icon"=>"error"
                   
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            
           
            /*-- Comprobando email - Checking email --*/
          
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Formato no valido",
                        "Texto"=>"Ha ingresado un EMAIL no valido",
                        "Icon"=>"error"
                    
                    ];
                    echo json_encode($alerta);
                    exit();
                }
               
       
                    $check_rif=mainModelo::ejecutar_consulta_simple("SELECT empresa_rif FROM empresa WHERE empresa_rif='$rif");
                    if($check_rif->rowCount()>0){
                        $alerta=[
                            "Alerta" => "simple",
                            "Titulo" =>"Ocurrió un error inesperado",
                            "Texto" =>"El rif ingresado ya se encuentra registrada en el sistema ",
                            "Icono"  =>"error"
                            
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
                    
                    /*-- comprobar  usuario--*/
                   session_start(['name'=>'Ser']);
                   if($_SESSION['privilegio_Ser']<1 || $_SESSION['privilegio_Ser']>2){
                    $alerta=[
                        "Alerta" => "simple",
                        "Titulo" =>"Ocurrió un error inesperado",
                        "Texto" =>"el privilegio no coincide con el formato solicitado ",
                        "Icono"  =>"error"
                        
                    ];
                    echo json_encode($alerta);
                    exit();
                   }

            $datos_empresa_up=[
                "RIF"=>$rif,
                "Nombre"=>$nombre,                
                "Telefono"=>$telefono,
                "Email"=>$email,
                "Direccion"=>$direccion,
                "ID"=>$id
            ];
    
            if(empresaModelo::actualizar_empresa_modelo($datos_empresa_up)){
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
    