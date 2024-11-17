<?php


if($peticionAjax){
    require_once "../config/SERVER.php";
}else{
    require_once "./config/SERVER.php";
}
class mainModelo{

		/*----------  Funcion conectar a BD - Function connect to BD ----------*/

		protected static function conectar(){
			$conexion = new PDO(SGBD,USER,PASS);
			$conexion->exec("SET CHARACTER SET utf8");
			return $conexion;
		} /*--  Fin Funcion  -

		/*----------  Funcion desconectar de DB - Function disconnect from DB opcional  ----------*/
		public function desconectar($consulta){
			global $conexion, $consulta;
			$consulta=null;
			$conexion=null;
			return $consulta;
		} /*--  Fin Funcion - End Function --*/

        
		/*----------  Funcion para ejecutar una consulta INSERT preparada - opcional  ----------*/
		protected static function guardar_datos($tabla,$datos){
			$query="INSERT INTO $tabla (";
			$C=0;
			foreach ($datos as $campo => $indice){
				if($C<=0){
					$query.=$campo;
				}else{
					$query.=",".$campo;
				}
				$C++;
			}
			
			$query.=") VALUES(";
			$Z=0;
			foreach ($datos as $campo => $indice){
				if($Z<=0){
					$query.=$indice["campo_marcador"];
				}else{
					$query.=",".$indice["campo_marcador"];
				}
				$Z++;
			}

			$query.=")";
			$sql=self::conectar()->prepare($query);

			foreach ($datos as $campo => $indice){
				$sql->bindParam($indice["campo_marcador"],$indice["campo_valor"]);
			}

			$sql->execute();

			return $sql;
		} /*-- Fin Funcion - End Function --*/


		/*----------  Funcion para ejecutar una consulta UPDATE preparada - Function to execute a prepared UPDATE query ----------*/
		protected static function actualizar_datos($tabla,$datos,$condicion){
			$query="UPDATE $tabla SET ";

			$C=0;
			foreach ($datos as $campo => $indice){
				if($C<=0){
					$query.=$campo."=".$indice["campo_marcador"];
				}else{
					$query.=",".$campo."=".$indice["campo_marcador"];
				}
				$C++;
			}

			$query.=" WHERE ".$condicion["condicion_campo"]."=".$condicion["condicion_marcador"];

			$sql=self::conectar()->prepare($query);

			foreach ($datos as $campo => $indice){
				$sql->bindParam($indice["campo_marcador"],$indice["campo_valor"]);
			}

			$sql->bindParam($condicion["condicion_marcador"],$condicion["condicion_valor"]);

			$sql->execute();

			return $sql;
		} /*-- Fin Funcion - End Function --*/
		

		/*---------- Funcion eliminar registro - Delete record function ----------*/
        protected static function eliminar_registro($tabla,$campo,$id){
            $sql=self::conectar()->prepare("DELETE FROM $tabla WHERE $campo=:ID");

            $sql->bindParam(":ID",$id);
            $sql->execute();
            
            return $sql;
        } /*-- Fin Funcion - End Function --*/




        	/*----------  Funcion ejecutar consultas simples  ----------*/
			protected static function ejecutar_consulta_simple ($consulta){
				$sql=self::conectar()->prepare($consulta);
				$sql->execute();
				return $sql;
			} /*--  Fin Funcion - End Function --*/

		/*---------- Funcion datos tabla - opcional  ----------*/
        public function datos_tabla($tipo,$tabla,$campo,$id){
			$tipo=self::limpiar_cadena($tipo);
			$tabla=self::limpiar_cadena($tabla);
			$campo=self::limpiar_cadena($campo);

			$id=self::decryption($id);
			$id=self::limpiar_cadena($id);

            if($tipo=="Unico"){
                $sql=self::conectar()->prepare("SELECT * FROM $tabla WHERE $campo=:ID");
                $sql->bindParam(":ID",$id);
            }elseif($tipo=="Normal"){
                $sql=self::conectar()->prepare("SELECT $campo FROM $tabla");
            }
            $sql->execute();

            return $sql;
		} /*-- Fin Funcion - End Function --*/

	
		/*----------  Encriptar cadenas - Encrypt strings ----------*/
		public function encryption($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		} /*--  Fin Funcion - End Function --*/




 	/*---------- Desencriptar cadenas----------*/
		protected static function decryption($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}

/*----------  Funcion generar codigos aleatorios - Generate random codes function ----------*/
protected static function generar_codigo_aleatorio($longitud,$correlativo){
	$codigo="";
	$caracter="Letra";
	for($i=1; $i<=$longitud; $i++){
		if($caracter=="Letra"){
			$letra_aleatoria=chr(rand(ord("a"),ord("z")));
			$letra_aleatoria=strtoupper($letra_aleatoria);
			$codigo.=$letra_aleatoria;
			$caracter="Numero";
		}else{
			$numero_aleatorio=rand(0,9);
			$codigo.=$numero_aleatorio;
			$caracter="Letra";
		}
	}
	return $codigo."-".$correlativo;
} /*--  Fin Funcion - End Function --*/


