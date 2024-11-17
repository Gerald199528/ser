<?php


require_once "mainModelo.php";

class delyverysModelo extends mainModelo{

    /*----------  Modelo agregar Delyverys ----------*/

protected static function agregar_delyverys_modelo($datos){

	$sql=mainModelo::conectar()->prepare("INSERT INTO delyverys(codigo,nombre,apellido,estado,telefono,direccion) VALUES(:CODIGO,:Nombre,:Apellido,:Estado,:Telefono,:Direccion)");

$sql->bindParam(":CODIGO",$datos['CODIGO']);
$sql->bindParam(":Nombre",$datos['Nombre']);
$sql->bindParam(":Apellido",$datos['Apellido']);
$sql->bindParam(":Estado",$datos['Estado']);
$sql->bindParam(":Telefono",$datos['Telefono']);
$sql->bindParam(":Direccion",$datos['Direccion']);
$sql->execute();

	return $sql;

}
 /*---------- PARA MOSTRAR DATOS DE conteo de  DELYVERYS-------*/
 protected static function datos_delyverys_modelo($tipo,$id){
	if($tipo=="Unico"){
		$sql=mainModelo::conectar()->prepare("SELECT * FROM delyverys WHERE id=:ID");
		$sql->bindParam(":ID",$id);
		}elseif($tipo=="Conteo"){
			$sql=mainModelo::conectar()->prepare("SELECT id FROM delyverys WHERE id!='1'");
	}
	$sql->execute();
	return $sql;
 }
   /*----------  Modelo eliminar DELYVERYS----------*/
   protected static function eliminar_delyverys_modelo($codigo){
	$sql=mainModelo::conectar()->prepare("DELETE FROM delyverys WHERE codigo=:CODIGO");

	$sql->bindParam(":CODIGO",$codigo);
	 $sql->execute();
		 return $sql;

 }

 
/*----------  Modelo actualizar delyverys ----------*/

protected static function actualizar_delyverys_modelo($datos){
	
	$sql=mainModelo::conectar()->prepare("UPDATE delyverys SET codigo=:CODIGO,nombre=:Nombre,apellido=:Apellido,estado=:Estado,telefono=:Telefono,direccion=:Direccion WHERE id=:ID");
	$sql->bindParam(":CODIGO",$datos['CODIGO']);
	$sql->bindParam(":Nombre",$datos['Nombre']);
	$sql->bindParam(":Apellido",$datos['Apellido']);
	$sql->bindParam(":Estado",$datos['Estado']);
	$sql->bindParam(":Telefono",$datos['Telefono']);
	$sql->bindParam(":Direccion",$datos['Direccion']);
	$sql->bindParam(":ID",$datos['ID']);
	$sql->execute();

	return $sql;	
	
 
}

}