<?php

if($peticionAjax){
	require_once "../Modelo/mainModelo.php";
	}else{
		require_once "./Modelo/mainModelo.php";
	}


class signinControlador extends mainModelo{

 /*---------controlador para iniciar session ----------*/
public function iniciar_sesion_cliente_controlador(){

$email=mainModelo::limpiar_cadena($_POST['email_log']);
$clave=mainModelo::limpiar_cadena($_POST['clave_log']);


          /*-- Comprobando campos vacios  --*/
          if( $email=="" ||  $clave==""){
            echo'<script>
            Swal.fire({
              title: "Ocurrió un error inesperado",
              text: "No has llenado todos los campos que son requeridos.",
              icon: "error",
            
            });
        </script>';
        exit();
              }

                      if(mainModelo::verificar_datos("[a-zA-Z0-9$@.-]{7,100}" ,$clave)){
                    echo'<script>
                    Swal.fire({
                      title: "Ocurrió un error inesperado",
                      text: "La contraseña no coincide con el formato solicitado.",
                      icon: "error",
                    
                    });
                </script>';
                exit();
                }

           
			$clave=mainModelo::encryption($clave);

			/*-- Verificando datos de la cuenta - Verifying account details --*/
			$datos_cuenta=mainModelo::datos_tabla("Normal","cliente WHERE cliente_email='$email' AND 	cliente_clave='$clave' AND cliente_estado='Activa'","*",0);

			if($datos_cuenta->rowCount()==1){

				$row=$datos_cuenta->fetch();

				$datos_cuenta->closeCursor();
			    $datos_cuenta=mainModelo::desconectar($datos_cuenta);
          

                     $_SESSION['id_Ser']=$row['cliente_id'];
                      $_SESSION['nombre_Ser']=$row['cliente_nombre'];
                       $_SESSION['apellido_Ser']=$row['cliente_apellido'];
                        $_SESSION['email_Ser']=$row['cliente_email'];
                         $_SESSION['privilegio_Ser']=$row['cliente_privilegio'];                  
                          $_SESSION['token_Ser']=mainModelo::encryption(uniqid(mt_rand(), true));


                          if(headers_sent()){
                            echo ("Location: ".SERVERURL);
                    }else{
                        return header("Location: ".SERVERURL);
                    }
                }else{
                echo'<script>
                Swal.fire({
                  title: "Datos incorrectos",
                  text: "El nombre de usuario o contraseña no son correctos.",
                  icon: "error",
                
                });
            </script>';

                }
             
        } /*-- Fin controlador --*/


        /*----------  Controlador forzar cierre de sesion  ----------*/
        public function forzar_cierre_sesion_controlador(){
            session_unset();
            session_destroy();
            if(headers_sent()){
                echo "<script> window.location.href='".SERVERURL."index/'; </script>";
            }else{
                return header("Location: ".SERVERURL."index/");
            }
        } /*-- Fin controlador -  --*/
        
    /*----------  Controlador cierre de sesion administrador ----------*/
    public function cerrar_sesion_cliente_controlador(){
        session_start(['name'=>'Ser']);
        $token=mainModelo::decryption($_POST['token']);
        $email=mainModelo::decryption($_POST['email']);

        if($token==$_SESSION['token_Ser'] && $email==$_SESSION['email_Ser']){
            session_unset();
            session_destroy();
            $alerta=[
            "Alerta"=>"redireccionar",
            "URL"=>SERVERURL
            ];
        }else{
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"No se pudo cerrar la sesión",
                "Icono"=>"error"
                ];
        }
        echo json_encode($alerta);
    } /*-- Fin controlador  --*/

    
}

       