 	/*---------- funcion limpiar cadenas para evitar atakes al sistema---------*/
	 protected static function limpiar_cadena($cadena){
				$cadena=trim($cadena);
				$cadena=stripslashes($cadena);
				$cadena=str_ireplace("<script>", "", $cadena);
				$cadena=str_ireplace("</script>", "", $cadena);
						$cadena=str_ireplace("<script> src", "", $cadena);
						$cadena=str_ireplace("<script type=", "", $cadena);
						$cadena=str_ireplace("SELECT * FROM", "", $cadena);
						$cadena=str_ireplace("DELETE FROM", "", $cadena);
						$cadena=str_ireplace("INSERT INTO", "", $cadena);
						$cadena=str_ireplace("DROP TABLE", "", $cadena);
						$cadena=str_ireplace("DROP DATABASE", "", $cadena);
						$cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
						$cadena=str_ireplace("SHOW TABLES", "", $cadena);
						$cadena=str_ireplace("SHOW DATABASES", "", $cadena);
						$cadena=str_ireplace("<?php", "", $cadena);
							$cadena=str_ireplace("?>", "", $cadena);
							$cadena=str_ireplace("--", "", $cadena);
							$cadena=str_ireplace(">", "", $cadena);
							$cadena=str_ireplace("<", "", $cadena);
							$cadena=str_ireplace("[", "", $cadena);
							$cadena=str_ireplace("]", "", $cadena);
							$cadena=str_ireplace("^", "", $cadena);
							$cadena=str_ireplace("==", "", $cadena);
							$cadena=str_ireplace(";", "", $cadena);
							$cadena=str_ireplace("::", "", $cadena);
							$cadena=stripslashes($cadena);
							$cadena=trim($cadena);
							return $cadena;
	 }

	/*---------- verificar datos de formulario PARA VALIDACION---------*/
	protected static function verificar_datos($filtro,$cadena){
			if(preg_match("/^".$filtro."$/", $cadena)){
				return false;
				}else{
					return true;

				}

			}

	/*---------- funcion verificar fechas---------*/
	protected static function verificar_fecha($fecha){
				$valores=explode('-', $fecha);
				if(count($valores)==3 && checkdate($valores[1],$valores[2],$valores[0]))
				{
				return false;

				}else{
					return true;
				}

				}
							/*----------  Funcion paginador de tablas - Table pager function ----------*/
							protected static function paginador_tablas($pagina,$Npaginas,$url,$botones){
							
								$tabla='<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
					
								if($pagina==1){
									$tabla.='<li class="page-item disabled" ><a class="page-link" ><i class="fas fa-backward-fast"></i></a></li>';
								}else{
									$tabla.='
									<li class="page-item" ><a class="page-link" href="'.$url.'1/"><i class="fas fa-backward-fast"></i></a></li>
									<li class="page-item" ><a class="page-link" href="'.$url.($pagina-1).'/">Anterior</a></li>
									';
								}
					
								$ci=0;
								for($i=$pagina; $i<=$Npaginas; $i++){
									if($ci>=$botones){
										break;
									}
									if($pagina==$i){
										$tabla.='<li class="page-item active" ><a class="page-link" href="'.$url.$i.'/">'.$i.'</a></li>';
									}else{
										$tabla.='<li class="page-item" ><a class="page-link" href="'.$url.$i.'/">'.$i.'</a></li>';
									}
									$ci++;
								}
					
								if($pagina==$Npaginas){
									$tabla.='<li class="page-item disabled" ><a class="page-link" ><i class="fa fa fa-forward-fast"></i></a></li>';
								}else{
									$tabla.='
									<li class="page-item" ><a class="page-link" href="'.$url.($pagina+1).'/">Siguiente</a></li>
									<li class="page-item" ><a class="page-link" href="'.$url.$Npaginas.'/"><i class="fa fa-forward-fast"></i></a></li>
									';
								}
					
								$tabla.='</ul></nav>';
								return $tabla;
		} 
		
		/*----------  Funcion generar select - opcional  ----------*/
		public function generar_select($datos,$campo_db){
			$check_select='';
			$text_select='';
			$count_select=1;
			$select='';
			foreach($datos as $row){

				if($campo_db==$row){
					$check_select='selected=""';
					$text_select=' (Actual)';
				}

				$select.='<option value="'.$row.'" '.$check_select.'>'.$count_select.' - '.$row.$text_select.'</option>';

				$check_select='';
				$text_select='';
				$count_select++;
			}
			return $select;
		} /*--  Fin Funcion - End Function --*/
	}
		
	

				

				
				