<?php

if($peticionAjax){
	require_once "../Modelo/loginModelo.php";
}else{
	require_once "./Modelo/loginModelo.php";

}


class loginControlador extends loginModelo{

 /*---------controlador para iniciar session ----------*/
public function iniciar_sesion_controlador(){

$usuario=mainModelo::limpiar_cadena($_POST['usuario_log']);
$clave=mainModelo::limpiar_cadena($_POST['clave_log']);


		  /*-- Comprobando campos vacios  --*/
		  if( $usuario=="" ||  $clave==""){
			echo'<script>
			Swal.fire({
			  title: "Ocurrió un error inesperado",
			  text: "No has llenado todos los campos que son requeridos.",
			  icon: "error",
			
			});
		</script>';
		exit();
			  }

		  /*--verificar integridad de datos  --*/

			if(mainModelo::verificar_datos("[a-zA-Z0-9]{1,35}" ,$usuario)){
			echo'<script>
			Swal.fire({
			  title: "Ocurrió un error inesperado",
			  text: "El nombre de usuario no coincide con el formato solicitado.",
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
				$datos_login=[
						"Usuario"=>$usuario,
						"Clave"=>$clave
				];
				$datos_cuenta=loginModelo::iniciar_sesion_modelo($datos_login);
				if($datos_cuenta->rowCount()==1){
					$row=$datos_cuenta->fetch();

		  

					 $_SESSION['id_Ser']=$row['usuario_id'];
					  $_SESSION['nombre_Ser']=$row['usuario_nombre'];
					   $_SESSION['apellido_Ser']=$row['usuario_apellido'];
						$_SESSION['usuario_Ser']=$row['usuario_usuario'];
						 $_SESSION['privilegio_Ser']=$row['usuario_privilegio'];
					  $_SESSION['avatar_Ser']=$row['usuario_avatar'];
						  $_SESSION['token_Ser']=mainModelo::encryption(uniqid(mt_rand(), true));


						  if(headers_sent()){
							echo ("Location: ".SERVERURL.DASHBOARD."home/");
					}else{
						return header("Location: ".SERVERURL.DASHBOARD."/home/");
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
				return "<script> window.location.href='.SERVERURL.DASHBOARD'; </script>";
			}else{
				return header("Location: ".SERVERURL.DASHBOARD);
			}
		} /*-- Fin controlador -  --*/
		
	/*----------  Controlador cierre de sesion administrador ----------*/
	public function cerrar_sesion_usuario_controlador(){
		session_start(['name'=>'Ser']);
		$token=mainModelo::decryption($_POST['token']);
		$usuario=mainModelo::decryption($_POST['usuario']);

		if($token==$_SESSION['token_Ser'] && $usuario==$_SESSION['usuario_Ser']){
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
				"Icon"=>"error"
				];
		}
		echo json_encode($alerta);
	} /*-- Fin controlador  --*/
}

	   