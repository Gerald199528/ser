<?php

$peticionAjax=true;
require_once "../config/APP.php";

 if(isset($_POST['categoria_nombre_reg'])  || isset($_POST['categoria_id_del']) || isset($_POST['categoria_id_up'])){
    	/*----------  Ruta al Controlador ----------*/
require_once "../Controladores/categoriacontrolador.php";
$ins_categoria= new categoriacontrolador();


/*----------  agregar caegoria ----------*/
if(isset($_POST['categoria_nombre_reg'])){
echo $ins_categoria->agregar_categoria_Controlador();
}
/*----------  agregar categoria ----------*/
if(isset($_POST['categoria_id_del'])){
	echo $ins_categoria->eliminar_categoria_Controlador();
	}
	/*----------  Actualizar categoria----------*/
if(isset($_POST['categoria_id_up'])){
	echo $ins_categoria->actualizar_categoria_controlador();
	
	}
 

	}else{
		session_start(['name'=>'Ser']);
		session_unset();
		session_destroy();
		header("Location:" .SERVERURL. "login/");
		exit();
	
	 }
	