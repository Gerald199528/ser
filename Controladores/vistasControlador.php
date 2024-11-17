<?php

	require_once "./Modelo/VistasModelo.php";

	class vistasControlador extends vistasModelo{

		/*---------- Controlador obtener plantilla ----------*/
		public function obtener_plantilla_controlador(){
			return require_once "./Vista/plantilla.php";
		}

		/*---------- Controlador obtener vistas ----------*/
		public function obtener_vistas_controlador($modulo,$idioma){
			if(isset($_GET['views'])){
				$ruta=explode("/", $_GET['views']);

				if($modulo=="dashboard"){
					if(isset($ruta[1]) && $ruta[1]!=""){
						$Vista=$ruta[1];
					}else{
						$Vista="";
					}
				}else{
					$Vista=$ruta[0];
				}

				if($Vista!=""){
					$respuesta=vistasModelo::obtener_Vistas_modelo($Vista,$modulo,$idioma);
				}else{
					if($modulo=="dashboard"){
						$respuesta="login";
					}else{
						$respuesta="./Vista/contenidos/".$idioma."/web-index.php";
					}
				}
			}else{
				if($modulo=="dashboard"){
					$respuesta="login";
				}else{
					$respuesta="./Vista/contenidos/".$idioma."/web-index.php";
				}
			}
			return $respuesta;
		}
	}