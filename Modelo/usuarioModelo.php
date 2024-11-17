<?php


require_once "mainModelo.php";

class usuarioModelo extends mainModelo{

    /*----------  Modelo agregar administrador ----------*/

protected static function agregar_usuario_modelo($datos){

	$sql=mainModelo::conectar()->prepare("INSERT INTO usuario(usuario_cedula,usuario_nombre,usuario_apellido,usuario_telefono,usuario_direccion,usuario_email,usuario_usuario,usuario_clave,usuario_estado,usuario_privilegio,usuario_avatar) VALUES(:CEDULA,:Nombre,:Apellido,:Telefono,:Direccion,:Email,:Usuario,:Clave,:Estado,:Privilegio,:Avatar)");

$sql->bindParam(":CEDULA",$datos['CEDULA']);
$sql->bindParam(":Nombre",$datos['Nombre']);
$sql->bindParam(":Apellido",$datos['Apellido']);
$sql->bindParam(":Telefono",$datos['Telefono']);
$sql->bindParam(":Direccion",$datos['Direccion']);
$sql->bindParam(":Email",$datos['Email']);
$sql->bindParam(":Usuario",$datos['Usuario']);
$sql->bindParam(":Clave",$datos['Clave']);
$sql->bindParam(":Estado",$datos['Estado']);
$sql->bindParam(":Privilegio",$datos['Privilegio']);
$sql->bindParam(":Avatar",$datos['Avatar']);
$sql->execute();

	return $sql;

}
  /*----------  Modelo eliminar ADMINISTRADOR----------*/
  protected static function eliminar_usuario_modelo($id){
	$sql=mainModelo::conectar()->prepare("DELETE FROM usuario WHERE usuario_id=:ID");

	$sql->bindParam(":ID",$id);
	 $sql->execute();
		 return $sql;

 }
 /*---------- PARA MOSTRAR DATOS DE ADMINISTRADOR--------*/
 protected static function datos_usuario_modelo($tipo,$id){
	if($tipo=="Unico"){
		$sql=mainModelo::conectar()->prepare("SELECT * FROM usuario WHERE usuario_id=:ID");
		$sql->bindParam(":ID",$id);
		}elseif($tipo=="Conteo"){
			$sql=mainModelo::conectar()->prepare("SELECT usuario_id FROM usuario WHERE usuario_id!='1'");
	}

	$sql->execute();
	return $sql;
 }
 
    /*----------  Modelo actualizar administrador ----------*/

	protected static function actualizar_usuario_modelo($datos){
		
		$sql=mainModelo::conectar()->prepare("UPDATE usuario SET usuario_cedula=:CEDULA,usuario_nombre=:Nombre,usuario_apellido=:Apellido,usuario_telefono=:Telefono,usuario_direccion=:Direccion,usuario_email=:Email,usuario_usuario=:Usuario,usuario_clave=:Clave,usuario_estado=:Estado,usuario_privilegio=:Privilegio,usuario_avatar=:Avatar  WHERE usuario_id=:ID");
		
		$sql->bindParam(":CEDULA",$datos['CEDULA']);
		$sql->bindParam(":Nombre",$datos['Nombre']);
		$sql->bindParam(":Apellido",$datos['Apellido']);
		$sql->bindParam(":Telefono",$datos['Telefono']);
		$sql->bindParam(":Direccion",$datos['Direccion']);
		$sql->bindParam(":Email",$datos['Email']);
		$sql->bindParam(":Usuario",$datos['Usuario']);
		$sql->bindParam(":Clave",$datos['Clave']);
		$sql->bindParam(":Estado",$datos['Estado']);
		$sql->bindParam(":Privilegio",$datos['Privilegio']);
		$sql->bindParam(":Avatar",$datos['Avatar']);
		$sql->bindParam(":ID",$datos['ID']);
		$sql->execute();

		return $sql;	

	}
}