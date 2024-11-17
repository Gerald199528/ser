<?php


require_once "mainModelo.php";

class empresaModelo extends mainModelo{
 
    protected static function datos_empresa_modelo(){
       
        $sql=mainModelo::conectar()->prepare("SELECT * FROM empresa");           
    $sql->execute();
    return $sql;
 }

         /*----------  Modelo agregar Empresa ----------*/
     protected static function agregar_empresa_modelo($datos){
        $sql=mainModelo::conectar()->prepare("INSERT INTO empresa(empresa_rif,empresa_nombre,empresa_telefono,empresa_email,empresa_direccion) VALUES (:RIF,:Nombre,:Telefono,:Email,:Direccion)");

        $sql->bindParam(":RIF",$datos['RIF']);
        $sql->bindParam(":Nombre",$datos['Nombre']);
        $sql->bindParam(":Telefono",$datos['Telefono']);
        $sql->bindParam(":Email",$datos['Email']);
        $sql->bindParam(":Direccion",$datos['Direccion']);
        $sql->execute();
        
            return $sql;
     }
      /*---------- PARA MOSTRAR DATOS DE conteo de  empresa-------*/
 protected static function conteo_empresa_modelo($tipo,$id){
	if($tipo=="Unico"){
		$sql=mainModelo::conectar()->prepare("SELECT * FROM empresa WHERE empresa_id=:ID");
		$sql->bindParam(":ID",$id);
		}elseif($tipo=="Conteo"){
			$sql=mainModelo::conectar()->prepare("SELECT empresa_id FROM empresa WHERE empresa_id!='0'");
	}
	$sql->execute();
	return $sql;
 }
    /*---------- PARA Actualizar  empresa-------*/
     protected static function actualizar_empresa_modelo($datos){
	
        $sql=mainModelo::conectar()->prepare("UPDATE empresa SET empresa_rif=:RIF,empresa_nombre=:Nombre,empresa_telefono=:Telefono,empresa_email=:Email,empresa_direccion=:Direccion WHERE empresa_id=:ID");
        $sql->bindParam(":RIF",$datos['RIF']);
        $sql->bindParam(":Nombre",$datos['Nombre']);
        $sql->bindParam(":Telefono",$datos['Telefono']);
        $sql->bindParam(":Email",$datos['Email']);
        $sql->bindParam(":Direccion",$datos['Direccion']);
        $sql->bindParam(":ID",$datos['ID']);
        $sql->execute();
    
        return $sql;	
        
     
    }
    
    }
 
