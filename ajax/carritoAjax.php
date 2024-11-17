<?php

$peticionAjax=true;
require_once "../config/APP.php";

	if(isset($_POST['buscar_producto']) || isset($_POST['id_agregar_producto']) || isset($_POST['id_eliminar_producto'])){

		/*--------- Instancia al controlador - Instance to controller ---------*/
		require_once "../Controladores/carritoControlador.php";
        $ins_producto = new carritoControlador();


/*--------- Instancia al controlador  buscar en carrito- Instance to controller ---------*/
		if(isset($_POST['buscar_producto'])){
			echo $ins_producto->buscar_producto_Controlador();



		}
        
		/*--------- Instancia al controlador  agregar venta en carrito- Instance to controller ---------*/
		if(isset($_POST['id_agregar_producto'])){
			echo $ins_producto->agregar_producto_Controlador();



		}
		     
		/*--------- Instancia al controlador  eliminar venta en carrito- Instance to controller ---------*/
		if(isset($_POST['id_eliminar_producto'])){
			echo $ins_producto->eliminar_producto_Controlador();



		}
        
        

	}else{
		session_start(['name'=>'Ser']);
		session_unset();
		session_destroy();
		header("Location:" .SERVERURL. "login/");
		exit();
	
	}