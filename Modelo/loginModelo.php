<?php 

   require_once "mainModelo.php";

   class loginModelo extends mainModelo{


        /*----------modelo para iniciar session ----------*/
      protected static function iniciar_sesion_modelo($datos){
         $sql=mainModelo::conectar()->prepare("SELECT * FROM usuario WHERE usuario_usuario=:Usuario AND usuario_clave=:Clave AND usuario_estado='Activa'");

		     $sql->bindParam(":Usuario",$datos['Usuario']);
		  	 $sql->bindParam(":Clave",$datos['Clave']);
		     $sql->execute();

			return $sql;

		}



		}