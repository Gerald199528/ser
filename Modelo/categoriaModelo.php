<?php


require_once "mainModelo.php";

class categoriaModelo extends mainModelo{



protected static function agregar_categoria_modelo($datos){

	$sql=mainModelo::conectar()->prepare("INSERT INTO categoria(categoria_nombre,categoria_estado,categoria_descripcion) VALUES (:NOMBRE,:Estado,:Descripcion)");

$sql->bindParam(":NOMBRE",$datos['NOMBRE']);
$sql->bindParam(":Estado",$datos['Estado']);
$sql->bindParam(":Descripcion",$datos['Descripcion']);
$sql->execute();

	return $sql;

}
 /*---------- PARA MOSTRAR DATOS DE conteo de  categoria-------*/
 protected static function datos_categoria_modelo($tipo,$id){
	if($tipo=="Unico"){
		$sql=mainModelo::conectar()->prepare("SELECT * FROM categoria WHERE categoria_id=:ID");
		$sql->bindParam(":ID",$id);
		}elseif($tipo=="Conteo"){
			$sql=mainModelo::conectar()->prepare("SELECT categoria_id FROM categoria WHERE categoria_id!='0'");
	}
	$sql->execute();
	return $sql;
 }
  /*----------  Modelo eliminar categoria----------*/
  protected static function eliminar_categoria_modelo($id){
	$sql=mainModelo::conectar()->prepare("DELETE FROM categoria WHERE categoria_id=:ID");

	$sql->bindParam(":ID",$id);
	 $sql->execute();
		 return $sql;

 }
 /*----------  Modelo actualizar categoria ----------*/

protected static function actualizar_categoria_modelo($datos){
	
	$sql=mainModelo::conectar()->prepare("UPDATE categoria SET categoria_id=:ID,categoria_nombre=:NOMBRE,categoria_descripcion=:Descripcion,categoria_estado=:Estado WHERE categoria_id=:ID");
	$sql->bindParam(":NOMBRE",$datos['NOMBRE']);
	$sql->bindParam(":Estado",$datos['Estado']);
	$sql->bindParam(":Descripcion",$datos['Descripcion']);
	$sql->bindParam(":ID",$datos['ID']);
	$sql->execute();
	
		return $sql;
	
	}
 
}


