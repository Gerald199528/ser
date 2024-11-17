<?php


require_once "mainModelo.php";

class clienteModelo extends mainModelo{

    /*----------  Modelo agregar administrador ----------*/

protected static function agregar_cliente_modelo($datos){

	$sql=mainModelo::conectar()->prepare("INSERT INTO cliente(cliente_dni,cliente_nombre,cliente_apellido,cliente_telefono,cliente_genero,cliente_provincia,cliente_ciudad,cliente_direccion,cliente_email,cliente_clave,cliente_estado,cliente_privilegio) VALUES (:DNI,:Nombre,:Apellido,:Telefono,:Genero,:Provincia,:Ciudad,:Direccion,:Email,:Clave,:Estado,:Privilegio)");

$sql->bindParam(":DNI",$datos['DNI']);
$sql->bindParam(":Nombre",$datos['Nombre']);
$sql->bindParam(":Apellido",$datos['Apellido']);
$sql->bindParam(":Genero",$datos['Genero']);
$sql->bindParam(":Telefono",$datos['Telefono']);
$sql->bindParam(":Provincia",$datos['Provincia']);
$sql->bindParam(":Ciudad",$datos['Ciudad']);
$sql->bindParam(":Direccion",$datos['Direccion']);
$sql->bindParam(":Email",$datos['Email']);
$sql->bindParam(":Clave",$datos['Clave']);
$sql->bindParam(":Estado",$datos['Estado']);
$sql->bindParam(":Privilegio",$datos['Privilegio']);

$sql->execute();

	return $sql;

}
 /*---------- PARA MOSTRAR DATOS DE conteo de  cliente-------*/
 protected static function datos_cliente_modelo($tipo,$id){
	if($tipo=="Unico"){
		$sql=mainModelo::conectar()->prepare("SELECT * FROM cliente WHERE cliente_id=:ID");
		$sql->bindParam(":ID",$id);
		}elseif($tipo=="Conteo"){
			$sql=mainModelo::conectar()->prepare("SELECT cliente_id FROM cliente WHERE cliente_id!='0'");
	}
	$sql->execute();
	return $sql;
 }
   /*----------  Modelo eliminar cliente----------*/
   protected static function eliminar_cliente_modelo($id){
	$sql=mainModelo::conectar()->prepare("DELETE FROM cliente WHERE cliente_id=:ID");

	$sql->bindParam(":ID",$id);
	 $sql->execute();
		 return $sql;

 }


}