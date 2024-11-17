<?php 
	class vistasModelo{

		/*---------- Modelo obtener vista ----------*/
		protected static function obtener_Vistas_modelo($Vista){
			$ListaBlanca=["home", "product-disponibilidad","venta-new","portada-update","cliente-up","portada-cover","portadal-ist","portada","details","signin","registration","product","product-update","product-search","product-info","product-cover","product-new","product-list","product-gallery","index","categoria-update","categoria-search","categoria-list","categoria-new","cliente-search","cliente-list","cliente-new","delyverys-search","delyverys-new","delyverys-list","delyverys-update","mi-cuenta","empresa","404","admin-list","admin-new","admin-search","admin-update"];
			if(in_array($Vista, $ListaBlanca)){
				if(is_file("./Vista/contenidos/" .$Vista. "-views.php")){
                    $contenido="./Vista/contenidos/" .$Vista."-views.php";
				}else{
                    $contenido="404";	
				}
			}elseif($Vista=="login" ||  $Vista=="index" ){
				$contenido="login";
			}else{
             $contenido="404";

            }
			return $contenido;
		}
	}